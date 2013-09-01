<?php

class m130829_101129_create_user_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{user}}', array(
                  'id' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
        	'username' => 'VARCHAR(128) NOT NULL',
        	'password' => 'VARCHAR(128) NOT NULL',
                'role' => "ENUM('admin','supervisor','merchandiser','customer')",
           'firstname' => "VARCHAR(128)",
            'lastname' => "VARCHAR(128)",
               'email' => "VARCHAR(128)",
              'region' => "ENUM('north','south','west','east') DEFAULT 'north'",
             'deleted' => 'BIT(1) DEFAULT 0'
        ));

        $password = CPasswordHelper::hashPassword('admin01');
        $this->insert('{{user}}', array(
            'username' => 'admin01',
            'password' => $password,
                'role' => 'admin',
           'firstname' => "Izambard",
            'lastname' => "Brunnel",
               'email' => "a@a.com",
              'region' => "north",
        ));

        $password = CPasswordHelper::hashPassword('supervisor01');
        $this->insert('{{user}}', array(
            'username' => 'supervisor01',
            'password' => $password,
                'role' => 'supervisor',
           'firstname' => "Jakkard",
            'lastname' => "Stannok",
               'email' => "a@a.com",
              'region' => "south",
        ));

        $password = CPasswordHelper::hashPassword('merchandizer01');
        $this->insert('{{user}}', array(
            'username' => 'merchandiser01',
            'password' => $password,
                'role' => 'merchandiser',
           'firstname' => "Ned",
            'lastname' => "Ludd",
               'email' => "a@a.com",
              'region' => "east",
        ));

        $password = CPasswordHelper::hashPassword('customer01');
        $this->insert('{{user}}', array(
            'username' => 'customer01',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Thomas",
            'lastname' => "Newcomen",
               'email' => "a@a.com",
              'region' => "south",
        ));

        return true;
        
	}

	public function down()
	{
        $this->dropTable('{{user}}');

        return true;
	} 
}