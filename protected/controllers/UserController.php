<?php


class UserController extends Controller {

	public function actionCreate()
	{
		$model = new User;
		$model->role = 'admin';

		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];

			if($model->save()) {
				$this->redirect(array('admin/index'/*,'id'=>$model->id*/));
			}
		}


		$this->render('create',array(
			'model'=>$model,
		));

	}

}
	