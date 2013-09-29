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
        $model->customer = Yii::app()->user->getState('user_id');

        if (isset($_GET['pageSize']) && $this->validatePageSize($_GET['pageSize']))
            $model->currentPageSize = $_GET['pageSize'];

        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $model->delivery_date = $model->formatDate($model->delivery_date);
        $this->render('index', array('model' => $model,));
    }
public $Item;

    public function actionEdit($id){

        $model = OrderDetails::model()->findByAttributes(array('order_id'=>$id));
        //$model = OrderDetails::model()->findByPk($id);
        //$itemModel = Item::model()->findByPk(array('order_id'=>$id));

        /*foreach ($model as $item) {
            echo 'itemId :'.$Item->name." quantity: ".$item->quantity;
            echo "<br>";
        }*/
        $this->render('details', array('model' => $model));

    }

}