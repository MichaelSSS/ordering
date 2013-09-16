<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'order_name'); ?>
		<?php echo $form->textField($model,'order_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'order_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_price'); ?>
		<?php echo $form->textField($model,'total_price',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'total_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_discount'); ?>
		<?php echo $form->textField($model,'max_discount'); ?>
		<?php echo $form->error($model,'max_discount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery_date'); ?>
		<?php echo $form->textField($model,'delivery_date'); ?>
		<?php echo $form->error($model,'delivery_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assignee'); ?>
		<?php echo $form->textField($model,'assignee'); ?>
		<?php echo $form->error($model,'assignee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer'); ?>
		<?php echo $form->textField($model,'customer'); ?>
		<?php echo $form->error($model,'customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trash'); ?>
		<?php echo $form->textField($model,'trash'); ?>
		<?php echo $form->error($model,'trash'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->