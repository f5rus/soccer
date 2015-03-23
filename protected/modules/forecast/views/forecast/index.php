<div class="forecast">
     <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/css/grid.css" />
<h1>Конкурс прогнозов</h1>
    
<div class="table_">  
    
    <div id='match_'>Тур:<?php echo $statistics_arr['matchday'] ?></div>
<?php echo CHtml::beginForm();
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model,
    'enablePagination' => true,
    'cssFile' => Yii::app()->request->baseUrl .'/css/grid.css',
    'pager' => array(        
           'prevPageLabel'=>'Предыдущий тур',
           'nextPageLabel'=>'Следующий тур',           
           'maxButtonCount'=>'0',
           'header'=>''
       ),  
            'beforeAjaxUpdate' => 'js:function(id, options) {
                 
                    regex = /\/(\d+)/;  
                    url = unescape(options.url); 
                    found = url.match(regex); 
                    page = found == null ? 1 : found[1];
                    // выставить номер страницы скрытому полю 
                    $("#match_").text("Тур:"+page); 
                    
                    $.fn.yiiGridView.update("stat1",  { data: {  page_cur: page }});
                    $.fn.yiiGridView.update("stat2",  { data: {  page_cur: page }});
}' ,               
                     
   /* 'afterAjaxUpdate'=>'function(id, data) { //alert(data);
                       
                        //     $.fn.yiiGridView.update("stat1");
                         //   $.fn.yiiGridView.update("stat2");        

        }',*/
    'pagerCssClass'=>'custum-pager',
    'template'=>"{pager}{items}",
    'columns' =>array(
                
                    array (
                        'header'=>'Первая команда',    
                        'name'=>'hometeam_rusname',
                        //'cssClassExpression'=>'hometeam',
                        'htmlOptions' => array('class' => 'hometeam'),
                        'type' =>'raw',
                        'value'=>'$data["hometeam_rusname"]." ".CHtml::image("'.Yii::app()->request->baseUrl .'/images/soccer/team/$data[hometeam_logo_img]","",array("class"=>"logo_img"));',
                    ),                           
                    array(
                        'name' =>'t1_homegoals',
                        'header'=>'Счет',
                        'value'=>'$data["t1_homegoals"]==(-1)?"VS":$data["t1_homegoals"].":".$data["t1_awaygoals"]',                     
                       // 'cssClassExpression'=>'account',
                        'htmlOptions' => array('class' => 'account'),
                    ),
                     array (
                        'header'=>'Вторая команда',
                        'name'=>'awayteam_rusname',                         
                        'type' =>'raw',
                        'value'=>'CHtml::image("'.Yii::app()->request->baseUrl .'/images/soccer/team/$data[awayteam_logo_img]","",array("class"=>"logo_img"))." ".$data["awayteam_rusname"];',
                    ),         

                      array(
                        'name' =>'t2_homegoals',
                        'header'=>'Прогноз',
                        'value'=> '$data["status"]!=0? ($data["t2_homegoals"]==""?"- ":$data["t2_homegoals"]).":".($data["t2_awaygoals"]==""?" -":$data["t2_awaygoals"]):'
                          .'CHtml::TextField("goals[$data[id]][home]",$data["t2_homegoals"]).":".'
                          .'CHtml::TextField("goals[$data[id]][away]",$data["t2_awaygoals"])',
                        'type'=>'raw',
                      //  'cssClassExpression'=>'account',
                        'htmlOptions' => array('class' => 'account'),
                    ),    
                    
                    array(
                        'name'=>'scores',
                        'value'=>'$data["scores"]==""?"0":$data["scores"]',
                        'type'=>'raw',
                        'header'=>'Очки',   
                       // 'cssClassExpression'=>'scores',
                        'htmlOptions' => array('class' => 'scores'),
                    ),
        )
));

?>
 
<?php echo CHtml::ajaxSubmitButton('Сохранить', '', array(
    'type' => 'POST',
   'success'=>"js:function(data){
            alert('Сохранено!');
        }"

));
  
 echo CHtml::endForm(); 

 
?>
</div><!-- form -->

  
   

<div class = "statistics">
    <div class = "statistics_player stat1">
        <h3>Статистика игрока:</h3>
        
        <?php   $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider'=>$ar_stat1,       
                'id'=>'stat1',
                'enablePagination' => false,
                'hideHeader'=>true,
                'template'=>"{items}",
      /*       'afterAjaxUpdate'=>'function(id, data) { alert("222");}',
        */));
        
    ?>
    </div> 

    <div class = "statistics_player"> 
        <h3>Статистика турнира:</h3>

        <?php   $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider'=>$ar_stat2,       
                'id'=>'stat2',
                'enablePagination' => false,
                'hideHeader'=>true,
                'template'=>"{items}",
       /*     'afterAjaxUpdate'=>'function(id, data) { alert("333");}',
        */));?>
        
    </div>
</div>

<div class="clear"> </div>

<div class="best_player">
    <h3>Лидеры турнира:</h3>
    <br/><hr/>
    
    <?php
        foreach ($statistics_arr['best_player'] as $best_player){
            echo Yii::app()->getModule('user')->getName($best_player["user_id"]);
            echo ":".$best_player["scores"];
            echo "<br/>";
        }
    ?>
</div>
</div>




</script>