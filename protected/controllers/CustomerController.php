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
                'roles' => array('customer'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, OmsGridView::$nextPageSize);
    }

    public function actionIndex()
    {
        $model = new Order('search');
        $model->customer = Yii::app()->user->id;

        if (isset($_GET['pageSize']) && $this->validatePageSize($_GET['pageSize']))
            $model->currentPageSize = $_GET['pageSize'];

        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $model->delivery_date = $model->formatDate($model->delivery_date);
        $this->render('index', array('model' => $model,));
    }

    public function actionDependentSelect()
    {
        $data = new Order;
        if ($_POST['Order']["filterCriteria"] == '1')
        {
            $data = $data->filterRoles;
            foreach ($data as $value => $name) {
                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
             }
        } else {
            $data = $data->filterStatuses;
            foreach ($data as $value => $name) {
                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            }
        }
    }

    public function actionRemove()
    {
        if (isset($_GET['id'])) {
            $order = Order::model()->findByPk($_GET['id']);
            $order->scenario = 'remove';
            $order->trash = 1;
            if ($order->save())
                $this->redirect(Yii::app()->createUrl('customer/index'));
        }
    }

    public function actionCreate()
    {
        $order = new Order;
        $orderDetails = new OrderDetails;
	$modelCreditCard = new CreditCardFormModel();
	$orderDetails ->id_customer = Yii::app()->user->id;


        if (isset($_POST['ajax'])&&$_POST['ajax']==='horizontalForm')
        {
            echo CActiveForm::validate( array( $order));
            Yii::app()->end();
        }


        if (isset($_POST['Order'])) {

            $order->attributes = $_POST['Order'];
            $order->customer = Yii::app()->user->id;
            $order->status = "Created";

            $criteria = new CDbCriteria;
            $criteria->compare('id_customer',$order->customer );
            $criteria->compare('id_order',0 );

            $items = $orderDetails->findAll($criteria);
            if($order->validate())
            {
                $order->save(false);
                foreach ($items as $item)
                {
                    $item->id_order = $order->id_order;
                    $item->save();
                }
                $this->redirect(Yii::app()->createUrl('customer/index'));
            }



//          $this->redirect(array('customer/error','view'=>'/order/itemsEmpty'));
        }
        $this->render('/order/create', array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'modelCreditCard' => $modelCreditCard,
        ));
    }


    public function actionOrder()
    {

    }

    public function actionAddItem()
    {
        $model = new Item('search');
        if (isset($_GET['Item']))
            $model->attributes = $_GET['Item'];

        $this->render('/order/addItem',array(
            'model'=>$model,
        ));
    }

    public function actionError($view){
        $this->render($view);
    }
}