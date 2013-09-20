<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../vendor/yiisoft/yii/framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');
Yii::$classMap = array(
            'PHPUnit_Extensions_Story_TestCase' => 'd:\mine\Web\yii\framework\test\PHPUnit\Extensions\Story\TestCase.php',
        );
Yii::createWebApplication($config);
