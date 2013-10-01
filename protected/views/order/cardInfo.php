<!--- ,'htmlOptions'=>array('style'=>array('box-sizing:content-box;') --->
<?php  Yii::app()->bootstrap->register('/css/bootstrap.css'); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<?php  //Yii::app()->bootstrap->register('/css/bootstrap-responsive.css'); ?>
<script  type="text/javascript">
    // Form behaviour for Credit Card type
    $(document).ready(function()
    {
        var today_date = new Date();
        //$("#CreditCardFormModel_expiry_date").attr("value",today_date);
        $("#CreditCardFormModel_start_date").attr("disabled","disabled");
        $("#CreditCardFormModel_issue_number").attr("disabled","disabled");
    });

    function startDateEnable()
    {
        if ($("#CreditCardFormModel_credit_card_type").val()=="4")
        {
            $("#CreditCardFormModel_start_date").removeAttr("disabled");
            $("#CreditCardFormModel_issue_number").removeAttr("disabled");
        }
        else
        {
            $("#CreditCardFormModel_start_date").attr("disabled","disabled")
            $("#CreditCardFormModel_issue_number").attr("disabled","disabled");
        };
    }
</script>

<?php /*$formCreditCard = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'credit-card-form',
    'action'=>'index.php?r=customer/order',
    'type'=>'horizontal',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>false,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false,
        'afterValidate'=>'js:afterValidate'),
));
*/?>
<?php $this->renderPartial('/order/errorMessage'); ?>

<?php echo $formCreditCard->dropDownListRow($cardInfo, 'credit_card_type', array(1=>'Visa',2=>'MasterCard',3=>'American Express',4=>'Maestro'),array('labelOptions' => array('class'=>'required'),'onchange'=>'js:startDateEnable()')); ?>
<?php echo $formCreditCard->textFieldRow($cardInfo, 'credit_card_number', array('labelOptions'=>array('class'=>'control-label'),'maxlength'=>'16','errorOptions'=>array('class'=>'error'))); ?>
<?php echo $formCreditCard->textFieldRow($cardInfo, 'cvv2_code', array('labelOptions'=>array('class'=>'control-label'),'maxlength'=>'3')); ?>
<div class="control-group">
    <?php echo $formCreditCard->labelEx($cardInfo, 'expiry_date', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $formCreditCard->dateField($cardInfo, 'expiry_date'); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $formCreditCard->labelEx($cardInfo, 'start_date', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $formCreditCard->dateField($cardInfo, 'start_date', array('disabled'=>'disabled')); ?>
    </div>
</div>
<?php echo $formCreditCard->textFieldRow($cardInfo, 'issue_number', array('labelOptions'=>array('class'=>'control-label'),'disabled'=>'disabled')); ?>

<?php /*$this->endWidget(); */?>

