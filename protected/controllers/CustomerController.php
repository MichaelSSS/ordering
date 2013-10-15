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

    public function loadModel($id)
    {
        $model=Order::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionIndex()
    {
        $model = new Order('search');

        $model->customer = Yii::app()->user->id;




        if( isset($_GET['pageSize']) && OmsGridView::validatePageSize($_GET['pageSize']) )
        {
            $model->currentPageSize = $_GET['pageSize'];
        }


        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('index', array('model' => $model,));
    }

    public  function actionResetFilter(){
        $model = new Order('search');
        if( isset($_GET['pageSize']) && OmsGridView::validatePageSize($_GET['pageSize']) )
        {
            $model->currentPageSize = $_GET['pageSize'];
        }
        if( isset($_GET['reset']))
        {
            $model->customer = Yii::app()->user->id;
            $this->renderPartial('grid', array('model' => $model,));
        }
    }

    public function actionRemove()
    {
        if(isset($_GET['id']))
        {
            if(Order::deleteOrder($_GET['id']))
                $this->redirect(Yii::app()->createUrl('customer/index'));
        }
    }

    public function actionCreate()
    {
        $order = new Order;
        $cardInfo = new CreditCardFormModel('not_required');
        $order->scenario = 'create';
        $currentItems = Yii::app()->session->get("OrderItems");

        if (!isset($currentItems))
            $currentItems = array();

        $orderDetails = OrderDetails::getOrderedItems($currentItems);
        $currentItems = Yii::app()->session->get("OrderItems");
        $order->order_date = date('m/d/Y');

        $this->render('/order/create', array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'cardInfo' => $cardInfo,
        ));
    }

    public function actionSave()
    {
      $orderId =  Yii::app()->session->get("orderId");
        if(!isset($orderId))
        {
            $order = new Order('save');
        }else
        {
            //$order =  $this->loadModel(Yii::app()->session->get("orderId"));
           /* $orderDet = Order::model()->findByPk(Yii::app()->session->get("orderId"));
             
               $orderDet->delete();
               $orderDet->save();*/
               $order = new Order('save');
                       
        }

        $currentItems = Yii::app()->session->get("OrderItems");

        if($currentItems === null)
            $currentItems = array();

        $order->status = "Created";
print_r($_POST['Order']);
        if (isset($_POST['Order']))
        {
            $order->attributes = $_POST['Order'];
            $order->customer = Yii::app()->user->id;
            if ($order->validate()) {
                if(!(Yii::app()->session->get("orderId")))
                {
                    $order->save();
                }else
                {
                    $order->save(false, array('order_name','total_price','preferable_date', 'assignee'));
                }

                foreach ($currentItems as $item) {
                    $orderDetails = new OrderDetails('save');
                    $orderDetails->attributes = $item;
                    $orderDetails->id_order = $order->id_order;
                    $orderDetails->price = Item::model()->findByPk($orderDetails->id_item)->price;
                    $orderDetails->save(false);
                }
            }
            Yii::app()->session->remove("OrderItems");
            Yii::app()->session->remove("orderId");
            Yii::app()->session->remove("edit");
           // $this->redirect(Yii::app()->createUrl('customer/edit'));
        }
    }

    public function actionOrder()
    {
        $order =  $this->loadModel(Yii::app()->session->get("orderId"));
        $customerInfo = new Customer();
        $cardInfo = new CreditCardFormModel('required');

        $order->status = "Pending";

        $order->max_discount = $customerInfo->getDiscount($order->customer);
        $order->save(true, array('status','max_discount'));

        $customerInfo->updateBalance($order->total_price, $order->customer);

        Yii::app()->session->remove("orderId");
        $this->redirect(Yii::app()->createUrl('customer/index'));
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
        $order->scenario = 'edit';
        $cardInfo = new CreditCardFormModel;
        Yii::app()->session->add("orderId", $id);
        
        $currentItems = Yii::app()->session->get("OrderItems");
        if(!isset($currentItems)){
            $currentItems = array();
        }
        $currentItemsOrder = OrderDetails::findOrderDetails($id);
        $edit = Yii::app()->session->get("edit");
        if(!isset($edit)){
            $orderDetails = array_merge($currentItems, $currentItemsOrder);
        Yii::app()->session->add("OrderItems", $orderDetails);
        Yii::app()->session->add("edit", 1);
        } 
        $orderDetails = Yii::app()->session->get("OrderItems");
            $orderDetails = OrderDetails::getOrderedItems($orderDetails)->rawData ;
        
      
        $orderDetails = new CArrayDataProvider($orderDetails, array('keyField' => false));
        $order->currentName =  $order->order_name;

        $this->render('/order/create', array(
            'order' => $order,
            'orderDetails' => $orderDetails,
            'cardInfo' => $cardInfo,
        ));
    }

    public function actionCheckChanges()
    {
        $res = Yii::app()->session->get("OrderItems");
        echo CJSON::encode($res);
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
            if(isset($_POST['OrderDetails']['key'])){
                $currentItems[$_POST['OrderDetails']['key']] = $_POST['OrderDetails'];
            }
            else{
                $currentItems[] = $_POST['OrderDetails'];
            }
            
            Yii::app()->session->add("OrderItems", $currentItems);

        }
        if(Yii::app()->session->get("orderId"))
        {
            $this->redirect(Yii::app()->createUrl('customer/edit', array('id' => Yii::app()->session->get("orderId"))));
        }
        $this->redirect(Yii::app()->createUrl('customer/create'));
    }

    public function actionRemoveItem()
    {
        if (isset($_GET['key']) && $_GET['key']!=0) {
            $currentItems = Yii::app()->session->get("OrderItems");
            foreach ($currentItems as $key=>$value){
                if($key == $_GET['key']){
                    unset($currentItems[$key]);
                }
            }
            Yii::app()->session->add("OrderItems", $currentItems);
            $this->redirect(Yii::app()->createUrl('customer/create'));
        }
        
    }
    
    public function actionEditItem()
    {
        if (isset($_GET['id'] ) && isset($_GET['key'])) {
        $model = Item::model()->findByPk($_GET['id']);
        $orderDetails = OrderDetails::model();

            $currentItems = Yii::app()->session->get("OrderItems");
           // Yii::app()->session->add("OrderItems", $currentItems);
        //    $currentItems
            $this->render('/order/editItem', array(
                'model' => $model,
                'key' => $_GET['key'],
                'currentItems'=>$currentItems,
                'orderDetails' => $orderDetails
        ));
        }
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

    public  function actionValidateOrder()
    {
        if(isset($_POST['order'])&&Yii::app()->session->get("orderId"))
        {
            $order = new Order('order');
            $cardInfo = new CreditCardFormModel('required');
        }
        elseif(Yii::app()->session->get("orderId"))
        {
            $order = new Order('edit');
            $cardInfo = new CreditCardFormModel('not_required');
        }
        else
        {
            $order = new Order;
            $cardInfo = new CreditCardFormModel('not_required');
        }

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orderForm') {
            echo CActiveForm::validate(array($order,$cardInfo ));
            Yii::app()->end();
        }
    }
    
    public function actionCanselItem(){
         if(Yii::app()->session->get("orderId"))
        {
            $this->redirect(Yii::app()->createUrl('customer/edit', array('id' => Yii::app()->session->get("orderId"))));
        }
        $this->redirect(Yii::app()->createUrl('customer/create'));
    }
}