<!--- ,'htmlOptions'=>array('style'=>array('box-sizing:content-box;') --->
<?php  Yii::app()->bootstrap->register('/css/bootstrap.css'); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<?php  //Yii::app()->bootstrap->register('/css/bootstrap-responsive.css'); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'credit-card-form',
        'action'=>'index.php?r=creditcard/validatecc',
        'type'=>'horizontal',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=> true,'validateOnChange'=>false,
            'afterValidate'=>'js:function(form,data,hasError)
            {
               if (hasError)
                   {
                   $("#errorModal").modal(\'show\').on(\'shown\', function()
                    {
                        $("#errorMessage").html($("[id$=\'_em_\']"));
                    }
                   );
               };
            }'),
));
?>
<?php $this->renderPartial('/creditcard/ErrorModal'); ?>

    <fieldset form="credit-card-form">
    <legend>Card Info</legend>
        <?php echo $form->dropDownListRow($model, 'credit_card_type', array(1=>'Visa',2=>'MasterCard',3=>'American Express',4=>'Maestro'),array('labelOptions' => array('class'=>'required'))); ?>
        <?php echo $form->textFieldRow($model, 'credit_card_number', array('labelOptions'=>array('class'=>'control-label'),'maxlength'=>'16','errorOptions'=>array('class'=>'error'))); ?>
        <?php echo $form->textFieldRow($model, 'cvv2_code', array('labelOptions'=>array('class'=>'control-label'),'maxlength'=>'3')); ?>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'expiry_date', array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->dateField($model, 'expiry_date'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'start_date', array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->dateField($model, 'start_date'); ?>
            </div>
        </div>
        <?php echo $form->textFieldRow($model, 'issue_number', array('labelOptions'=>array('class'=>'control-label'))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Ordering')); ?>
        <div class="control-group">
        <?php //echo CHtml::submitButton('Ordering'); ?>
        </div>
    </fieldset>
<?php $this->endWidget(); ?>

