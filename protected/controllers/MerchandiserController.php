<?php

class MerchandiserController extends Controller
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
				'roles'=>array('merchandiser'),
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
        echo 'merchandiser page goes here...';
    }

}