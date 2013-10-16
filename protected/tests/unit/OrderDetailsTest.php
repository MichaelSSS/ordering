<?php
class OrderDetailsTest extends CDbTestCase
{

    public $fixtures = array(
        'orders' => 'Order',
        'details' => 'OrderDetails',
        'dimensions' => 'Dimension',
    );

    public function testGetOrderedItems()
    {
        $orderItems = array(
            array(
                'quantity' => 4,
                'id_item' => 2,
                'id_customer' => 4,
                'id_dimension' => 1,
            ),
            array(
                'quantity' => 2,
                'id_item' => 1,
                'id_customer' => 4,
                'id_dimension' => 3,
            ),
        );

        $provider = OrderDetails::getOrderedItems($orderItems);
        $this->assertInstanceOf('CArrayDataProvider', $provider);
        $this->assertEquals(2, count($provider->rawData));
    }

    public function testFindOrderDetails()
    {
        $order = $this->orders('order2');
        $items = OrderDetails::findOrderDetails($order->id_order);

        $this->assertNotEmpty($items);
    }


}