
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name; ?>

<div class="container">
    <div class="row6 offset2">
        <div class="span6">
        <fieldset>
            <legend>&nbsp;Warning&nbsp;</legend>

            <p>This user is already logged into the system under other browser. Please use another session or log out and try to log in again.</p>

        </fieldset>
            
        </div>
    </div>
<a href=<?php echo Yii::app()->createUrl('site/config');?> >Click me once</a>
</div>
</body>
</html>




