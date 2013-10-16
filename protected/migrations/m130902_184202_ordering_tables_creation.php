<?php

class m130902_184202_ordering_tables_creation extends CDbMigration
{
	public function up()


	{

        $this->createTable('order', array(
            'id_order' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'order_name' => 'VARCHAR(128) NOT NULL',
            'total_price' => 'DECIMAL(12,2) NOT NULL',
            'auto_index' => 'INT(4)  NULL',
            'max_discount' => "INT(4) NOT NULL DEFAULT 0",
            'delivery_date' => "DATE NOT NULL DEFAULT '0000-00-00'",
            'preferable_date' => "DATE NOT NULL ",
            'order_date' => "DATE NOT NULL",
            'status' => "ENUM('Created','Delivered','Ordered','Pending')",
            'assignee' => "int(11) NOT NULL ",
            'customer' => "int(11) NOT NULL ",
            'trash' => "BIT(1) DEFAULT 0",
            'gift' => "BIT(1) DEFAULT 0",

        ));
        //$this->addForeignKey('FK_user', 'order','assignee', 'user', 'id' );

        $this->insert('order', array(
            'order_name' => 'aaa1',
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
            'order_name' => 'aaa2',
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
            'order_name' => 'rty42',
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
            'order_name' => 'ffgtr2',
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
            'order_name' => 'eer41',
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
            'order_name' => 'vbnbt2',
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
            'order_name' => '2344vv2',
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
            'order_name' => 'gvfv5r2',
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
            'order_name' => 'ddwwd2',
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
            'order_name' => '11242',
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
            'order_name' => 'vccd2',
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
            'order_name' => 'aaa3',
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
            'order_name' => 'aaa4',
            'total_price' => '1402.29',
            'max_discount' => 15,
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2007-08-01',
            'status' => 'Created',
            'assignee' => 2,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => 'aaa4',
            'total_price' => '1402.29',
            'max_discount' => 15,
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2007-08-01',
            'status' => 'Created',
            'assignee' => 2,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => 'christmas order',
            'total_price' => '1500',
            'max_discount' => 15,
            'order_date' => '2013-07-07',
            'preferable_date' => '2013-12-24',
            'delivery_date' => '0000-00-00',
            'status' => 'Pending',
            'assignee' => 2,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => '01',
            'total_price' => '14200',
            'max_discount' => 22,
            'order_date' => '2009-05-07',
            'preferable_date' => '2009-06-09',
            'delivery_date' => '2013-08-23',
            'status' => 'Delivered',
            'assignee' => 4,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'ddd2',
            'total_price' => '5620',
            'max_discount' => 2,
            'order_date' => '2013-10-15',
            'preferable_date' => '2013-10-18',
            'delivery_date' => '0000-00-00',
            'status' => 'Created',
            'assignee' => 3,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'tty4',
            'total_price' => '1402.29',
            'max_discount' => 15,
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2007-08-01',
            'status' => 'Created',
            'assignee' => 2,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => '123456',
            'total_price' => '123456',
            'max_discount' => 123456,
            'order_date' => '1234-05-06',
            'preferable_date' => '1234-07-09',
            'delivery_date' => '2200-08-13',
            'status' => 'Pending',
            'assignee' => 2,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'addt4',
            'total_price' => '1234',
            'max_discount' => 55,
            'order_date' => '2005-01-09',
            'preferable_date' => '2007-01-09',
            'delivery_date' => '2013-08-01',
            'status' => 'Ordered',
            'assignee' => 4,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'asdf3e',
            'total_price' => '1522',
            'max_discount' => 2,
            'order_date' => '2003-05-02',
            'preferable_date' => '2003-09-22',
            'delivery_date' => '2005-03-01',
            'status' => 'Delivered',
            'assignee' => 3,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'qwerrw',
            'total_price' => '123321',
            'max_discount' => 22,
            'order_date' => '2010-12-06',
            'preferable_date' => '2010-12-09',
            'delivery_date' => '2010-12-12',
            'status' => 'Delivered',
            'assignee' => 2,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'azqwe6',
            'total_price' => '968',
            'max_discount' => 99,
            'order_date' => '2012-02-05',
            'preferable_date' => '2012-11-09',
            'delivery_date' => '2013-08-01',
            'status' => 'Ordered',
            'assignee' => 1,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => '115896',
            'total_price' => '1500',
            'max_discount' => 15,
            'order_date' => '2001-01-01',
            'preferable_date' => '2002-02-02',
            'delivery_date' => '2003-03-03',
            'status' => 'Ordered',
            'assignee' => 3,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => '5541',
            'total_price' => '1503',
            'max_discount' => 5,
            'order_date' => '2005-05-28',
            'preferable_date' => '2005-05-30',
            'delivery_date' => '2005-06-01',
            'status' => 'Delivered',
            'assignee' => 4,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'fffddd',
            'total_price' => '1280',
            'max_discount' => 5,
            'order_date' => '2008-05-02',
            'preferable_date' => '2008-05-03',
            'delivery_date' => '2008-08-01',
            'status' => 'Ordered',
            'assignee' => 5,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => '1569',
            'total_price' => '558',
            'max_discount' => 16,
            'order_date' => '2012-11-06',
            'preferable_date' => '2012-11-15',
            'delivery_date' => '2014-08-01',
            'status' => 'Ordered',
            'assignee' => 2,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'qrew',
            'total_price' => '134',
            'max_discount' => 33,
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2007-08-01',
            'status' => 'Created',
            'assignee' => 2,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => 'aaa4',
            'total_price' => '1402.29',
            'max_discount' => 15,
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2007-08-01',
            'status' => 'Created',
            'assignee' => 2,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => 'aaee4',
            'total_price' => '4234',
            'max_discount' => 23,
            'order_date' => '2011-11-11',
            'preferable_date' => '2011-01-10',
            'delivery_date' => '0000-00-00',
            'status' => 'Pending',
            'assignee' => 2,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'adw2',
            'total_price' => '1250',
            'max_discount' => 12,
            'order_date' => '2013-02-21',
            'preferable_date' => '2200-11-09',
            'delivery_date' => '0000-00-00',
            'status' => 'Created',
            'assignee' => 4,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => '00001',
            'total_price' => '1233',
            'max_discount' => 11,
            'order_date' => '2003-03-12',
            'preferable_date' => '2003-05-28',
            'delivery_date' => '2003-09-11',
            'status' => 'Pending',
            'assignee' => 1,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => '1225',
            'total_price' => '1500',
            'max_discount' => 63,
            'order_date' => '2010-09-15',
            'preferable_date' => '2010-10-22',
            'delivery_date' => '2013-08-01',
            'status' => 'Delivered',
            'assignee' => 3,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => '12332',
            'total_price' => '223',
            'max_discount' => 4,
            'order_date' => '2010-10-10',
            'preferable_date' => '2011-11-11',
            'delivery_date' => '2012-12-12',
            'status' => 'Pending',
            'assignee' => 1,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'aaa4',
            'total_price' => '1402.29',
            'max_discount' => 15,
            'order_date' => '2013-11-09',
            'preferable_date' => '2013-12-06',
            'delivery_date' => '0000-00-00',
            'status' => 'Ordered',
            'assignee' => 4,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'gffr',
            'total_price' => '1402.29',
            'max_discount' => 15,
            'order_date' => '2002-11-09',
            'preferable_date' => '2002-11-09',
            'delivery_date' => '2007-08-01',
            'status' => 'Created',
            'assignee' => 2,
            'customer' => 5,
        ));


        $this->insert('order', array(
            'order_name' => '112233',
            'total_price' => '1520',
            'max_discount' => 6,
            'order_date' => '2013-08-10',
            'preferable_date' => '2013-08-23',
            'delivery_date' => '2013-08-23',
            'status' => 'Ordered',
            'assignee' => 2,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => '8888',
            'total_price' => '888',
            'max_discount' => 88,
            'order_date' => '1988-08-08',
            'preferable_date' => '1988-08-23',
            'delivery_date' => '2012-09-28',
            'status' => 'Delivered',
            'assignee' => 4,
            'customer' => 4,
        ));


        $this->insert('order', array(
            'order_name' => 'aaa000',
            'total_price' => '1000',
            'max_discount' => 10,
            'order_date' => '2013-10-15',
            'preferable_date' => '2013-10-17',
            'delivery_date' => '2013-10-17',
            'status' => 'Ordered',
            'assignee' => 2,
            'customer' => 4,
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