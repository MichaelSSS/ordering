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
        $order = new Order();
        $orderDetails = new OrderDetails;
	    $cardInfo = new CreditCardFormModel();
 
        $orderDetails->setCustomer(Yii::app()->user->id);

        if (isset($_POST['ajax'])&&$_POST['ajax']==='orderForm')
        {
            echo CActiveForm::validate( array($order));
            Yii::app()->end();
        }


//          $this->redirect(array('customer/error','view'=>'/order/itemsEmpty'));
        $this->render('/order/create', array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'cardInfo' => $cardInfo,
        ));
    }

    public function actionSave()
    {
        $order = new Order();
        $orderDetails = new OrderDetails;
        $cardInfo = new CreditCardFormModel();

        $orderDetails->setCustomer(Yii::app()->user->id);

        $order->status = "Created";
        if (isset($_POST['Order']) && $_POST['Order']['id_order']=='') {

            $order->attributes = $_POST['Order'];

            $order->customer = Yii::app()->user->id;



            $items = $orderDetails->getOrderItems($order->customer);

            if($order->validate())
            {
                $order->save(false);
                foreach ($items as $item)
                {
                    $item->id_order = $order->id_order;
                    $item->save();
                }
                $this->redirect(Yii::app()->createUrl('customer/edit', array('id'=>$order->id_order)));
            }
        }else{
//            $order->setScenario('update');
            $order->attributes = $_POST['Order'];
            $order->save(true,array('totalQuantity','total_price','order_date','preferable_date','assignee'));
        }

    }
    public function actionOrder()
    {
        $order = new Order;
        $orderDetails = new OrderDetails;
        $orderDetails ->id_customer = Yii::app()->user->id;
        $cardInfo = new CreditCardFormModel();
// validate Credit Card Info
        $cardInfo->setScenario('validateCardInfo');
        if ( isset($_POST['CreditCardFormModel']))
//        if(isset($_POST['ajax']) && $_POST['ajax']==='horizontalForm')
            {
                foreach($_POST['CreditCardFormModel'] as $name=>$value)
                { $cardInfo->$name=$value; }
                echo CActiveForm::validate($cardInfo);
                Yii::app()->end();
            }
    }



    public function actionEdit($id){
        $order = Order::model()->findByPk($id);
        $orderDetails = new OrderDetails;//  $this->loadModel($id, "OrderDetails");
//        $orderDetails = new OrderDetails;

        $orderDetails->id_order = $id;
        $cardInfo = new CreditCardFormModel;
        $order->scenario = 'edit';
        $order->preferable_date = Yii::app()->dateFormatter->format("MM/dd/yyyy",$order->delivery_date);


        $this->render('/order/create',array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'cardInfo' => $cardInfo,
        ));
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