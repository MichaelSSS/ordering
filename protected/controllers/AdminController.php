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
/*
			array('deny',
				'users'=>array('*'),
			),
*/
		);
	}
 


    public function actionIndex()
    {
        echo 'admin page goes here...';
    }

}