<?php


class UserController extends Controller {

        public function actionCreate()
    {
        $model = new User;
        $model->role = 'admin';

        if(isset($_POST['User'])) {
            $model->attributes=$_POST['User'];
            if($model->save()) {

                $roles = array(1=>'admin',3=>'merchandiser',2=>'supervisor',4=>'customer');            //+
                Yii::app()->authManager->assign($roles[$model->role],$model->username);                //+

                $this->redirect(array('admin/index'/*,'id'=>$model->id*/));
            }
        }


        $this->render('create',array(
            'model'=>$model,
        ));

    }

}
    