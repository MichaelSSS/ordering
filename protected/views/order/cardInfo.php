<?php  //Yii::app()->bootstrap->register('/css/bootstrap.css'); ?>
<?php  //Yii::app()->bootstrap->register('/css/bootstrap-responsive.css'); ?>
<script>
    // Form behaviour for Credit Card type
    $(function ()
    {
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
        $("#CreditCardFormModel_cvv2_code_tip").popover(
            {
                placement: "right",
                title: "What is this",
                content: "<p>CVV2 is a new authentication scheme established by credit card companies to further efforts towards reducing fraud for internet transactions. It consists of requiring a card holder to enter the CVV2 number in at transaction time to verify that the card is on hand.</p>",
                html: true,
                trigger: "hover"
            }
        );
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

<?php echo $formCreditCard->dropDownListRow($cardInfo, 'credit_card_type', array(
    1=>'Visa',
    2=>'MasterCard',
    3=>'American Express',
    4=>'Maestro'), array(
        'labelOptions' => array(
            'class'=>'required'
        ),
        'onchange'=>'js:startDateEnable()',
)); ?>

<?php echo $formCreditCard->textFieldRow($cardInfo, 'credit_card_number', array(
    'maxlength'=>'16',
    'labelOptions'=>array(
        'class'=>'control-label'
    ),  
)); ?>

<?php echo $formCreditCard->textFieldRow($cardInfo, 'cvv2_code', array(
    'maxlength'=>'3',
    'labelOptions'=>array(
        'class'=>'control-label',
        'id'=>'CreditCardFormModel_cvv2_code_label',
    ),
)); ?>

<?php echo $formCreditCard->textFieldRow($cardInfo, 'expiry_date', array(
    'title'=>'Type date in format mm/dd/yyyy',
    'value'=>date("m/d/y"),
)); ?>

<?php echo $formCreditCard->textFieldRow($cardInfo, 'start_date', array(
    'title'=>'Type date in format mm/dd/yyyy',
    'disabled'=>'disabled',
    'value'=>date("m/d/y"),
)); ?>

<?php echo $formCreditCard->textFieldRow($cardInfo, 'issue_number', array(
    'disabled'=>'disabled', 
    'maxlength'=>'1',  
    'labelOptions'=>array(
        'class'=>'control-label'
    ),
)); ?>

