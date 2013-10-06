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

			array('deny',
				'users'=>array('*'),
			),

		);
	}



    public function actionIndex()
    {
        $model = new Order;
        $this->render('index', array('model' => $model,));
    }

    public function actionEdit($id)
    {
        $model = new OrderDetails($id);
        $orderModel = Order::model()->findByPk($id);
        $this -> render('details', array('model' => $model->searchItem($id),'orderModel'=>$orderModel));

    }

}