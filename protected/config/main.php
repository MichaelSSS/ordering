<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Order Management System',

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
        'bootstrap.helpers.TbHtml',
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
            'class'=>'OmsWebUser',
            //'class'=>'RoledWebUser',
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager'=>array(
            'baseUrl' => ''
            /*
            'urlFormat'=>'path',
            'showScriptName'=>false,

            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
            */
        ),

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=oms',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
            'charset' => 'utf8',
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'enabled'=>YII_DEBUG,
            'routes'=>array(
                array(
                    // направляем результаты профайлинга в ProfileLogRoute (отображается
                    // внизу страницы)
                    'class'=>'CProfileLogRoute',
                    'levels'=>'profile',
                    'enabled'=>true,
                ),

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
            'assignmentTable' => 'auth_assignment',
            'itemTable' => 'auth_item',
            'itemChildTable' => 'auth_item_child',
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page

        'maxCredentialAttempts'=>5,
        'blockSeconds'=>600,
        'adminEmail'=>'webmaster@example.com',
        'secondsBeforeDisactivate'=>6000,
    ),
);