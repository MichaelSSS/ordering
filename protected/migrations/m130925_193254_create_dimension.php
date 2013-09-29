<?php

class m130925_193254_create_dimension extends CDbMigration
{
	public function up()
	{
		$this->createTable('dimension', array(
            'id_dimension' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
		    'dimension' => 'VARCHAR(255) NOT NULL',
        	'count_of_items' => 'INTEGER NOT NULL',
        ));
	
	$this->insert('dimension', array(
            'dimension' => 'Item',
            'count_of_items' => '1',
    ));
	$this->insert('dimension', array(
            'dimension' => 'Box',
            'count_of_items' => '5',
     ));
	$this->insert('dimension', array(
            'dimension' => 'Package',
            'count_of_items' => '10',
    ));
	        return true;
}
	public function down()
	{
        $this->dropTable('dimension');

        return true;
	} 


}