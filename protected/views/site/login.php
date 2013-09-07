
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name; ?>

<!doctype html>
<html lang="en">
<head>
    
    <!-- <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" /> -->
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="row6 offset2">
        <div class="span6">
        <fieldset>
            <legend>order management system</legend>


           <?php /** @var BootActiveForm $form */
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'login-form',
            	'enableClientValidation'=>true,
            	'clientOptions'=>array(
        	    	'validateOnSubmit'=>true,
            	),                 
                'type'=> 'inline',
                'htmlOptions'=>array('class'=>'well',
                  'checkbox' =>'inline'),
                ));
            ?>
            <div class="row">
              <div class="span4 ">
                 <?php echo $form->label($model, 'username', array('class'=>'span4')); ?>
                 <?php echo $form->textFieldRow($model, 'username', array('class'=>'span4')); ?>
                <?php echo $form->error($model, 'username', array('help'=>'span4')); ?>
              </div>
               <p></p>
            </div>
            <div class="row ">
            <div class="span4">
              <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span4')); ?>
                <?php echo $form->error($model, 'password', array('help'=>'span4')); ?>
            </div>
                
            </div>
            <div class="row">
              <div class="span4 ">
                <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
                
                
         
             <p> <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Login')); ?></p>
              </div>

            </div>
            <?php $this->endWidget(); ?>

        </fieldset>
            
        </div>
    </div>
</div>
</body>
</html>




