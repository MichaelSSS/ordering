<?php
        Yii::app()->db
            ->createCommand('TRUNCATE `user`')
            ->execute();

        $password = CPasswordHelper::hashPassword('aA1!');
        $command = Yii::app()->db->createCommand();

        $command->insert('user', array(
            'username' => 'admin01',
            'password' => $password,
                'role' => 'admin',
           'firstname' => "Izambard",
            'lastname' => "Brunnel",
               'email' => "a@a.com",
              'region' => "north",
        ));

        $command->insert('user', array(
            'username' => 'supervisor01',
            'password' => $password,
                'role' => 'supervisor',
           'firstname' => "Jakkard",
            'lastname' => "Stannok",
               'email' => "a@a.com",
              'region' => "south",
        ));

        $command->insert('user', array(
            'username' => 'merchandiser01',
            'password' => $password,
                'role' => 'merchandiser',
           'firstname' => "Ned",
            'lastname' => "Ludd",
               'email' => "a@a.com",
              'region' => "east",
        ));

        $command->insert('user', array(
            'username' => 'customer01',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Stephen',
            'lastname' => 'Somerset',
               'email' => 'Sonny@Renault.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer02',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Sonny',
            'lastname' => 'Boulware',
               'email' => 'Sonny@Blount.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer03',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Ralph',
            'lastname' => 'Buccleuch',
               'email' => 'Ralph@Icke.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer04',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Thomas',
            'lastname' => 'Aucoin',
               'email' => 'Stephen@Abercorn.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer05',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Malachi',
            'lastname' => 'Beauclerk',
               'email' => 'Malachi@Blount.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer06',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Theresa',
            'lastname' => 'Wrede',
               'email' => 'Sonny@Sandys.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer07',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Monta',
            'lastname' => 'Renault',
               'email' => 'Malachi@Renault.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer08',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Antawn',
            'lastname' => 'Berkeley',
               'email' => 'Anthony@Blount.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer09',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Sonny',
            'lastname' => 'Boozman',
               'email' => 'Sonny@Blount.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer10',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Ralph',
            'lastname' => 'Agre',
               'email' => 'Ralph@Abercorn.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer11',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Theresa',
            'lastname' => 'Yeend',
               'email' => 'Sonny@Sandys.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer12',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Zoe',
            'lastname' => 'Harewood',
               'email' => 'Zoe@Nyro.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer13',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Celeb',
            'lastname' => 'Schlumberger',
               'email' => 'Celeb@Renault.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer14',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Naomi',
            'lastname' => 'Tewes',
               'email' => 'Malachi@Sandys.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer15',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Thomas',
            'lastname' => 'Caius',
               'email' => 'Stephen@Icke.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer16',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Freda',
            'lastname' => 'Bagehot',
               'email' => 'Freda@Abercorn.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer17',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Wynonna',
            'lastname' => 'Godie',
               'email' => 'Stephen@Icke.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer18',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Zachery',
            'lastname' => 'Abercorn',
               'email' => 'Zoe@Abercorn.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer19',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Stephen',
            'lastname' => 'Taney',
               'email' => 'Sonny@Renault.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer20',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Zachery',
            'lastname' => 'Boutiette',
               'email' => 'Zoe@Icke.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer21',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Rise',
            'lastname' => 'Buyer',
               'email' => 'Ralph@Icke.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer22',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Zachery',
            'lastname' => 'Acer',
               'email' => 'Zoe@Abercorn.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer23',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Wynonna',
            'lastname' => 'Politte',
               'email' => 'Stephen@Nyro.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer24',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Rise',
            'lastname' => 'Nyro',
               'email' => 'Ralph@Nyro.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer25',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Anthony',
            'lastname' => 'Toews',
               'email' => 'Anthony@Sandys.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer26',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Naomi',
            'lastname' => 'Thome',
               'email' => 'Malachi@Sandys.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer27',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Chloe',
            'lastname' => 'Wodehouse',
               'email' => 'Celeb@Sandys.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer28',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Malachi',
            'lastname' => 'Beauchamp',
               'email' => 'Malachi@Blount.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer29',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Thomas',
            'lastname' => 'Ayscough',
               'email' => 'Stephen@Abercorn.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer30',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Freda',
            'lastname' => 'Bakker',
               'email' => 'Freda@Abercorn.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer31',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Isaac',
            'lastname' => 'Goodenough',
               'email' => 'Freda@Icke.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer32',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Monta',
            'lastname' => 'Rea',
               'email' => 'Malachi@Renault.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer33',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Wynonna',
            'lastname' => 'Pou',
               'email' => 'Stephen@Nyro.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer34',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Isaac',
            'lastname' => 'Groening',
               'email' => 'Freda@Icke.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer35',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Celeb',
            'lastname' => 'Blount',
               'email' => 'Celeb@Blount.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer36',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Antawn',
            'lastname' => 'Ros',
               'email' => 'Anthony@Renault.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer37',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Kiki',
            'lastname' => 'Reiser',
               'email' => 'Freda@Nyro.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer38',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Chloe',
            'lastname' => 'Seat',
               'email' => 'Celeb@Renault.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer39',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Chloe',
            'lastname' => 'Wouk',
               'email' => 'Celeb@Sandys.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer40',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Ralph',
            'lastname' => 'Ameche',
               'email' => 'Ralph@Abercorn.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer41',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Rise',
            'lastname' => 'Olivier',
               'email' => 'Ralph@Nyro.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer42',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Anthony',
            'lastname' => 'Sandys',
               'email' => 'Anthony@Renault.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer43',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Anthony',
            'lastname' => 'Winzet',
               'email' => 'Anthony@Sandys.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer44',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Antawn',
            'lastname' => 'Bohun',
               'email' => 'Anthony@Blount.north.com',
              'region' => 'north',
        ));
        $command->insert('user', array(
            'username' => 'customer45',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Kiki',
            'lastname' => 'Rehm',
               'email' => 'Freda@Nyro.west.com',
              'region' => 'west',
        ));
        $command->insert('user', array(
            'username' => 'customer46',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Zoe',
            'lastname' => 'Icke',
               'email' => 'Zoe@Nyro.east.com',
              'region' => 'east',
        ));
        $command->insert('user', array(
            'username' => 'customer47',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Celeb',
            'lastname' => 'Boisjoly',
               'email' => 'Celeb@Blount.south.com',
              'region' => 'south',
        ));
        $command->insert('user', array(
            'username' => 'customer48',
            'password' => $password,
                'role' => 'customer',
           'firstname' => 'Zoe',
            'lastname' => 'Broad',
               'email' => 'Zoe@Icke.east.com',
              'region' => 'east',
        ));

        Yii::app()->db
            ->createCommand('
                UPDATE `user`
                SET deleted=1
                WHERE username="customer43"
                    OR username="customer38"
                    OR username="customer28"
                    OR username="customer20"
                ')
            ->execute();
?>