
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name;
$url=Yii::app()->createUrl('site/forceLogin');

echo "<div class='row'>
    <div class='span7 offset2'>
        <fieldset>
            <legend class='text-error'>Warning</legend>
            <p>This user is already logged into the system under other browser. Please use another session or log out and try to log in again.</p>
            <p>Click <a href=" . $url . " >here</a>  to log in current browser. Your session in another browser will be ended</p>
        </fieldset>
    </div>
</div>";