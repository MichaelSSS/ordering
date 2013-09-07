<?php

class SupervisorController extends Controller
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
				'roles'=>array('supervisor'),
			),

			array('deny',
				'users'=>array('*'),
			),

		);
	}
 


    public function actionIndex()
    {
        echo 'supervisor page goes here...';
    }

}