<div class="row">
    <div class="span10"></div>
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'orderForm',
        'type' => 'horizontal',
//        'action' => '?r=customer/create',
        'enableClientValidation' => true,
        'enableAjaxValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit'=>true,
            'hideErrorMessage'=>true,
            'validationUrl'=> Yii::app()->createUrl("customer/validateorder" ),
            'afterValidate'=>'js:afterValidate',
            )
         )
    ); ?>

    <div class="row">
        <div class="span10">This page is appointed for selecting and buying products</div>
    </div>
    <div class="row">
        <div class="span10">
            <fieldset>
                <legend>Items selection</legend>
                <?php $this->renderPartial('/order/orderItems', array('orderDetails' => $orderDetails, 'form' => $form)) ?>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="span5">
            <?php $this->renderPartial('/order/orderInfo', array('order' => $order, 'form' => $form)); ?>
        </div>
        <div class="span5">
            <fieldset id = "cardInfo">
                <legend>Card Info</legend>
                <?php $this->renderPartial('/order/cardInfo', array('cardInfo' => $cardInfo, 'formCreditCard' => $form)); ?>
            </fieldset>
        </div>

    </div>
    <div class="row">
        <div class="span3 offset7">
            <div class="order-buttons">
<!--                --><?php
//                echo CHtml::ajaxSubmitButton('Submit', '?r=customer/save', array(
//                        'type' => 'POST',
//                        'update' => '#needForm',
//                    ),
//                    array(
//                        'type' => 'submit',
//                        'name' => 'save'
//                    ));
//                ?>



                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Save',
                    'buttonType'=>'submit',
//                    'url'=>Yii::app()->createUrl('customer/save'),
                    'htmlOptions' => array(
                        'name' => 'save',
                        'submit' => Yii::app()->createUrl('customer/save'),
                    ),



                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Order',
                    'buttonType'=>'submit',
//                    'url'=>Yii::app()->createUrl('customer/save'),
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
</div>
</div>
<?php $this->renderPartial('/order/itemsEmpty', array('order'=>$order)); ?>

<?php $this->renderPartial('/order/_err'); ?>
<?php $this->renderPartial('/order/_cancel'); ?>

<script type="text/javascript">
    $(function () {
        $("#Order_preferable_date").datepicker({
            showOn: "button",
            buttonImage: "/images/Calendar.png",
            buttonImageOnly: true
        });
        $('#Order_preferable_date').tooltip({
            trigger : 'hover'
        });

        if(!$('#Order_status').val()){
            $('#order').attr('disabled','disabled').on('click',function(){return false;});
        }
        $('#cancel_return').removeAttr('data-toggle').attr('href','?r=customer/cancel').text('Return');


        $('#orderInfo').on('change', 'input, select', disableOrder);

        $.get('?r=customer/checkChanges', function(response) {

          if (!(response === "null")){
              disableOrder();
          }

        });
    });

    function disableOrder(){
        $('#order').attr('disabled','disabled').on('click',function(){return false;});
        $('#cancel_return').removeAttr('href').attr('data-toggle','modal').text('Cancel');
    }


    function afterValidate(form,  data, hasError)
    {
        if(hasError){
            $('#error-text').html(data[Object.keys(data)[0]]);
            $('#itemsEmpty').modal();
            return false;
        }
        return true;
    };
    // After validate
//    function afterValidate (form,data,hasError)
//    {
//        if (hasError)
//        {
//            // modal window with the FIRST error
//            /*
//             $.each( data, function( key, value )
//             {
//             $("#errorModal").modal('show').on('shown', function(){ $("#errorMessage").html("<p>"+ value + "</p>"); });
//             return false;
//             });
//             */
//            // modal window with ALL errors
//            var errorCC = new Array;
//            var mess = new String;
//            $.each( data, function( key, value )
//            {
//                mess="<p>" + value + "</p>";
//                errorCC.push(mess);
//            });
//            $("#errorModal").modal('show').on('shown', function(){ $("#errorMessage").html(errorCC); });
//        };
//    }
    // After validate Credit Card information
    function afterValidateCC (result,status,xhr)
    {
        if (status)
        {
            // modal window with the FIRST error
            /*
             $.each( result, function( key, value )
             {
             $("#errorModal").modal('show').on('shown', function(){ $("#errorMessage").html("<p>"+ value + "</p>"); });
             return false;
             });
             */
            // modal window with ALL errors
            var errorCC = new Array;
            var mess = new String;
            $.each( result, function( key, value )
            {
                mess="<p>" + value + "</p>";
                errorCC.push(mess);
            });
            $("#errorModal").modal('show').on('shown', function(){ $("#errorMessage").html(errorCC); });
        };
    }


</script>
