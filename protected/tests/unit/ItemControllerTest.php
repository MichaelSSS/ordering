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
        'items' => 'Item',
    );

    public function testActionCreate()
    {
        $item = new Item;
        $item->setAttributes(array(
             'name' => 'item06',
        'description' => 'bla-bla-bla',
        'price' =>10,
        'quantity' => 4,
        ),false);

        $this->assertTrue($item->save(false));
       $this->assertEquals('item06', $item->name);
        $this->assertEquals(10.98, $item->price);
         $this->assertEquals(4, $item->quantity);
    }
    
   // public function testCheckDate()
   // {
    //    $order = new Order;
    //   $order->setAttributes(array(
      //  'order_name' => 'aaa03',
       // 'total_price' => '1230',
        //'max_discount' => '44',
        //'delivery_date' => '2012-03-26',
        //'preferable_date' => '2018-03-29',
        //'order_date' => '2012-03-23',
        //'status' => 'Pending',
        //'assignee' => 2,
        //'customer' => 4,
    //),false);

    //$this->assertTrue(!$order->checkDate($order->preferable_date));

    //}
}

