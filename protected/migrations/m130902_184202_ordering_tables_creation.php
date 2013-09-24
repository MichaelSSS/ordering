<?php

class m130902_184202_ordering_tables_creation extends CDbMigration
{
	public function up()


	{

        $this->createTable('order', array(
            'id_order' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'order_name' => 'VARCHAR(128) NOT NULL',
            'total_price' => 'DECIMAL(12,2) NOT NULL',
            'max_discount' => "INT(4) NOT NULL",
            'delivery_date' => "DATE NOT NULL",
            'order_date' => "DATE NOT NULL",
            'preferable_date' => "DATE NOT NULL",
            'status' => "ENUM('Created','Delivered','Ordered','Pending')",
            'assignee' => "int(11) NOT NULL ",
            'customer' => "int(11) NOT NULL ",
            'trash' => "tinyint(4) NOT NULL DEFAULT 0 ",

        ));
        //$this->addForeignKey('FK_user', 'order','assignee', 'user', 'id' );

        $this->insert('order', array(
            'order_name' => 'aaa 1',
            'total_price' => '152.00',
            'max_discount' => '2',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2002-11-09',
            'status' => 'Delivered',
            'assignee' => 3,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'aaa 2',
            'total_price' => '1002.2',
            'max_discount' => '20',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2012-12-08',
            'status' => 'Ordered',
            'assignee' => 1,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => 'rty4 2',
            'total_price' => '335.22',
            'max_discount' => '22',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2013-03-23',
            'status' => 'Delivered',
            'assignee' => 3,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'ffgtr 2',
            'total_price' => '5543.33',
            'max_discount' => '11',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '4120-12-08',
            'status' => 'Pending',
            'assignee' => 2,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'eer4 1',
            'total_price' => '12346.43',
            'max_discount' => '6',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '1954-02-19',
            'status' => 'Delivered',
            'assignee' => 3,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'vbnbt 2',
            'total_price' => '55632.22',
            'max_discount' => '5',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2019-07-22',
            'status' => 'Ordered',
            'assignee' => 4,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => '2344vv 2',
            'total_price' => '22356.15',
            'max_discount' => '66',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2017-09-01',
            'status' => 'Delivered',
            'assignee' => 4,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'gvfv5r 2',
            'total_price' => '5861.33',
            'max_discount' => '5',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2100-01-07',
            'status' => 'Pending',
            'assignee' => 1,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'ddwwd 2',
            'total_price' => '66543.23',
            'max_discount' => '12',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '1988-08-08',
            'status' => 'Ordered',
            'assignee' => 2,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => '1124 2',
            'total_price' => '2345.65',
            'max_discount' => '44',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2012-08-23',
            'status' => 'Created',
            'assignee' => 3,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'vccd 2',
            'total_price' => '1234.2',
            'max_discount' => '54',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2012-06-08',
            'status' => 'Ordered',
            'assignee' => 1,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'aaa 3',
            'total_price' => '5892.1',
            'max_discount' => '40',
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2009-10-11',
            'status' => 'Pending',
            'assignee' => 3,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => 'aaa 4',
            'total_price' => '1402.29',
            'max_discount' => 15,
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2007-08-01',
            'status' => 'Created',
            'assignee' => 2,
            'customer' => 5,
        ));


    }

	public function down()
	{
		$this->dropTable('order');
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