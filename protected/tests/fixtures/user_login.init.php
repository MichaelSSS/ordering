<?php
    Yii::app()->db
        ->createCommand('TRUNCATE `user_login`')
        ->execute();
?>