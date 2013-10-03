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
        if ($_POST['Order']["filterCriteria"] == '1') {
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
//        error_reporting(0);
        $order = new Order();
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orderForm') {
            echo CActiveForm::validate(array($order));
            Yii::app()->end();
        }


        $currentItems = Yii::app()->session->get("OrderItems");

        if (!isset($currentItems))
            $currentItems = array();

        $orderDetails = OrderDetails::getOrderedItems($currentItems);

        $cardInfo = new CreditCardFormModel('required');


        $this->render('/order/create', array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'cardInfo' => $cardInfo,
        ));
    }

    public function actionSave()
    {
        $order = new Order;
        $cardInfo = new CreditCardFormModel();

        $currentItems = Yii::app()->session->get("OrderItems");

        $order->status = "Created";
        if (isset($_POST['Order'])) {
            $order->attributes = $_POST['Order'];
            $order->customer = Yii::app()->user->id;
            if ($order->validate()) {

                $order->save(false);
                foreach ($currentItems as $item) {
                    $orderDetails = new OrderDetails();
                    $orderDetails->attributes = $item;
                    $orderDetails->id_order = $order->id_order;
                    $orderDetails->price = Item::model()->findByPk($orderDetails->id_item)->price;
                    $orderDetails->save(false);

                }

            }
            $this->redirect(Yii::app()->createUrl('customer/index'));
        }
    }

    public function actionOrder()
    {
        $order = new Order;
        $orderDetails = new OrderDetails;
        $orderDetails->id_customer = Yii::app()->user->id;
        $cardInfo = new CreditCardFormModel();
// validate Credit Card Info
        if (isset($_POST['CreditCardFormModel'])) //        if(isset($_POST['ajax']) && $_POST['ajax']==='horizontalForm')
        {
            foreach ($_POST['CreditCardFormModel'] as $name => $value) {
                $cardInfo->$name = $value;
            }
            if ($cardInfo->credit_card_type == "4") {
                $cardInfo->setScenario('validateMaestroCardInfo');
            } else {
                $cardInfo->setScenario('validateCardInfo');
            }
            echo CActiveForm::validate($cardInfo);
            Yii::app()->end();
        }
    }


    public function actionCancel()
    {
        Yii::app()->session->remove("OrderItems");
        $this->redirect(Yii::app()->createUrl('customer/index'));
    }

    public function actionEdit($id)
    {
        $order = Order::model()->findByPk($id);
        $orderDetails = new OrderDetails; //  $this->loadModel($id, "OrderDetails");
//        $orderDetails = new OrderDetails;

        $orderDetails->id_order = $id;
        $cardInfo = new CreditCardFormModel;
        $order->scenario = 'edit';
        $order->preferable_date = Yii::app()->dateFormatter->format("MM/dd/yyyy", $order->delivery_date);


        $this->render('/order/create', array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'cardInfo' => $cardInfo,
        ));
    }

    public function actionAddItem()
    {
        $model = new Item('search');
        $orderDetails = new OrderDetails;
        if (isset($_GET['Item']))
            $model->attributes = $_GET['Item'];

        $this->render('/order/addItem', array(
            'model' => $model,
            'orderDetails' => $orderDetails
        ));
    }

    public function actionError($view)
    {
        $this->render($view);
    }

    public function actionAdd()
    {

        $item = Item::model()->findByPk($_GET['item_id']);

        // Получаем автора записи. Здесь будет выполнен реляционный запрос.
        $item_name = $item->name;
        $item_price = $item->price;
                $item_quantity=$item->quantity;
        echo '{"item_name":"' . $item_name . '",
                    "item_price":"'.$item_price.'", 
                    "item_quantity":"'.$item_quantity.'" }';

    }

    public function actionSaveItem()
    {

        $order = new Order;
        $cardInfo = new CreditCardFormModel();
        $model = new OrderDetails();


        if (isset($_POST['OrderDetails'])) {

            $currentItems = Yii::app()->session->get("OrderItems");
            $currentItems[] = $_POST['OrderDetails'];
            Yii::app()->session->add("OrderItems", $currentItems);
            /*$model->attributes = $_POST['OrderDetails'];
            if($model->save()){
                 $this->redirect(Yii::app()->createUrl('customer/create'));
            }*/
        }
        $orderDetails = new CArrayDataProvider($currentItems);
        $this->redirect(Yii::app()->createUrl('customer/create'));


    }
}