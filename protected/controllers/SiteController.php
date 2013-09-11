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
		$model=new LoginForm;

		if ( isset($_POST['LoginForm']) ) {
			$model->attributes=$_POST['LoginForm'];

            if ( $model->validate() && $model->login() ) {
                $this->redirect(Yii::app()->createUrl(Yii::app()->user->getState('role') . '/index'));
            }
		} else {
            $model->username = Yii::app()->user->getState('rememberedName');
        }

		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
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

        $auth->assign('admin','admin01');
        $auth->assign('supervisor','supervisor01');
        $auth->assign('merchandiser','merchandiser01');
        $auth->assign('customer','customer01');
        
        echo 'Roles have been created in database. Do not visit this link anymore';
    }

}