<?php

class SiteController extends Controller
{
    public $layout = 'login';
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error=Yii::app()->errorHandler->error) {
            if ( Yii::app()->request->isAjaxRequest ) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }


    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if ( UserIdentity::isBlocked($_SERVER['REMOTE_ADDR']) ) {
            $this->render('login-blocked');
            Yii::app()->end();
        } else {
            $model=new LoginForm;
            if ( isset($_POST['LoginForm']) ) {
                $model->attributes=$_POST['LoginForm'];

                if ( $model->validate() && $model->login() ) {
//                    var_dump(Yii::app()->createUrl(Yii::app()->user->homeController . '/index'));

                    $this->redirect(Yii::app()->createUrl('admin' . '/index'));
                } else {
                    $errorCode = $model->getErrorCode();
                    if ( $errorCode == LoginForm::ERROR_USER_LOGGED ) {
                        $this->redirect(array('site/warning','view'=>'login-already'));
                    } elseif ( $errorCode == LoginForm::ERROR_ACTIVE_LIMIT ) {
                        $this->redirect(array('site/warning','view'=>'login-limit'));
                    } elseif ( UserIdentity::isBlocked($_SERVER['REMOTE_ADDR']) ) {
                        $this->redirect(array('site/warning','view'=>'login-blocked'));
                    }
                }
            }

            if ( $rememberedName = Yii::app()->user->getRememberedName()) {
                $model->username = $rememberedName;
                $model->rememberMe = true;
            }
            // display the login form
            $this->render('login',array('model'=>$model));
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        parent::logout();
    }

    public function actionWarning($view)
    {
        $this->render($view);
    }

    public function actionConfig()
    {

        $dsn = Yii::app()->db->connectionString;
        $user = Yii::app()->db->username;
        $password = '';

        $dbh = new PDO($dsn, $user, $password);

        $dbh->exec('create table `AuthItem`
            (
               `name`                 varchar(64) not null,
               `type`                 integer not null,
               `description`          text,
               `bizrule`              text,
               `data`                 text,
               primary key (`name`)
            ) engine InnoDB');

        $dbh->exec('create table `AuthItemChild`
        (
           `parent`               varchar(64) not null,
           `child`                varchar(64) not null,
           primary key (`parent`,`child`),
           foreign key (`parent`) references `AuthItem` (`name`) on delete cascade on update cascade,
           foreign key (`child`) references `AuthItem` (`name`) on delete cascade on update cascade
        ) engine InnoDB');

        $dbh->exec('create table `AuthAssignment`
        (
           `itemname`             varchar(64) not null,
           `userid`               varchar(64) not null,
           `bizrule`              text,
           `data`                 text,
           primary key (`itemname`,`userid`),
           foreign key (`itemname`) references `AuthItem` (`name`) on delete cascade on update cascade
        ) engine InnoDB');

        $auth=Yii::app()->authManager;

        $auth->createRole('admin');
        $auth->createRole('supervisor');
        $auth->createRole('merchandiser');
        $auth->createRole('customer');

        $auth->assign('admin',1);
        $auth->assign('supervisor',2);
        $auth->assign('merchandiser',3);
        $auth->assign('customer',4);

        echo 'Roles have been created in database. Do not visit this link anymore';
    }

}