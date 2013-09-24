<?php  Yii::app()->bootstrap->register('/css/bootstrap.css'); ?>
<?php  Yii::app()->bootstrap->register('/css/bootstrap-responsive.css'); ?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'credit-card-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=> true,'validateOnChange'=>false),
        'htmlOptions'=>array('class'=>'form-horizontal'),
        'action'=>'/index.php?r=creditcard/validate'
));
?>
<div class="container">
    <fieldset form="credit-card-form">
    <legend>Card Info</legend>
    <div class="field">
        <?php echo $form->dropDownListRow($model, 'credit_card_type', array(1=>'Visa',2=>'MasterCard',3=>'American Express',4=>'Maestro')); ?>
    </div>
    <div class="row-fluid">
        <?php echo $form->error($model,'credit_card_type'); ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldRow($model, 'credit_card_number', array('class'=>'span4','maxlength'=>16)); ?>
    </div>

    <!-- Modal -->

        <?php /*$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'errorMessage',
            // additional javascript options for the dialog plugin
            'options'=>array(
            'title'=>'Error',
            'autoOpen'=>false,
            ),));

        echo $form->error($model,'credit_card_number') ;

        $this->endWidget('zii.widgets.jui.CJuiDialog');*/?>

        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'errorModal')); ?>
        <div id="errorModal" class="modal hide" tabindex="-1" role="dialog" aria-hidden="true">
        <!-- Popup Header -->
        <div class="modal-header">
            <h4>Error</h4>
        </div>
        <!-- Popup Content -->
        <div class="modal-body">
            <p> <?php echo $form->error($model,'credit_card_number') ?> </p>
        </div>
        <!-- Popup Footer -->
        <div class="modal-footer">

            <!-- close button -->
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'OK',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
            <!-- close button ends-->
        </div>
        </div>
        <?php $this->endWidget(); ?>
    <!-- Modal -->

    <div class="row">
        <?php echo $form->textFieldRow($model, 'cvv2_code', array('class'=>'span4','maxlength'=>3)); ?>
    </div>
    <div class="row">
        <?php echo $form->error($model,'cvv2_code'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'expiry_date', array('class'=>'span4')); ?>
        <?php echo $form->dateField($model, 'expiry_date', array('class'=>'span4')); ?>
    </div>
    <div class="row">
        <?php echo $form->error($model,'expiry_date'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'start_date', array('class'=>'span4')); ?>
        <?php echo $form->dateField($model, 'start_date', array('class'=>'span4')); ?>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <?php echo $form->textFieldRow($model, 'issue_number', array('class'=>'span4')); ?>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'ajaxSubmit', 'label'=>'Ordering','htmlOptions'=>array('onClick'=>'js:document.location.href="index.php?r=creditcard/validate"'))); ?>
    </div>
    </fieldset>
</div>
<?php $this->endWidget(); ?>

