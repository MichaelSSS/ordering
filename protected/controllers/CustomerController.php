<?php

class CustomerController extends Controller
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
				'roles'=>array('customer'),
			),

			array('deny',
				'users'=>array('*'),
			),

		);
	}



    public function actionIndex()
    {
        $model = new Order;
        //$assignee=Order::model()->with('assignees')->findAll();
      //var_dump($assignee);exit;


        $this->render('index',array('model'=>$model ));
    }



}