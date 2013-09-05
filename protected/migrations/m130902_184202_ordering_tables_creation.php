<?php

class m130902_184202_ordering_tables_creation extends CDbMigration
{
	public function up()


	{

        $this->createTable('{{order}}', array(
            'id_order' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'order_name' => 'VARCHAR(128) NOT NULL',
            'total_price' => 'DECIMAL(12,2) NOT NULL',
            'max_discount' => "INT(4) NOT NULL",
            'delivery_date' => "DATE NOT NULL",
            'status' => "ENUM('Created','Pending','Ordered','Delivered')",
            'assignee' => "int(11) NOT NULL ",

        ));
        $this->addForeignKey('FK_user', '{{order}}','assignee', '{{user}}', 'id' );

        $this->insert('{{order}}', array(
            'order_name' => 'aaa 1',
            'total_price' => '152.00',
            'max_discount' => '2',
            'delivery_date' => '2002-11-09',
            'status' => 'Delivered',
            'assignee' => 4,
        ));


        $this->insert('{{order}}', array(
            'order_name' => 'aaa 2',
            'total_price' => '1002.2',
            'max_discount' => '20',
            'delivery_date' => '2012-12-08',
            'status' => 'Ordered',
            'assignee' => 4,
        ));


        $this->insert('{{order}}', array(
            'order_name' => 'aaa 3',
            'total_price' => '5892.1',
            'max_discount' => '40',
            'delivery_date' => '2009-10-11',
            'status' => 'Pending',
            'assignee' => 4,
        ));


        $this->insert('{{order}}', array(
            'order_name' => 'aaa 4',
            'total_price' => '1402.29',
            'max_discount' => 15,
            'delivery_date' => '2007-08-01',
            'status' => 'Created',
            'assignee' => 4,
        ));


    }

	public function down()
	{
		$this->dropTable('{{order}}');
		return true;
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