<?php

class CoachController extends Controller
{
    private $_model;
    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
                $this->_model=SoccerCoach::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
    public function actionIndex(){
        $dataProvider=new CActiveDataProvider('SoccerCoach', array(
            'criteria'=>array(),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    public function actionView(){
    $model = $this->loadModel();
    $team = SoccerCoachTeam::model()->find('cid=:team',array('team'=>$model->id));
    //$player = SoccerPlayerTeam::model()->findAll('pid=:team',array('team'=>$model->id));
    //print_r($player[0]->team);
    $this->render('view',array(
        'model'=>$model,
        'team'=>$team,
    ));
}
    /*public function actionError(){
        $app = Yii::app();
        if( $error = $app->errorHandler->error->code )
        {
            if( $app->request->isAjaxRequest )
                echo $error['message'];
            else
                $this->render( 'application.views.layout.error' . ( $this->getViewFile( 'error' . $error ) ? $error : '' ), $error );
        }
    }*/


}