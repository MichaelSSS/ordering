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

        if($orderModel->status == 'Ordered' )
        {
            $orderModel->trueOrderedStatus = 'checked';

        }

        if($orderModel->status == 'Delivered' )
        {
            $orderModel->trueDeliveredStatus = 'checked';
            $orderModel->trueOrderedStatus = 'checked';

        }



        $this -> render('details', array(
                'model' => $model->searchItem($id),
                'orderModel'=>$orderModel,
            )
        );

    }

}