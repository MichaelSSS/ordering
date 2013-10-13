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
        $model = new Order('search');

        if (isset($_GET['pageSize']) && $this->validatePageSize($_GET['pageSize']))
            $model->currentPageSize = $_GET['pageSize'];

        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $model->delivery_date =  Yii::app()->dateFormatter->format("yyyy-MM-dd",$model->delivery_date);
        $this->render('index', array('model' => $model));
    }

    public function actionEdit($id)
    {
        $model = new OrderDetails($id);
        $orderModel = Order::model()->findByPk($id);
        $orderModel->scenario = 'merchandiserEdit';

        if($orderModel->status == 'Ordered' )
        {
            $orderModel->trueOrderedStatus = 'checked';
        }
        if($orderModel->status == 'Delivered' )
        {
            $orderModel->trueDeliveredStatus = 'checked';
            $orderModel->trueOrderedStatus = 'checked';
        }
        if($orderModel->gift == 1){
            $orderModel->giftChecked = 'checked';
        }

        if(isset($_POST['sub'])){

            $orderModel->gift = (int)$_POST['Order']['gift'];

            if($_POST['Order']['uncheckOrderedStatus'] == 'ordered'){
                $orderModel->status = 'ordered';
            }
            if($_POST['Order']['uncheckDeliveredStatus'] == 'delivered'){
                $orderModel->status = 'delivered';
            }

            $orderModel->attributes = $_POST['Order'];

            if($orderModel->save()) {
               $this->redirect( array( 'merchandiser/index' ) );

            }
        }

        if(isset($_POST['ordered'])){

            if($orderModel->status != 'Delivered'){
                $orderModel->status = 'ordered';
            }
            $orderModel->attributes = $_POST['Order'];

            if($orderModel->save()) {
                $this->redirect( array( 'merchandiser/index' ) );

            }
        }

        $this -> render('details', array(
                'model' => $model->searchItem($id),
                'orderModel'=>$orderModel,
            )
        );

    }
    public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, OmsGridView::$nextPageSize);
    }

}