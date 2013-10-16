<?php
class OrderTest extends CDbTestCase
{

    public $fixtures = array(
        'orders' => 'Order',
    );

    public function testCreate()
    {
        $order = new Order('save');
        $order->order_name = '232323';
        $order->total_price = 1230.22;
        $order->max_discount = 40;
        $order->preferable_date = '07/07/2007';
        $order->order_date = '06/06/2007';
        $order->status = 'Created';
        $order->assignee = 2;
        $order->customer = 4;
        $order->totalQuantity = 4;

        $this->assertTrue($order->save());

        $orderCount = Order::model()->count("order_name = :order_name", array(':order_name' => $order->order_name));
        $this->assertEquals(1, (int)$orderCount);
        $this->assertEquals(0, (int)$order->trash);
        $this->assertEquals('0000-00-00', $order->delivery_date);
        $this->assertEquals(0, (int)$order->gift);
    }

    public function testCheckAssignee()
    {
        $order = new Order;
        $order->assignee = 2;
        Yii::app()->user->id = 2;
        $this->assertFalse($order->checkAssignee($order->assignee));
    }

    public function testCreateOrderName()
    {
        $order = new Order;
        $order->order_name = "";

        $order->createOrderName();

        $this->assertNotEquals("", $order->order_name);

        $namesCount = Order::model()->count('order_name=:orderName', array(':orderName'=>$order->order_name));
        $this->assertEquals(0, (int)$namesCount);
    }

    public function testDeleteOrder()
    {
        $order = $this->orders('order1');
        $orderId = $order->id_order;

        $this->assertTrue(Order::deleteOrder($order->id_order));

        $orderCount = Order::model()->findByPk($orderId);
        $this->assertEquals(1, (int)$orderCount->trash);
    }

    public function testCheckDate()
    {
        $order = new Order();
        $order->order_date = "2013-10-14";
        $order->preferable_date = "2013-10-13";

        $this->assertFalse($order->checkDate($order->preferable_date));
    }

    public function testCheckEdit()
    {
        $order = $this->orders('order2');
        $order4 = $this->orders('order4');
        Yii::app()->session->add("orderId", $order->id_order);

        $order->order_name = 'aaa02';
        $this->assertTrue($order->checkEdit('order_name'));

        $order->order_name = '';
        $this->assertTrue($order->checkEdit('order_name'));

        $order->order_name = 'ssasdasds';
        $this->assertTrue($order->checkEdit('order_name'));

        $order->order_name = $order4->order_name;
        $this->assertFalse($order->checkEdit('order_name'));
    }

}