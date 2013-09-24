<?php

class AdminController extends Controller
{
    public $defaultAction = 'index';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    public function accessRules()
    {
        return array(
            array('allow',
                'roles'=>array('admin'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $model = new User;

        if ( isset($_GET['pageSize']) && OmsGridView::validatePageSize($_GET['pageSize']) ) {
            $model->currentPageSize = $_GET['pageSize'];
        }

        $fields = new AdminSearchForm('search');

        if ( isset($_GET['AdminSearchForm']) ) {
            $fields->attributes = $_GET['AdminSearchForm'];

            if( $fields->validate() )
                $model->searchCriteria = $fields->getCriteria();

        }

        if ( isset($_GET['ajax']) ) {
            $dataProvider = $model->search();
            $totalItems = $dataProvider->getTotalItemCount();
            $gridParams = require(dirname(__FILE__) . '\..\views\admin\gridParams.php');
            $gridHtmlCode = $this->widget('OmsGridView',$gridParams,true);
            echo CJSON::encode(array(
                $totalItems,
                $gridHtmlCode,
            ));
            Yii::app()->end();
        } else {
            $this->render('index',array('model'=>$model, 'fields'=>$fields));
        }
    }

    protected function assignRole($role,$userId,$isNewRecord=true)
    {
        if ($isNewRecord ) {
            Yii::app()->authManager->assign($role,$userId);
        } else {
            Yii::app()->db->createCommand('
                UPDATE auth_assignment 
                SET itemname= :role 
                WHERE userid= :userId
            ')->execute(array(
                'role'   => $role,
                'userId' => $userId
            ));
        }
    }

    /*=======USERS ACTIONS=========*/

    public function actionCreate()
    {
        $model = new User;
        $model->role = 'admin';

        if(isset($_POST['User'])) {
            $model->attributes=$_POST['User'];
            if($model->save()) {

                $this->assignRole($model->role,$model->id); // assign role to user

                $this->redirect(array('admin/index'));
            }
        }


        $this->render('/user/create',array(
            'model'=>$model,
        ));

    }

    public function actionRemove(){

        if(isset($_GET['id'])){
            $model = User::model()->findByPk($_GET['id']);
            $model->scenario = 'remove';
            $model->deleted = 1;

            if($model->save()){
                $this->redirect(array('admin/index'));
            } else{
                throw new \Exception(print_r($model->getErrors(), true));
            }
        }
    }

    public function actionEdit($id){

        $model=$this->loadModel($id);
        $model->scenario = 'edit';
        $model->password = false;

        if(isset($_POST['User'])) {
            $model->attributes=$_POST['User'];

            if($_POST['User']['password'] == '*****' || strlen($_POST['User']['password']) == 0 ){
                if($model->save(true,array('username','role','firstname','lastname','email','region'))) {

                    $this->assignRole($model->role,$model->id,false); // assign role to user

                    $this->redirect(array('admin/index'));
                }
            }else{
                if($model->save()) {

                    $this->assignRole($model->role,$model->id,false); // assign role to user

                    $this->redirect(array('admin/index'));
                }
            }

        }

        $this->render('/user/edit',array(
            'model'=>$model,
        ));
    }
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionDuplicate($id){

        $model=$this->loadModel($id);
        $model->scenario = 'duplicate';
        $model->password = false;
        $model->username = false;
        $duplicate = new User;

        if(isset($_POST['User'])) {
            $duplicate->attributes=$_POST['User'];

            if($duplicate->save()) {

                $this->assignRole($duplicate->role, $duplicate->id); // assign role to user

                $this->redirect(array('admin/index'));
            }

        }

        $this->render('/user/duplicate',array(
            'model'=>$model,
        ));
    }

}