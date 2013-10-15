<?php
    Yii::app()->db
        ->createCommand('TRUNCATE `auth_assignment`')
        ->execute();
?>