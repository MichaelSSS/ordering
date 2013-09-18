<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
<<<<<<< HEAD
	'name'=>'Order management system',
=======
	'name'=>'Order Management System',
>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d

    'defaultController'=>'site/login',

	// preloading 'log' component
	'preload'=>array('log'),

    'aliases'=>array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
    ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
<<<<<<< HEAD
        'bootstrap.helpers.TbHtml',        
=======
        'bootstrap.helpers.TbHtml',
>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths' => array('bootstrap.gii'),
		),
	),

	// application components
	'components'=>array(
		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'user'=>array(
<<<<<<< HEAD
=======
            'class'=>'OmsWebUser',
>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d
            //'class'=>'RoledWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
<<<<<<< HEAD
		
		/*'urlManager'=>array(

=======

		'urlManager'=>array(
/*
>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d
			'urlFormat'=>'path',
            'showScriptName'=>false,

            'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
<<<<<<< HEAD

		),*/
		
=======
*/
		),

>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=oms',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
<<<<<<< HEAD
			'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
=======
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
			'charset' => 'utf8',
>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
<<<<<<< HEAD
			'routes'=>array(
=======
            'enabled'=>YII_DEBUG,
			'routes'=>array(
                array(
                    // направляем результаты профайлинга в ProfileLogRoute (отображается
                    // внизу страницы)
                    'class'=>'CProfileLogRoute',
                    'levels'=>'profile',
                    'enabled'=>true,
                ),

>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
<<<<<<< HEAD
			),
		),
       
	),
=======
              
                array(
                    'class' => 'CWebLogRoute',
                    'categories' => 'application',
                    'showInFireBug' => true
                ),
			),
		),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),
    ),
>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
<<<<<<< HEAD
=======

        'maxCredentialAttempts'=>5,
        'blockSeconds'=>600,
>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d
		'adminEmail'=>'webmaster@example.com',
        'secondsBeforeDisactivate'=>600,
	),
);