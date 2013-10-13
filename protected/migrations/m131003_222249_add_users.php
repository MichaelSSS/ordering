<?php

class m131003_222249_add_users extends CDbMigration
{
	public function up()
	{
        $password = CPasswordHelper::hashPassword('aA1!');

        $this->insert('user', array(
            'username' => 'customer03',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Anabella",
            'lastname' => "Byron",
               'email' => "anb@nowhere.com",
              'region' => "east",
        ));

        $this->insert('user', array(
            'username' => 'customer04',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Alphonse",
            'lastname' => "Lamartine",
               'email' => "all@nowhere.com",
              'region' => "south",
        ));

        $this->insert('user', array(
            'username' => 'customer05',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Gotie",
            'lastname' => "Teofille",
               'email' => "got@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'customer06',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Elizabeth",
            'lastname' => "Hovard",
               'email' => "elh@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'customer07',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Clement",
            'lastname' => "Walladingen",
               'email' => "cw@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'customer08',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Henry",
            'lastname' => "Bessemer",
               'email' => "hbs@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'customer09',
            'password' => $password,
                'role' => 'customer',
           'firstname' => "Fransua",
            'lastname' => "Talma",
               'email' => "fta@nowhere.com",
              'region' => "north",
        ));

        $this->insert('user', array(
            'username' => 'customer10',
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