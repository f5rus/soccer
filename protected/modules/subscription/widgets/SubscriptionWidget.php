<?php

class SubscriptionWidget extends CWidget
{
    public $strTeg;
    public $status;
    public $count_subs;
    
    public function init() {
        
  
         
        }     
    
    
    public function run()
    {
     
        if (!Yii::app()->user->isGuest)
        {
            $modelTeg = Tag::model()->find(array(
                            'select'=>'id',
                            'condition'=>'name=:name',
                            'params'=>array(':name'=>$this->strTeg),
                        ));

            $this->status = "Подписаться на тег";
            if (!$modelTeg) {
                $this->count_subs=0;
            }
            else {

                $n=SubscriptionTeg::model()->count('teg_id=:teg_id', array('teg_id'=>$modelTeg->id));
                $this->count_subs = $n;
            }        

            if($modelTeg){
                $exists = SubscriptionTeg::model()->exists('user_id=:user_id AND teg_id =:teg_id',array(':user_id'=>Yii::app()->user->id,':teg_id'=>$modelTeg->id));
                if($exists)
                    {
                        $this->status = "Отписаться от тега";
                    }

                }

            $this->render('view',array('strTeg'=>$this->strTeg, 'status'=>$this->status, 'count_subs'=>$this->count_subs));
        }
    }
}