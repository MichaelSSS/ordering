<?php

class m130904_142508_create_user_login_table extends CDbMigration
{
	public function up()
	{
        try {
            $this->createTable('user_login', array(
                'id' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
                'user_id'=>'INTEGER NOT NULL',
                'last_action_time'=>'INTEGER',
                'user_agent'=>'VARCHAR(128)'
            ), 'ENGINE = MEMORY');
        } catch (Exception $e) {}

        try {
            $this->createTable('user_attempt', array(
                'id' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
                'user_ip'=>'VARCHAR(16) NOT NULL',
                'attempt_count'=>'TINYINT UNSIGNED',
                'blocked_until'=>'INTEGER'
            ), 'ENGINE = MEMORY');
        } catch (Exception $e) {}

        try {
            $this->alterColumn('tbl_user','role','ENUM("admin", "customer", "merchandiser", "supervisor")');
            $this->alterColumn('tbl_user','region','ENUM("east", "north", "south", "west") DEFAULT "north"');
        } catch (Exception $e) {}

        try {
            $this->update('authassignment',array('userid'=>"1"),'userid="admin01"');
            $this->update('authassignment',array('userid'=>"2"),'userid="supervisor01"');
            $this->update('authassignment',array('userid'=>"3"),'userid="merchandiser01"');
            $this->update('authassignment',array('userid'=>"4"),'userid="customer01"');
        } catch (Exception $e) {}

    }

    public function down()
    {
        $this->dropTable('user_login');
        $this->dropTable('user_attempt');

    }


}