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
        $model = new User;

        if( isset($_GET['pageSize']) && $model->validatePageSize($_GET['pageSize']) )
            $model->currentPageSize = $_GET['pageSize'];


        $fields = new AdminSearchForm('search');

        if( isset($_GET['AdminSearchForm']) ){
            $fields->attributes = $_GET['AdminSearchForm'];

            if( $fields->validate() )
                $model->searchCriteria = $fields->getCriteria();

        }                
        
        $this->render('index',array('model'=>$model, 'fields'=>$fields));
    }

}