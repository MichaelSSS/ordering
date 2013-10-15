<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
				'basePath'=>dirname(__FILE__).'/../tests/fixtures_grigorov/',
			),

			'db'=>array(
				'connectionString'=>'mysql:host=localhost;dbname=oms_test',
			),

		),
        
	)
);
