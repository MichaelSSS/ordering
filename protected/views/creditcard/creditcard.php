<?php  //Yii::app()->clientScript->registerCssFile('css/ccform.css'); ?>
<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'credit-card-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array('validateOnSubmit'=> true,'validateOnChange'=>false),
        'htmlOptions'=>array('class'=>'horizontal')
));
?>

    <fieldset form="credit-card-form">
    <legend>Card Info</legend>
    <div class="row">
        <?php echo $form->labelEx($model, 'credit_card_type', array('class'=>'span4')); ?>
        <?php echo $form->dropDownList($model, 'credit_card_type', array(1=>'Visa',2=>'MasterCard',3=>'American Express',4=>'Maestro'),array('class'=>'span4')); ?>
    </div>
    <div class="row">
        <?php echo $form->error($model,'credit_card_type'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'credit_card_number', array('class'=>'span4')); ?>
        <?php echo $form->textField($model, 'credit_card_number', array('class'=>'span4','maxlength'=>16)); ?>
    </div>
    <!-- Modal -->
    <div id="errorModal" class="modal hide">
        <div class="modal-header hide">
            <h3 id="errorModalLabel">Error</h3>
        </div>
        <div class="modal-body hide">
            <p><?php echo $form->error($model,'credit_card_number'); ?></p>
        </div>
        <div class="modal-footer hide">
            <button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
        </div>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'cvv2_code', array('class'=>'span4')); ?>
        <?php echo $form->textField($model, 'cvv2_code', array('class'=>'span4','maxlength'=>3)); ?>
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
        <?php echo $form->labelEx($model, 'issue_number', array('class'=>'span4')); ?>
        <?php echo $form->textField($model, 'issue_number', array('class'=>'span4')); ?>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Ordering')); ?>
        <?php //echo CHtml::submitButton('submit'); ?>
    </div>
    </fieldset>

<?php $this->endWidget(); ?>

