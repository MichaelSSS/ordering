
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */ 
?>

<link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/login.css' />

<a href=<?php echo Yii::app()->createUrl('site/config');?> class='span6 offset3'>Click me once</a>

<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'login-form',
        'type'                   => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions'          => array(
            'validateOnSubmit'   => true
        ),            
        'htmlOptions'            => array(
            'class'              => 'inline',  
        ),
    ));
?>

<div class='row'>
    <fieldset class='span5 offset3'>
        <legend>order management system</legend>

        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span4')); ?>

        <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span4')); ?>

        <div class='row'>
            <div class='span4'>
                <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
            </div>
            <div class='pull-right'>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type'       => 'info',
                    'label'      => 'login'
                    ));
                ?>
            </div>
        </div>
    </fieldset>
</div>

<?php $this->endWidget(); ?>

  













