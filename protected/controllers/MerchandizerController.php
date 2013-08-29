<?php

class MerchandizerController extends Controller
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
				'roles'=>array('merchandizer'),
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
        echo 'merchandizer page goes here...';
    }

}