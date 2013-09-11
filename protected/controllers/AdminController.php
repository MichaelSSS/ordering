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

			array('deny',
				'users'=>array('*'),
			),

		);
	}
 
    public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, OmsGridView::$nextPageSize);
    }


    public function actionIndex()
    {
        $model = new User;

        if( isset($_GET['pageSize']) && $this->validatePageSize($_GET['pageSize']) )
            $model->currentPageSize = $_GET['pageSize'];


        $fields = new AdminSearchForm('search');

        if( isset($_GET['AdminSearchForm']) ){
            $fields->attributes = $_GET['AdminSearchForm'];

            if( $fields->validate() )
                $model->searchCriteria = $fields->getCriteria();

        }                
        if ( isset($model->searchCriteria['condition']) ) {
            $model->searchCriteria['condition'] = '(' . $model->searchCriteria['condition'] . ') AND `t`.`deleted`=0';
        } else {
            $model->searchCriteria['condition'] = '`t`.`deleted`=0';

        }
        $this->render('index',array('model'=>$model, 'fields'=>$fields));
    }

}