
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name; ?>

<div class="container">
    <div class="row6 offset2">
        <div class="span6">
        <fieldset>
            <legend>Warning message</legend>

            <p>User credentials were entered incorrectly. Page is locked for 10 minutes. Please try again later.</p>

        </fieldset>
            
        </div>
    </div>
<a href=<?php echo Yii::app()->createUrl('site/config');?> >Click me once</a>
</div>
</body>
</html>




