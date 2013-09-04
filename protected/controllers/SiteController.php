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

}