
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name; ?>

<div class="container">
    <div class="row6 offset2">
        <div class="span6">
        <fieldset>
            <legend>&nbsp;Warning message&nbsp;</legend>

            <p>System allows only 50 users to be logged in. Please try again later. Sorry for inconvenience.</p>

        </fieldset>
            
        </div>
    </div>
<a href=<?php echo Yii::app()->createUrl('site/config');?> >Click me once</a>
</div>
</body>
</html>




