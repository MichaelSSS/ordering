<?php
    Yii::app()->db
        ->createCommand('TRUNCATE `user_attempt`')
        ->execute();
?>