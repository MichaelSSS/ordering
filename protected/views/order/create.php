<div class="row">
    <div class="span10"></div>
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'horizontalForm',
        'type' => 'horizontal',
        'enableClientValidation' => true,
        'enableAjaxValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit'=>true,
            'hideErrorMessage'=>true,
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
            <fieldset>
                <legend>Card Info</legend>
                <?php $this->renderPartial('/order/cardInfo', array('cardInfo' => $cardInfo, 'formCreditCard' => $form)); ?>
            </fieldset>
        </div>

    </div>
    <div class="row">
        <div class="span3 offset7">
            <div class="order-buttons">

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit', 
                    'type' => 'primary', 
                    'label' => 'Save',
                    'htmlOptions' => array('name' => 'save'))); ?>

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'ajaxSubmitButton',
                    'type' => 'primary',
                    'label' => 'Order',
                    'url' => '?r=customer/order',
                    'htmlOptions' => array(
                        'name' => 'order',
                        'ajax' => array(
                            'type'=>'POST',
                            'async'=>true,
                            'dataType' => 'json',
                            'url'=>'?r=customer/order',
                            'data' => 'js:$("#horizontalForm").serialize()',
                            'success'=>'js:afterValidateCC',
                            //'error'=>'js:function(xhr,status,error){alert(error)}'
                        ),
                    )
                )); ?>
                
                <!-- 
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type' => 'primary', 
                    'label' => 'Order', 
                    'htmlOptions' => array(
                        'name' => 'order',
                        'submit' => array('?r=customer/order', 'id' => 'order')
                    )
                )); ?> -->


                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Cancel',
                    'type' => 'action',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#cancelModal',
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

<script>
    $(function () {
        $("#Order_preferable_date").datepicker({
            showOn: "button",
            buttonImage: "/images/Calendar.png",
            buttonImageOnly: true,
        });
        $('#Order_preferable_date').tooltip({
            trigger : 'hover'
        });

<!--        --><?php //if($order->isError()): ?>
<!--           $('#itemsEmpty').modal();-->
<!--        --><?php //endif; ?>

    });
    function showError(form,  data, hasError)
    {
        if(hasError){
            $('#error-text').html(data[Object.keys(data)[0]]);
            $('#itemsEmpty').modal();
            return false;
        }
        return true;
    };
    // After validate
    function afterValidate (form,data,hasError)
    {
        if (hasError)
        {
            // modal window with the FIRST error
            /*
             $.each( data, function( key, value )
             {
             $("#errorModal").modal('show').on('shown', function(){ $("#errorMessage").html("<p>"+ value + "</p>"); });
             return false;
             });
             */
            // modal window with ALL errors
            var errorCC = new Array;
            var mess = new String;
            $.each( data, function( key, value )
            {
                mess="<p>" + value + "</p>";
                errorCC.push(mess);
            });
            $("#errorModal").modal('show').on('shown', function(){ $("#errorMessage").html(errorCC); });
        };
    }
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
