<?php

class SubscriptionController extends Controller
{
	public function actionIndex()
	{          
            if(Yii::app()->request->isAjaxRequest){
                $teg = Yii::app()->request->getPost('teg');
                                
                $modelTeg = Tag::model()->find(array(
                        'select'=>'id',
                        'condition'=>'name=:name',
                        'params'=>array(':name'=>$teg),
                    ));
                if($modelTeg==null){
                    $modelTeg = new Tag();
                    $modelTeg->name = $teg;
                    $modelTeg->save();
                }
                
                 $exists = SubscriptionTeg::model()->exists('user_id=:user_id AND teg_id =:teg_id',array(':user_id'=>Yii::app()->user->id,':teg_id'=>$modelTeg->id));
                    
                    
                    if($exists)
                    {
                      
                        $criteria = new CDbCriteria;
                        $criteria->condition = 'user_id=:user_id AND teg_id =:teg_id';
                        $criteria->params = array(':user_id'=> Yii::app()->user->id,
                                                  ':teg_id'=>$modelTeg->id,
                                );
                                SubscriptionTeg::model()->deleteAll($criteria);                           
                    }
                    else {
                        
                        $modelSub = new SubscriptionTeg();                        
                        $modelSub->user_id = Yii::app()->user->id;
                        $modelSub->teg_id = $modelTeg->id;
                        $modelSub->save();    
                        
                          /*echo CHtml::encode($owner_name);
                    // Завершаем приложение
                    Yii::app()->end();  
                       */      
                    }
                    
                   $n=SubscriptionTeg::model()->count('teg_id=:teg_id', array('teg_id'=>$modelTeg->id));
                   echo $n;
                    
            }
        }
}