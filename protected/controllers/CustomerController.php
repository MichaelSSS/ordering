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
/*
			array('deny',
				'users'=>array('*'),
			),
*/
		);
	}

    public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, OmsGridView::$nextPageSize);
    }


    public function actionIndex()
    {
        $model = new Order;
        $model->customer = Yii::app()->user->getState('user_id');
        if( isset($_GET['pageSize']) && $this->validatePageSize($_GET['pageSize']) )
            $model->currentPageSize = $_GET['pageSize'];

        if( isset($_GET['Order']) ){

            $model->attributes = $_GET['Order'];


            if( $model->validate() )
                $model->searchCriteria = $model->getCriteria();

        }



        /*
                $fields = new CustomerSearchForm('search');
                if( isset($_GET['CustomerSearchForm']) ){

                    $fields->attributes = $_GET['CustomerSearchForm'];


                    if( $fields->validate() )
                        $model->searchCriteria = $fields->getCriteria();

                }

        */
        $this->render('index',array('model'=>$model, /*'fields' =>$fields*/));
    }

    public function actionDependentSelect()
    {
        $data  = new Order;
        if($_POST['Order']["filterCriteria"]=='1')
        {
            $data = $data->filterRoles;
            foreach($data as $value => $name)
            {
                echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
            }
        }
        else
        {
            $data = $data->filterStatuses;
            foreach($data as $value => $name)
            {
                echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
            }
        }

    }


}