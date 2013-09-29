<?php

class m130925_193254_create_orderDetails extends CDbMigration
{
	public function up()
	{
		$this->createTable('order_details', array(
            'id_order' => 'INTEGER NOT NULL PRIMARY KEY',
            'id_item' => 'INTEGER NOT NULL PRIMARY KEY',
            'id_dimension' => 'INTEGER NOT NULL PRIMARY KEY',
            'id_customer' => 'INTEGER NOT NULL PRIMARY KEY',
            'quantity' => "INTEGER NOT NULL",
            'price' => 'DECIMAL(6,2) NOT NULL',
        ));
	
	$this->insert('order_details', array(
            'id_order' => '1',
            'id_item' => '1',
            'id_dimension' => '1',
            'id_customer' => 4,
            'quantity' => "10",
            'price' => 2200,
    ));
	$this->insert('order_details', array(
            'id_order' => '2',
            'id_item' => '2',
            'id_dimension' => '2',
        'id_customer' => 4,
            'quantity' => "20",
        'price' => 2200.22,
    ));
	$this->insert('order_details', array(
            'id_order' => '3',
            'id_item' => '3',
            'id_dimension' => '3',
        'id_customer' => 4,
            'quantity' => "30",
            'price' => 265.22,
    ));
	        return true;
}
	public function down()
	{
        $this->dropTable('order_details');

        return true;
	} 


}