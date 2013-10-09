<?php

class AdminController extends Controller
{
    const ADMIN = 'admin';
    const CUSTOMER = 'customer';
    const SUPERVISOR = 'supervisor';
    const MERCHANDISER = 'merchandiser';

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

    public function prepareAjaxData($dataProvider)
    {
            $data = $dataProvider->getData();
            $user = Yii::app()->user;
            $currentTime = time();
            foreach($data as $i => $row) {
                $data[$i] = $row->getAttributes(null);
                if ( $user->isActive($row['id'], $currentTime) ) {
                    $data[$i] += array('active'=>true);
                }
            }
            $data[] = array('userCount' => $dataProvider->getTotalItemCount());
            return CJSON::encode($data);
    }

    public function actionIndex()
    {
        $model = new User;

        if( isset($_GET['pageSize']) && OmsGridView::validatePageSize($_GET['pageSize']) )
            $model->currentPageSize = $_GET['pageSize'];

        $model->dbCriteria->select = 'id,username,firstname,lastname,role,email,region,deleted';
        $model->dbCriteria->order='`t`.`username` ASC';

        if ( !isset($_GET['showDel']) || !$_GET['showDel'] ) {
            $model->dbCriteria->condition = '`t`.`deleted`=0';
        }

        $fields = new AdminSearchForm('search');

        if( isset($_GET['AdminSearchForm']) ){
            $fields->attributes = $_GET['AdminSearchForm'];

            if( $fields->validate() )
                $model->searchCriteria = $fields->getCriteria();
        }

        if ( isset($_GET['ajax']) ) {
            $dataProvider = $model->search();
            echo $this->prepareAjaxData($dataProvider);
            Yii::app()->end();
        } else {
            $this->render('index2',array('model'=>$model, 'fields'=>$fields));
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

    public function actionUser($id)
    {
        $response = CJSON::encode($this->loadModel($id)->getAttributes(array(
            'username', 'firstname', 'lastname', 'role', 'email', 'region', 'deleted'
        )));
        echo $response;
        Yii::app()->end();
    }

    /*=======USERS ACTIONS=========*/

    public function actionCreate()
    {
        $model = new User;
        $model->role = self::CUSTOMER;

        if( !empty( $_POST['User']) ) {
            $model->attributes = $_POST['User'];

            if($model->save()) {

                $this->assignRole( $model->role,$model->id );

                $this->actionIndex();
            }
        }


        $this->render('create',array(
            'model'=>$model,
        ));

    }
    public function actionRemove(){

        if(isset($_GET['id'])){
            $model = User::model()->findByPk($_GET['id']);
            $model->scenario = 'remove';
            $model->deleted = 1;

            if($model->save()){
                $this->actionIndex();
            } else{
                throw new \Exception(print_r($model->getErrors(), true));
            }
        }
    }

    public function actionEdit($id){
        $model = $this->loadModel($id);
        $model->scenario = 'edit';
        $model->password = false;

        if ( !empty($_POST['User'] ) ) {
            $model->attributes = $_POST['User'];

            if (strlen($model->password) == 0 ){
                if($model->save(true,array('username','role','firstname','lastname','email','region','deleted'))) {
                    $this->assignRole($model->role,$model->id,false);
                    $this->actionUser($id);
                }
            } else {
                if($model->save()) {
                    $this->assignRole($model->role,$model->id,false);
                    $this->actionUser($id);
                }
            }
        } else {
            $layoutOld = $this->layout;
            $this->layout = 'ajax';
            $this->render('edit2',array(
                'model'=>$model,
            ));
            $this->layout = $layoutOld;
        }
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

                $this->assignRole($duplicate->role, $duplicate->id);
                $this->actionIndex();
            }
        } else {
            $layoutOld = $this->layout;
            $this->layout = 'ajax';
            $this->render('duplicate2',array(
                'model'=>$model,
            ));
            $this->layout = $layoutOld;
        }
    }
}