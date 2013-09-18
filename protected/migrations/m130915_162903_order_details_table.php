<?php

class m130915_162903_order_details_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('order_details', array(
            'id' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'order_id' => 'int(11) NOT NULL',
            'item_id' => 'int(11) NOT NULL',
            'quantity' => "INT(6) NOT NULL",
            'price' => "DECIMAL(12,2) NOT NULL",
        ));

        $this->insert('order_details', array(
            'order_id' => 4,
            'item_id' => 5,
            'quantity' => 3,
            'price' => '1200.00',
        ));


        $this->insert('order_details', array(
            'order_id' => 2,
            'item_id' => 1,
            'quantity' => 4,
            'price' => '1200.00',
        ));

        $this->insert('order_details', array(
            'order_id' => 4,
            'item_id' => 5,
            'quantity' => 3,
            'price' => '1200.00',
        ));

        $this->insert('order_details', array(
            'order_id' => 4,
            'item_id' => 5,
            'quantity' => 3,
            'price' => '1200.00',
        ));

        $this->insert('order_details', array(
            'order_id' => 4,
            'item_id' => 5,
            'quantity' => 3,
            'price' => '1200.00',
        ));

        $this->insert('order_details', array(
            'order_id' => 4,
            'item_id' => 5,
            'quantity' => 3,
            'price' => '1200.00',
        ));

        $this->insert('order_details', array(
            'order_id' => 4,
            'item_id' => 5,
            'quantity' => 3,
            'price' => '1200.00',
        ));

	}

	public function down()
	{
        $this->dropTable('order_details');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}