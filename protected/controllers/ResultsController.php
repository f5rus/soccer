<?php

class ResultsController extends Controller
{
    public $defaultAction = 'index';

    public function actionIndex($macthday=null){

        if (isset($_POST['matchday'])) {
            $content="";
            $result = SoccerMatch::getResults($_POST['matchday']);
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
            echo $content;
            Yii::app()->end();
        }

        $result2 = SoccerMatch::getTable(0,38,true);
        $result = SoccerMatch::getResults(0,38,true);
        $arraymatchdays=array();
        for($i=1;$i<=38;$i++){
            $arraymatchdays[$i]=$i;
        }

        for($i=0;$i<20;$i++){
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