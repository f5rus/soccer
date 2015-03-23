<?php

class TopscorersController extends Controller
{
    public $defaultAction = 'index';

    public function actionIndex(){

        if (isset($_POST['team_id'])) {
            //echo $_POST['matchday'];
            $result = SoccerMatch::getTable(0,$_POST['matchday'],true);
            $content="";
            for($i=0;$i<count($result['teams']);$i++){
                $content.=$this->renderPartial('_view',array(
                    'team'=>$result['teams'][$i],
                    'stats'=>$result['stats'][$i],
                    'number'=>($i+1),
                    'head'=>true,
                ));
            }
            echo $content;
            //exit();
            Yii::app()->end();
        }

        $players = SoccerPlayer::model()->findAll();
        for($i=0;$i<count($players);$i++) {
            $stats[$i] = SoccerMatchPlayerStats::getPlayerStats($players[$i]->id);
        }

        for($i=0;$i<count($players);$i++)
            for($j=$i+1;$j<count($players);$j++)
            {
                if ($stats[$i]["goals"]<$stats[$j]["goals"]) {
                    $temp=$players[$i]; $players[$i]=$players[$j]; $players[$j]=$temp;
                    $temp=$stats[$i]; $stats[$i]=$stats[$j]; $stats[$j]=$temp;
                }
            }



        //echo Yii::app()->request->getParam('macthday');
        //if (isset($_GET['macthday'])) echo "yeye".$_GET['macthday'];
        $result = SoccerMatch::getTable(0,38,true);
        //if (!$macthday) $macthday=38;
        //model()->findAll('tid=:team',array('team'=>$model->id));
        //print_r($result);
        $arraymatchdays=array();
        for($i=1;$i<=38;$i++){
            $arraymatchdays[$i]=$i;
        }

        for($i=0;$i<20;$i++){
            //$arraymatchdays[$i]=$i;
            $teamname[$i]=$result['teams'][$i]->rusname;
            $teamid[$i]=$result['teams'][$i]->id;
        }

        for($i=0;$i<20;$i++) {
            $players2[$i]=$players[$i];
            $stats2[$i]=$stats[$i];
            $temp=SoccerPlayerTeam::model()->find('pid=:pid',array('pid'=>$players2[$i]->id));
            $teams[$i]=$temp->team;
        }

        //$listteam=array(0=>array('team'=>'Ливерпуль','id'=>12));
       // $listteam=array('team'=>array('Ливерпуль','Манчестер Юнайтер'),'id'=>array(12,5));

        $listteam=array('team'=>$teamname,'id'=>$teamid);

        $this->render('index',array(
            'players'=>$players2,
            'stats'=>$stats2,
            'teams'=>$teams,
            'arraymatchdays'=>$arraymatchdays,
            'cmday'=>$result['current'],
            'listteam'=>$listteam,
            )
        );

    }

}