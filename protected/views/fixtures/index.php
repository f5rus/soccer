<?php
$this->layout='//layouts/column1';
$this->setPageTitle("Расписание матчей");
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => "Расписание матчей"),
    )
)); ?>

<script>

    $(document).ready(function(){


        $('#tour li a').click(function (){
            var text = $(this).html();//$('#mchatMsgF').val();
            //alert(text);
            //$('ul.sub').css('display','none');
            $('#tour li a').each(function(){
                $(this).removeClass('active');
            })
            $(this).addClass('active');
            //return;
            //var REL = $(this).attr("rel");
            //var URL='<?php //echo Yii::app()->CreateUrl("/mchat/add"); ?>';
            var URL=Yii.app.createUrl('fixtures/index');
            var dataString = 'matchday=' + text;// +'&rel='+ REL;
            //alert(dataString);
            //alert(URL+"  ---  "+text);
            $.ajax({
                type: "POST",
                url: URL,
                data: dataString,
                cache: false,
                success: function(html){
                    //alert(html);
                    $(".game-container ul").html(html);
                    //$('#team li a').click();
                    return false;
                }
            });
            return false;
        });

    });

</script>

<h1 class="h1content"><?php echo 'Расписание матчей'; ?></h1>

<div id="navig">
    <div style="font-size: 16px; float:left;"><span>Текущий тур: <strong><?php echo $cmday; ?></strong></span></div>
    <ul class="shot-menu tabs2">
        <li class="has-dd active srght">
            <a href="#">Выберите тур <span class="caret"></span></a>
            <ul id="tour" class="sub">
                <?php for($i=$cmday;$i<38;$i++) echo "<li><a data-id=".($i+1)." href=\"#\">".($i+1)."</a></li>" ?>
            </ul>
        </li>
    </ul>
</div>

<style>
    .caret {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: 2px;
        vertical-align: middle;
        border-top: 4px solid;
        border-right: 4px solid transparent;
        border-left: 4px solid transparent;
    }
    .tourseperate {
        text-align: center;
        font-weight:bold;
        color: white !important;
        background: #888 !important;
        font-size:14px;
        padding:6px;
        margin:14px 0px 0px 0px;
    }

</style>


<div class="game-container">
    <ul>
        <?php $tcmday=$cmday; foreach($result as $game): ?>
            <?php
                if ($tcmday!=$game->matchday) {echo "<li class=\"game tourseperate\"><div class=\"items\">Тур: $game->matchday</div></li>"; $tcmday=$game->matchday;}
                $this->renderPartial('application.views.layouts._view',array(
                'model'=>$game,
            )); ?>
        <?php endforeach; ?>
    </ul>
</div>