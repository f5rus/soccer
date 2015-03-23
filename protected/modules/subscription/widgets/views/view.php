<div>
<?php


echo CHtml::ajaxLink("<span class='suscr_teg' id='suscr_teg'>$status</span>",Yii::app()->urlManager->createUrl('subscription/subscription/index'), array(
                                        'type' => 'POST',
                                        'data'=>array('teg'=>$strTeg),                               
                                        'update' => '#count_subs',
                                        'success'=>'js:function(data){
                                            //  alert("fdgvfd");  
                                            if(document.getElementById("suscr_teg").innerHTML  == "Подписаться на тег"){
                                                document.getElementById("suscr_teg").innerHTML  = "Отписаться от тега";
                                            }
                                            else
                                            {   
                                                document.getElementById("suscr_teg").innerHTML  = "Подписаться на тег";
                                            }   
                                                document.getElementById("count_subs").innerHTML  = data;


                                            }',
                                        
                        )); 
                               
?>
    
    <span name='count_subs' id = 'count_subs'><?php echo $count_subs ?></span>


</div>

