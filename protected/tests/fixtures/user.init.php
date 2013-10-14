<?php
    Yii::app()->db
        ->createCommand('TRUNCATE `user`')
        ->execute();
?>