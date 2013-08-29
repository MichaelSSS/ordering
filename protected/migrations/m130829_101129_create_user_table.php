<?php

class m130829_101129_create_user_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_user', array(
                  'id' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
        	'username' => 'VARCHAR(128) NOT NULL',
        	'password' => 'VARCHAR(128) NOT NULL',
                'role' => "ENUM('admin','supervisor','merchandizer','customer')",
        ));

        $password = CPasswordHelper::hashPassword('admin01');
        $this->insert('{{user}}', array(
            'username' => 'admin01',
            'password' => $password,
                'role' => 'admin',
        ));

        $password = CPasswordHelper::hashPassword('supervisor01');
        $this->insert('{{user}}', array(
            'username' => 'supervisor01',
            'password' => $password,
                'role' => 'supervisor',
        ));

        $password = CPasswordHelper::hashPassword('merchandizer01');
        $this->insert('{{user}}', array(
            'username' => 'merchandizer01',
            'password' => $password,
                'role' => 'merchandizer',
        ));

        $password = CPasswordHelper::hashPassword('customer01');
        $this->insert('{{user}}', array(
            'username' => 'customer01',
            'password' => $password,
                'role' => 'customer',
        ));

        return true;
        
	}

	public function down()
	{
        $this->dropTable('{{user}}');

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