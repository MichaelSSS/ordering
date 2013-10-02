
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name;
echo '

    <div class="row">
        <div class="span7 offset2">
        <fieldset>
            <legend>&nbsp;Warning message&nbsp;</legend>

            <p>System allows only 50 users to be logged in. 
               Please ' . CHtml::link('try again', array('site/login')) . ' later. Sorry for inconvenience.</p>
        </fieldset>  
        </div>
    </div> ';