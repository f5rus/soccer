<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * The followings are the available model relations:
 * @property Comments[] $comments
 * @property User $author
 */
class Post extends CActiveRecord
{
	const STATUS_DRAFT=1;
        const STATUS_PUBLISHED=2;
        const STATUS_ARCHIVED=3;
        const IMG_WIDTH = 530;
    
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
        {
            return array(
                array('title, content, status', 'required'),
                array('title, tags', 'length', 'max'=>60),
                array('status', 'in', 'range'=>array(1,2,3)),
                array('tags', 'normalizeTags'),
                array('preview, image','safe'),
                array('title, status', 'safe', 'on'=>'search'),
            );
        }

        public function normalizeTags($attribute,$params)
        {
            $this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
        }
        
        public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('post/index', 'tag'=>$tag));
		return $links;
	}
        
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                        'author' => array(self::BELONGS_TO, 'User', 'author_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'owner_id'),
			'commentCount' => array(self::STAT, 'Comment', 'owner_id'),
                    
		);
                
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'title' => 'Название поста',
			'content' => 'Контент',
                        'preview' => 'Превью',
			'tags' => 'Теги',
			'status' => 'Статус',
			'create_time' => 'Время создания',
			'update_time' => 'Время изменения',
			'author_id' => 'Автор',
                      
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
                $criteria->compare('preview',$this->preview,true);                
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('author_id',$this->author_id);
            

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        
        public static function GetNews()
        {
            if (!Yii::app()->user->isGuest){
                
                $teg_arr= array();
                
                $models_tag= SubscriptionTeg::model()->findAll('user_id=:user_id', array(':user_id'=> Yii::app()->user->id));
                foreach ($models_tag as $tag){
                                                            
                    $criteria=new CDbCriteria(array(
                    'condition'=>'status='.Post::STATUS_PUBLISHED,
                    'order'=>'update_time DESC',
                    'limit'=>5,
                    ));
                                      
                    $criteria->addSearchCondition('tags', $tag->teg->name);
                         
                    //echo $tag->teg->name;
                    $news_t = self::model()->findAll($criteria);
                    
                    foreach ($news_t as $row){
                        $teg_arr[$row->id] = 
                                Yii::app()->dateFormatter->format("dd.MM.yy", $row->create_time).
                                " <a href ='".$row->url."' >".
                                mb_substr( trim (strip_tags($row->preview)),0, 70,'UTF-8').
                                "...</a>";
                    }  
                }
                krsort($teg_arr); 
                $teg_arr= array_slice($teg_arr, 0,(count($teg_arr)<5?count($teg_arr):5));
                
                $list_gats = "<div class='list_gats'><ul>";
                foreach ($teg_arr as $row)
                {
                   // echo $row;
                    $list_gats.="<li>".$row."</li>";
                }
                 $list_gats.="</ul></div>";


                 return $list_gats;
            }     
        }


        public function getUrl()
        {
            return Yii::app()->createUrl('post/post/view', array(
                'id'=>$this->id,
               // 'title'=>$this->title,
            ));
        }
        
        protected function beforeSave()
        {
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                {
                    $this->create_time=$this->update_time=time();
                    $this->author_id=Yii::app()->user->id;
                    
                    $this->cut_img_content($this->image);
                }
                else
                {   
                    $this->update_time=time();
                     $this->cut_img_content($this->image);
                }
                
                    $this->create_preview(); 
                                   
                
                return true;
            }
            else
                return false;
        }
        
        public function cut_img_content($image_name='')
        {
               $img =array(0);
              if(preg_match('/src="([^"]*)"/',$this->content, $img)){
              
                  
                //  echo $img[1];  
                  
                if (trim($image_name)=='')
                {
                    $strSource = uniqid().".jpg";
                }
                else{
                    $strSource = $image_name;
                }
                
                
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$strSource; 
                                                
              
                $img = AcImage::createImage("../".$img[1]);
                
                $img->cropCenter('5pr', '3pr');
                $img->resizeByWidth(self::IMG_WIDTH);
                
                if(file_exists($path)){
                   unlink($path);
                }                
                 
                $img-> saveAsJPG($path);
                
                $this->image=$strSource;              
                                    
               } 
        }
        
        public function create_preview()
        {
            $explode_content = explode('&lt;!--cut--&gt;',$this->content); 
            if(count($explode_content)>0)
            {                    
                    $preview=  strip_tags($explode_content[0],"<p>");  
                    
                    $config = array();

                    $tidy = new tidy();
                    $tidy->parseString($preview, $config, 'utf8');
                    $tidy->cleanRepair();

                    $this->preview = trim(str_replace(array('<body>','</body>'), '', $tidy->body()));
                   
                    $this->content = str_replace('&lt;!--cut--&gt;', '<!--cut-->', $this->content);
                                  
            }   
        }


        public function replace_cut()
        {
           $this->content = str_replace('<!--cut-->','&lt;!--cut--&gt;' , $this->content);                   
        }


        protected function afterSave()
        {
            parent::afterSave();
            Tag::model()->updateFrequency($this->_oldTags, $this->tags);
        }

        private $_oldTags;

        protected function afterFind()
        {
            parent::afterFind();
            $this->_oldTags=$this->tags;
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
