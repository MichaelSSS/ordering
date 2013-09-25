<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Toshiba
 * Date: 23.09.13
 * Time: 23:40
 * To change this template use File | Settings | File Templates.
 */

class OrderControllerTest extends CDbTestCase {

    public $fixtures = array(
        'orders' => 'Order',
    );

    public function testActionCreate()
    {
        $order = new Order;
        $order->setAttributes(array(
            'order_name' => 'aaa03',
            'total_price' => '1230',
            'max_discount' => '44',
            'delivery_date' => '2012-03-26',
            'preferable_date' => '2012-03-29',
            'order_date' => '2012-03-23',
            'status' => 'Pending',
            'assignee' => 2,
            'customer' => 4,
        ),false);

        $this->assertTrue($order->save(false));
        $this->assertEquals('0', $order->trash);
    }
    /*
    public function testActionRemove()
    {
        $order = $this->orders('order1');
        $order->delete();

        $this->assertEquals('1', $order->trash);
    }
    */
    public function testCheckDate()
    {
        $order = new Order;
       $order->setAttributes(array(
        'order_name' => 'aaa03',
        'total_price' => '1230',
        'max_discount' => '44',
        'delivery_date' => '2012-03-26',
        'preferable_date' => '2018-03-29',
        'order_date' => '2012-03-23',
        'status' => 'Pending',
        'assignee' => 2,
        'customer' => 4,
    ),false);

    $this->assertTrue(!$order->checkDate($order->preferable_date));

    }
}
