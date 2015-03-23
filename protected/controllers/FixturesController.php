<?php

class FixturesController extends Controller
{
    public $defaultAction = 'index';

    public function actionIndex($macthday=null){

        if (isset($_POST['matchday'])) {
            //echo $_POST['matchday'];
            $result = SoccerMatch::getTable(0,$_POST['matchday'],true);
            $content="";
            $result = SoccerMatch::getFixtures($_POST['matchday']);
            $i=true;
            foreach($result as $game){
                if ($i) {
                    $content.= "<li class=\"game tourseperate\"><div class=\"items\">Тур: ".$_POST['matchday']."</div></li>";
                    $i=false;
                }
                $content.= $this->renderPartial('application.views.layouts._view',array(
                    'model'=>$game,
                ));
            }
/*
            for($i=0;$i<count($result['teams']);$i++){
                $content.=$this->renderPartial('_view',array(
                    'team'=>$result['teams'][$i],
                    'stats'=>$result['stats'][$i],
                    'number'=>($i+1),
                    'head'=>true,
                ));
            }*/
            echo $content;
            //exit();
            Yii::app()->end();
        }

        $result2 = SoccerMatch::getTable(0,38,true);
        $result = SoccerMatch::getFixtures(0,38,true);
        $arraymatchdays=array();
        for($i=1;$i<=38;$i++){
            $arraymatchdays[$i]=$i;
        }

        for($i=0;$i<20;$i++){
            //$arraymatchdays[$i]=$i;
            $teamname[$i]=$result2['teams'][$i]->rusname;
            $teamid[$i]=$result2['teams'][$i]->id;
        }
        $listteam=array('team'=>$teamname,'id'=>$teamid);

        $this->render('index',array(
            'result'=>$result,
            'arraymatchdays'=>$arraymatchdays,
            'cmday'=>$result2['current'],
            'listteam'=>$listteam,
            )
        );

    }

}