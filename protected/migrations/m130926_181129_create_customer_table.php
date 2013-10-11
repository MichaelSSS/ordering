<?php

class m130926_181129_create_customer_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('customer', array(
            'customer_id' => 'INTEGER NOT NULL PRIMARY KEY ',
            'account_balance' => 'DECIMAL(6,2) DEFAULT NULL',
            'customer_type' => "ENUM('Standart','Silver','Gold','Platinum')",
        ));


        $this->insert('customer', array(
            'customer_id' => '4',
            'account_balance' => 2000,
            'customer_type' => 'Gold',

        ));
        $this->insert('customer', array(
            'customer_id' => '5',
            'account_balance' =>1000,
            'customer_type' => 'Silver',

        ));

       return true;
    }

    public function down()
    {
        $this->dropTable('user');

        return true;
    }
}