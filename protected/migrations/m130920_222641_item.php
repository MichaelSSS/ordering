<?php

class m130920_222641_item extends CDbMigration
{
	public function up()
	{
		 $this->createTable('item', array(
            'Item_Number' => 'integer NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'Item_Name' => 'varchar(30)',
            'ItemDescription' => 'text',
			'Price'=>'integer',
			'Quantity'=>'integer'
        ));
	}

	public function down()
	{
		echo "m130920_222641_item does not support migration down.\n";
		return false;
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