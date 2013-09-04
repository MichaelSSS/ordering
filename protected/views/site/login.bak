<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name;
?>

<div class="wide form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <fieldset><legend> Order Management System </legend>
    <table border="1">
        <tr>
            <td>
                <?php echo $form->labelEx($model,'username'); ?>
            </td>
            <td colspan=2>
        		<?php echo $form->textField($model,'username'); ?>
		        <?php echo $form->error($model,'username'); ?>
        	</td>
        </tr>
        <tr>
            <td>
            	<?php echo $form->labelEx($model,'password'); ?>
            </td>
            <td colspan=2>
        		<?php echo $form->passwordField($model,'password'); ?>
		        <?php echo $form->error($model,'password'); ?>
            </td>
    	</tr>
        <tr>
            <td>
            </td>
            <td>
        		<?php echo $form->checkBox($model,'rememberMe'); ?>
    	    	<?php echo $form->label($model,'rememberMe'); ?>
	    	    <?php echo $form->error($model,'rememberMe'); ?>
            </td>
            <td>
        		<?php echo CHtml::submitButton('Login'); ?>
        	</td>
        </tr>
    </table>
    </fieldset>
<?php $this->endWidget(); ?>
</div><!-- form -->
