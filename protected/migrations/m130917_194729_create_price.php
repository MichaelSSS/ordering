<?php

class m130917_194729_create_price extends CDbMigration
{
	public function up()
	{

	$this->createTable('price', array(
            'id_price' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
			'id_item' => 'INTEGER NOT NULL',
        	'price' => 'INTEGER NOT NULL',
        	'date' => 'DATETIME',
        ));

	$this->insert('price', array(
			'id_item' => '1',
        	'price' => '10',
        	//'date' => '',
    ));
	$this->insert('price', array(
			'id_item' => '2',
        	'price' => '20',
        	//'date' => '',
     ));
	$this->insert('price', array(
			'id_item' => '3',
        	'price' => '30',
        	//'date' => '',
    ));
	$this->insert('price', array(
			'id_item' => '4',
        	'price' => '40',
        	//'date' => '',
    ));
	$this->insert('price', array(
			'id_item' => '5',
        	'price' => '50',
        	//'date' => '',
    ));
	        return true;
	}

	public function down()
	{
        $this->dropTable('price');
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