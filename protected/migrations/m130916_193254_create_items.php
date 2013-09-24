<?php

class m130916_193254_create_items extends CDbMigration
{
	public function up()
	{
		$this->createTable('item', array(
            'id_item' => 'INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT',
			'price' => 'DECIMAL(6,2) NOT NULL',
        	'name' => 'VARCHAR(255) NOT NULL',
        	'description' => 'VARCHAR(1000) NOT NULL',
            'quantity' => "INTEGER NOT NULL",
        ));
	
	$this->insert('item', array(
            'price' => '1',
            'name' => 'phone',
            'description' => 'apparatus for transmitting and receiving sound (mainly - human speech) at a distance. Modern phones transmit via electrical signals.',
            'quantity' => "67",
    ));
	$this->insert('item', array(
            'price' => '2',
            'name' => 'Tablet PC 2 Exclusives',
            'description' => 'Just about any tablet from an established, reputable manufacturer would easily perform the functions you need',
            'quantity' => "89",
     ));
	$this->insert('item', array(
            'price' => '3',
            'name' => 'phone',
            'description' => 'apparatus for transmitting and receiving sound (mainly - human speech) at a distance. Modern phones transmit via electrical signals.',
            'quantity' => "88",
    ));
	$this->insert('item', array(
            'price' => '4',
            'name' => 'iPad mini 16gb',
            'description' => 'The screen is 7.9 "(1024 x 768 pixels) with IPS-matrix / 16 million color / touch, capacitive / with oleophobic coating
Processor dual core Apple A5 (1GHz)
Wireless connectivity Wi-Fi (802.11a/b/g/n) / Bluetooth 4.0',
            'quantity' => "99",
    ));
	$this->insert('item', array(
            'price' => '5',
            'name' => 'iPod Nano 7Gen 16GB (PRODUCT) RED',
            'description' => 'The display on the player: 2.5 Audio: AAC, Protected AAC, HE-AAC, MP3, MP3 VBR, Audible, Apple Lossless, AIFF and WAV Video: MPEG-4, m4v, mp4, mov, H.264 Power supply: Li-Ion battery Built-in memory, GB 16',
            'quantity' => "100",
    ));
	        return true;
}
	public function down()
	{
        $this->dropTable('item');

        return true;
	} 


}