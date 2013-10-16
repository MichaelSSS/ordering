<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'orderForm',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'hideErrorMessage' => true,
        'validationUrl' => Yii::app()->createUrl("customer/validateorder"),
        'afterValidate' => 'js:afterValidate',
    )
)); ?>

<div class="span12">
    <div class="row">

        <p>This page is appointed for selecting and buying products</p>

        <fieldset>
            <legend>Items selection</legend>
            <?php $this->renderPartial('/order/orderItems', array(
                'orderDetails' => $orderDetails,
                'form' => $form,
            )); ?>
        </fieldset>
        
        <div class="row">
            <div class="span6">
                <fieldset id="orderInfo">
                    <legend>Totals</legend>
                    <div class="span5">
                        <?php $this->renderPartial('/order/orderInfo', array(
                            'order' => $order,
                            'form' => $form
                        )); ?>
                    </div>
                </fieldset>
            </div>    
            <div class="span6">
                <fieldset id="cardInfo">
                    <legend>Card Info</legend>
                    <div class="span6">
                        <?php $this->renderPartial('/order/cardInfo', array(
                            'cardInfo' => $cardInfo,
                            'formCreditCard' => $form
                        )); ?>
                    </div>
                </fieldset>
            </div>      
        </div>                    
    </div>
    <div class="row">
        <div class="form-actions">
            <div class="span3 pull-right">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Save',
                    'buttonType'=>'submit',
                    'htmlOptions' => array(
                        'name' => 'save',
                        'submit' => Yii::app()->createUrl('customer/save'),
                    ),
                )); ?>

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Order',
                    'buttonType'=>'submit',
                    'htmlOptions' => array(
                        'name' => 'order',
                        'submit' => Yii::app()->createUrl('customer/order'),
                    ),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Cancel',
                    'type' => 'action',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#cancelModal',
                        'id' => 'cancel_return'
                    ),
                )); ?>
            </div>
        </div> 
    </div>
       
<?php $this->endWidget(); ?>

<?php $this->renderPartial('/order/itemsEmpty', array('order' => $order)); ?>
<?php $this->renderPartial('/order/_err'); ?>
<?php $this->renderPartial('/order/_cancel'); ?>
<script>
    $(function(){
       
        $("#Order_preferable_date").datepicker();

        $('.clndr').click(function (e) {
            $('#Order_preferable_date').datepicker("show");
            e.preventDefault();
        });

        $('#Order_preferable_date').tooltip({
            trigger: 'hover'
        });

        if ($('#Order_status').val()=="Pending"){
            $('#order').hide();
        }else if($('#Order_status').val()=="Delivered" || $('#Order_status').val()=="Ordered"){
            $('#order').hide();
            $('#save').hide();
        }

        if (!$('#Order_status').val()) {
            $('#order').attr('disabled', 'disabled').on('click', function () {
                return false;
            });
        }

        $('#cancel_return').removeAttr('data-toggle').attr('href', '?r=customer/cancel').text('Return');

        $('#orderInfo').on('change', 'input, select', disableOrder);

        $.get('?r=customer/checkChanges', function (response) {
            if (!(response === "null")) {
                disableOrder();
            }
        });
    });

    function disableOrder() {
        $('#order').attr('disabled', 'disabled').on('click', function () {
            return false;
        });
        $('#cancel_return').removeAttr('href').attr('data-toggle', 'modal').text('Cancel');
    }

    function afterValidate(form, data, hasError) {
        if (hasError) {
            $('#error-text').html(data[Object.keys(data)[0]]);
            $('#itemsEmpty').modal();
            return false;
        }
        return true;
    }

    function afterValidateCC(result, status, xhr) {
        if (status) {
            var errorCC = new Array;
            var mess = new String;
            $.each(result, function (key, value) {
                mess = "<p>" + value + "</p>";
                errorCC.push(mess);
            });
            $("#errorModal").modal('show').on('shown', function () {
                $("#errorMessage").html(errorCC);
            });
        }
    }
</script>
