<!--- ,'htmlOptions'=>array('style'=>array('box-sizing:content-box;') --->
<?php  Yii::app()->bootstrap->register('/css/bootstrap.css'); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<?php  //Yii::app()->bootstrap->register('/css/bootstrap-responsive.css'); ?>
<script  type="text/javascript">
    // Form behaviour for Credit Card type
    $(function ()
    {
        var defDate =new Date().toLocaleDateString();
        $("#CreditCardFormModel_expiry_date").val(defDate);
        $("#CreditCardFormModel_start_date").val(defDate);

        $("#CreditCardFormModel_expiry_date").datepicker({
            showOn: "button",
            buttonImage: "/images/Calendar.png",
            buttonImageOnly: true,
            defaultDate: new Date(),
            dateFormat: "mm/dd/yy"
        });
        $("#CreditCardFormModel_start_date").datepicker({
            showOn: "button",
            buttonImage: "/images/Calendar.png",
            buttonImageOnly: true,
            defaultDate: new Date(),
            dateFormat: "mm/dd/yy",
            disabled: true
        });
    });

    function startDateEnable()
    {
        if ($("#CreditCardFormModel_credit_card_type").val()=="4")
        {
            $("#CreditCardFormModel_start_date").removeAttr("disabled");
            $("#CreditCardFormModel_start_date").datepicker("enable");
            $("#CreditCardFormModel_issue_number").removeAttr("disabled");
        }
        else
        {
            $("#CreditCardFormModel_start_date").attr("disabled","disabled")
            $("#CreditCardFormModel_start_date").datepicker("disable");
            $("#CreditCardFormModel_issue_number").attr("disabled","disabled");
        };
    }
</script>

<?php $this->renderPartial('/order/errorMessage'); ?>

<?php echo $formCreditCard->dropDownListRow($cardInfo, 'credit_card_type', array(1=>'Visa',2=>'MasterCard',3=>'American Express',4=>'Maestro'),array('labelOptions' => array('class'=>'required'),'onchange'=>'js:startDateEnable()')); ?>
<?php echo $formCreditCard->textFieldRow($cardInfo, 'credit_card_number', array('labelOptions'=>array('class'=>'control-label'),'maxlength'=>'16','errorOptions'=>array('class'=>'error'))); ?>
<?php echo $formCreditCard->textFieldRow($cardInfo, 'cvv2_code', array('labelOptions'=>array('class'=>'control-label'),'maxlength'=>'3')); ?>
<?php echo $formCreditCard->textFieldRow($cardInfo, 'expiry_date', array('hint' => '', 'title'=>'Type date in format mm/dd/yyyy')); ?>
<?php echo $formCreditCard->textFieldRow($cardInfo, 'start_date', array('hint' => '', 'title'=>'Type date in format mm/dd/yyyy','disabled'=>'disabled')); ?>
<?php echo $formCreditCard->textFieldRow($cardInfo, 'issue_number', array('labelOptions'=>array('class'=>'control-label'),'disabled'=>'disabled')); ?>

