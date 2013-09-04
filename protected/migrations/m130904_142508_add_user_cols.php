<?php

class m130904_142508_add_user_cols extends CDbMigration
{
	public function up()
	{
        ALTER TABLE '{{user}}' ADD COLUMN
    }

    public function down()
    {
        echo "m130904_142508_add_user_cols does not support migration down.\n";
        return false;
    }


}