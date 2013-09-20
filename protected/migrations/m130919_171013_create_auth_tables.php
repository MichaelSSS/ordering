<?php

class m130919_171013_create_auth_tables extends CDbMigration
{
	public function up()
	{
        $dbh = $this->dbConnection->pdoInstance;
        $dbh->exec('create table `auth_item`
        (
           `name`                 varchar(64) not null,
           `type`                 integer not null,
           `description`          text,
           `bizrule`              text,
           `data`                 text,
           primary key (`name`)
        ) engine InnoDB');

        $dbh->exec('create table `auth_item_child`
        (
           `parent`               varchar(64) not null,
           `child`                varchar(64) not null,
           primary key (`parent`,`child`),
           foreign key (`parent`) references `auth_item` (`name`) on delete cascade on update cascade,
           foreign key (`child`) references `auth_item` (`name`) on delete cascade on update cascade
        ) engine InnoDB');

        $dbh->exec('create table `auth_assignment`
        (
           `itemname`             varchar(64) not null,
           `userid`               varchar(64) not null,
           `bizrule`              text,
           `data`                 text,
           primary key (`itemname`,`userid`),
           foreign key (`itemname`) references `auth_item` (`name`) on delete cascade on update cascade
        ) engine InnoDB');

        $this->dbConnection->createCommand()->insert('auth_item', array(
            'name'=>'admin',
            'type'=>2,
        ));
        $this->dbConnection->createCommand()->insert('auth_item', array(
            'name'=>'customer',
            'type'=>2,
        ));
        $this->dbConnection->createCommand()->insert('auth_item', array(
            'name'=>'merchandiser',
            'type'=>2,
        ));
        $this->dbConnection->createCommand()->insert('auth_item', array(
            'name'=>'supervisor',
            'type'=>2,
        ));

        $this->dbConnection->createCommand()->insert('auth_assignment', array(
                'itemname'=>'admin',
                'userid'=>1,
            ));
        $this->dbConnection->createCommand()->insert('auth_assignment', array(
                'itemname'=>'customer',
                'userid'=>4,
            ));
        $this->dbConnection->createCommand()->insert('auth_assignment', array(
                'itemname'=>'merchandiser',
                'userid'=>3,
            ));
        $this->dbConnection->createCommand()->insert('auth_assignment', array(
                'itemname'=>'supervisor',
                'userid'=>2,
            ));
	}

	public function down()
	{
        $this->dropTable('auth_assignment');
        $this->dropTable('auth_item_child');
        $this->dropTable('auth_item');

	}

}