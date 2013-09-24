<?php

class m130920_222641_item extends CDbMigration
{
	public function up()
	{
		 $this->createTable('item', array(
            'Item_Number' => 'text',
            'Item_Name' => 'varchar(30)',
            'ItemDescription' => 'text',
			'Price'=>'integer',
			'Quantity'=>'integer',
             'Primary KEY()'
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