<?php

class ForecastController extends Controller{
    public function actionindex(){
        
        $matchday = Forecast::model()->matchday();
        
        if(Yii::app()->user->isGuest)
            {    
                $this->render('forGuest');
                    
                Yii::app()->end(); 
            }
        $user_id = Yii::app()->user->id;        
        if(Yii::app()->request->isAjaxRequest){  
        
            /*echo "<pre>";
            var_dump($_POST);
            echo "</pre>";*/
            if(isset($_GET["page_cur"]))
            {
                $matchday = $_GET["page_cur"];
            };
            
            $goals = Yii::app()->request->getPost('goals');
            if(isset($goals)) {               
               
                foreach ($goals as $key=>$value){
                    
                    //если не установлен
                    if(!isset($value["home"]) || !isset($value["away"])){
                        break;
                    }
                    
                    //проверяем на статус
                    $exists= SoccerMatch::model()->exists("id=:id AND status IS NULL",array(":id"=>$key));
                    if(!$exists){
                        continue;
                    }                
                    //если есть, обновляем если нет создаем
                    $model = Forecast::model()->findByAttributes(array('match_id'=> $key  , 'user_id'=>$user_id));
                    if($model){
                   
                        $model->homegoals = $value["home"];
                        $model->awaygoals = $value["away"];
                        $model->save();
                    }
                    else{
                        $model = new Forecast();

                        $model->user_id = $user_id;
                        $model->match_id = $key;
                        $model->homegoals = $value["home"];
                        $model->awaygoals = $value["away"];

                        $model->save();
                    }
                }           
            }
        
        }
        
        $statistics_arr = array();        
        
        $statistics_arr['matchday']=  $matchday; 
        $count=Forecast::model()->count_st($matchday);
        $countall=Forecast::model()->count_all($matchday);
        $statistics_arr['count']=$count;
        $statistics_arr['score_turn_pl']= Forecast::model()->score_turn_pl($user_id);     
        $statistics_arr['score_tur_pl']=Forecast::model()->score_tur_pl($user_id, $matchday);       
        $statistics_arr['success_pl']=Forecast::model()->success_pl($user_id, $matchday);
        $statistics_arr['players_turn']=Forecast::model()->players_turn();       
        $statistics_arr['statistics_turn'] = Forecast::model()->statistics_turn();        
        $statistics_arr['players_tur'] = Forecast::model()->players_tur($matchday);     
        $statistics_arr['statistics_tur'] = Forecast::model()->players_tur($matchday);
        $statistics_arr['best_player'] = Forecast::model()->best_player();
        

        $sql='SELECT '
                . 't1.id as id, '
                . 't3.rusname as hometeam_rusname,'
                . 't4.rusname as awayteam_rusname,'
                . 't3.logo_img as hometeam_logo_img,'
                . 't4.logo_img as awayteam_logo_img,'
                . 't1.homegoals as t1_homegoals,'
                . 't1.awaygoals as t1_awaygoals,'
                . 't2.homegoals as t2_homegoals,'
                . 't2.awaygoals as t2_awaygoals, '
                . 'IF(t1.date>NOW(), 0, 1)  as status ,'
                . 't2.scores as scores '
            . 'FROM '
                . 'tbl_soccer_match as t1 '            
            . 'LEFT JOIN (SELECT * FROM tbl_forecast WHERE tbl_forecast.user_id=:user_id) as t2 ON  t2.match_id=t1.id '
            . 'LEFT JOIN tbl_soccer_team as t3  ON  t1.hometeam_id=t3.id '
            . 'LEFT JOIN tbl_soccer_team as t4  ON  t1.awayteam_id=t4.id ';
           //     . 'WHERE t1.matchday>=:matchday';
        
        $dataProvider=new CSqlDataProvider($sql,array(
            'totalItemCount'=>$countall, 
            'params'=> array(':user_id'=>$user_id),//, ':matchday'=>$matchday),
            'pagination'=>array(                        
                        'pageSize'=>10,
                            ))               
                
                );
        if(!isset($_GET['page']))
        { 
            $p=$dataProvider->pagination;            
            $p->currentPage=$matchday-1;
            
        }
      
     /*   $dataProvider = new CActiveDataProvider('SoccerMatch');
        
           //     var_dump($dataProvider->data);
        */
        
        $ar_stat1 = array(
                array('title'=>'Пользователь:','text'=>Yii::app()->getModule('user')->getName(Yii::app()->user->id)),
                array('title'=>'Очки в турнире:','text'=>$statistics_arr['score_turn_pl']==''?0:$statistics_arr['score_turn_pl']),
                array('title'=>'Очки в туре:','text'=>$statistics_arr['score_tur_pl']==''?0:$statistics_arr['score_tur_pl']),
                array('title'=>'Успех:','text'=>$statistics_arr['success_pl']==''?0:$statistics_arr['success_pl']));
        
        $dataProv = new CArrayDataProvider($ar_stat1);
        
       $ar_stat2 = array(
                array('title'=>'Тур::','text'=>$statistics_arr['matchday']),
                array('title'=>'Всего участников в трунире:','text'=>$statistics_arr['players_turn']==''?0:$statistics_arr['players_turn']),
                array('title'=>'Всего прогнозов в турнире:','text'=>$statistics_arr['statistics_turn']==''?0:$statistics_arr['statistics_turn']),
                array('title'=>'Всего участников в туре:','text'=>$statistics_arr['players_tur']==''?0:$statistics_arr['players_tur']),
                array('title'=>'Всего прогнозов в туре:','text'=>$statistics_arr['statistics_tur']==''?0:$statistics_arr['statistics_tur']),);
                
        $dataProv_stat2 = new CArrayDataProvider($ar_stat2);
        
        
        $this->render('index',array(
                'model'=>$dataProvider,
                'statistics_arr'=> $statistics_arr,
                'ar_stat1'=>$dataProv,
                'ar_stat2'=>$dataProv_stat2,
                    ));
        
        
    }
    
    public function actionUpdateScores(){
        Forecast::model()->match();
    }
}

