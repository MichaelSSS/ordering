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

    public  function actionValidateOrder(){
        if(Yii::app()->session->get("orderId"))
        {
            $order = new Order('edit');
        }
        else
        {
            $order = new Order;
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orderForm') {
                echo CActiveForm::validate(array($order));
                Yii::app()->end();
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
        $order->scenario = 'create';
        $currentItems = Yii::app()->session->get("OrderItems");

        if (!isset($currentItems))
            $currentItems = array();

        $orderDetails = OrderDetails::getOrderedItems($currentItems);

        $cardInfo = new CreditCardFormModel('not_required');

        $this->render('/order/create', array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'cardInfo' => $cardInfo,
        ));
    }

    public function actionSave()
    {

        $order = new Order('save');

        $currentItems = Yii::app()->session->get("OrderItems");

        $order->status = "Created";

        if (isset($_POST['Order'])) {
            $order->attributes = $_POST['Order'];
            $order->customer = Yii::app()->user->id;
            if ($order->validate()) {
                $order->save(false);
                foreach ($currentItems as $item) {
                    $orderDetails = new OrderDetails('save');
                    $orderDetails->attributes = $item;
                    $orderDetails->id_order = $order->id_order;
                    $orderDetails->price = Item::model()->findByPk($orderDetails->id_item)->price;
                    $orderDetails->save(false);

                }

            }
            $this->redirect(Yii::app()->createUrl('customer/index'));
        }




    }

    public function prepareAjaxData($data){
        $res[] = $data;
        return CJSON::encode($res);
    }

    public function actionOrder()
    {
        $order = new Order('order');
        $orderDetails = new OrderDetails;
        $orderDetails->id_customer = Yii::app()->user->id;
        $cardInfo = new CreditCardFormModel('required');
// validate Credit Card Info
        if (isset($_POST['CreditCardFormModel']))
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
        Yii::app()->session->remove("orderId");
        $this->redirect(Yii::app()->createUrl('customer/index'));
    }

    public function actionEdit($id)
    {
        $order = Order::model()->findByPk($id);
        Yii::app()->session->add("orderId", $id);

        $orderDetails = OrderDetails::findOrderDetails($id);

        $currentItems = Yii::app()->session->get("OrderItems");

        if (isset($currentItems))
        {
            $orderDetails = array_merge($orderDetails->rawData, OrderDetails::getOrderedItems($currentItems)->rawData) ;
        }

        $orderDetails = new CArrayDataProvider($orderDetails, array('keyField' => false));
        $order->currentName =  $order->order_name;


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

        if (isset($_POST['OrderDetails'])) {
            $currentItems = Yii::app()->session->get("OrderItems");
            $currentItems[] = $_POST['OrderDetails'];
            Yii::app()->session->add("OrderItems", $currentItems);

        }



        if(Yii::app()->session->get("orderId"))
        {
            $this->redirect(Yii::app()->createUrl('customer/edit', array('id' => Yii::app()->session->get("orderId"))));
        }
        $this->redirect(Yii::app()->createUrl('customer/create'));

    }
}