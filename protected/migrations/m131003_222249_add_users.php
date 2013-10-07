<?php

class m131003_222249_add_users extends CDbMigration
{
	public function up()
	{
        $password = CPasswordHelper::hashPassword('password');

        $this->insert('user', array(
            'username' => 'admin02',
            'password' => $password,
                'role' => 'admin',
           'firstname' => "Clement",
            'lastname' => "Walladingen",
               'email' => "cw@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'admin03',
            'password' => $password,
                'role' => 'admin',
           'firstname' => "Anabella",
            'lastname' => "Byron",
               'email' => "anb@nowhere.com",
              'region' => "east",
        ));

        $this->insert('user', array(
            'username' => 'admin04',
            'password' => $password,
                'role' => 'admin',
           'firstname' => "Alphonse",
            'lastname' => "Lamartine",
               'email' => "all@nowhere.com",
              'region' => "south",
        ));

        $this->insert('user', array(
            'username' => 'admin05',
            'password' => $password,
                'role' => 'admin',
           'firstname' => "Gotie",
            'lastname' => "Teofille",
               'email' => "got@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'admin06',
            'password' => $password,
                'role' => 'admin',
           'firstname' => "Elizabeth",
            'lastname' => "Hovard",
               'email' => "elh@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'customer03',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Henry",
            'lastname' => "Bessemer",
               'email' => "hbs@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'customer04',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Fransua",
            'lastname' => "Talma",
               'email' => "fta@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'customer05',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Josef",
            'lastname' => "Grimaldi",
               'email' => "jgr@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'merchandiser02',
            'password' => $password,
                'role' => 'merchandiser',
           'firstname' => "Lafayet",
            'lastname' => "Fokke",
               'email' => "lafo@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'merchandiser03',
            'password' => $password,
                'role' => 'merchandiser',
           'firstname' => "Olkok",
            'lastname' => "Rezerford",
               'email' => "lafo@nowhere.com",
              'region' => "south",
        ));

        $this->insert('user', array(
            'username' => 'supervisor02',
            'password' => $password,
                'role' => 'supervisor',
           'firstname' => "Jak",
            'lastname' => "Bertilion",
               'email' => "jak@nowhere.com",
              'region' => "west",
        ));

        $this->insert('user', array(
            'username' => 'supervisor03',
            'password' => $password,
                'role' => 'supervisor',
           'firstname' => "Charles",
            'lastname' => "Dulittle",
               'email' => "chd@nowhere.com",
              'region' => "west",
        ));


	}

	public function down()
	{
		echo "m131003_222249_add_users does not support migration down.\n";
		return false;
	}

}