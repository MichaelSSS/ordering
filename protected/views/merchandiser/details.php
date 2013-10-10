<?php $grid = $this->widget('TGridView', array(
    'dataProvider' => $model,
    'type' => 'striped bordered condensed',
    'ajaxUpdate' => '',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
    'filterSelector' => '{filter}',
    'template' => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager' => array(
        'class' => 'OmsPager',
        'header' => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => '&lsaquo; First',
        'prevPageLabel'  => '&larr; Backward',
        'nextPageLabel'  => 'Forward &rarr;',
        'lastPageLabel'  => 'Last &rsaquo;',
        'htmlOptions' => array(
            'class' => 'yiiPager',
        ),
        'cssFile' => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',
    'columns' => array(
        array('name' => 'id_item'),
        array('name' => 'Item Name', 'value' => '$data->itemOredered->name'),
        array('name' => 'Item Description', 'value' => '$data->itemOredered->description'),
        array('name' => 'Dimension', 'value' => '$data->dimensionId->dimension'),
        array('name' => 'Price', 'value' => '$data->price . " $"'),
        array('name' => 'Price per line', 'value' => '$data->price . " $"'),
        array('name' => 'quantity'),
    ),
)); ?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'horizontalForm',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
)); ?>

<div class="row">
    <div class="span12">
        <div class="row">
            <div class="span6"> 
                <fieldset>
                    <legend>Totals</legend>
                    <div class="span2">
                        <ul class='nav inline'>
                            <li>
                                <ul class='nav'>
                                    <li>Customer name:</li>
                                    <li>Customer type:</li>
                                    <li>Order Name:</li>
                                    <li>Order Number:</li>
                                    <li>Total price:</li>
                                    <li>Total number of items:</li>
                                    <li>Assignee:</li>
                                    <li>Date of ordering:</li>
                                    <li>Preferable Delivery:</li>
                                </ul>
                            </li>
                        </ul>
                    </div>    
                    <div class="span2">
                        <ul class='nav'>
                            <li><?php echo $orderModel->userNameOrder->username; ?></li>
                            <li><?php echo $orderModel->customerType->customer_type; ?></li>
                            <li><?php echo $orderModel->order_name; ?></li>
                            <li><?php echo $orderModel->id_order; ?></li>
                            <li><?php echo $orderModel->total_price; ?> $</li>
                            <li>--</li>
                            <li><?php echo $orderModel->assignees->username; ?></li>
                            <li><?php echo $orderModel->order_date; ?></li>
                            <li><?php echo $orderModel->preferable_date; ?></li>
                        </ul>
                    </div>
                </fieldset>
            </div>
            <div class="span6">
                <fieldset>
                    <legend>status</legend>
                    <div class="span6">
                        <ul class='nav inline text-center'>
                            <li>
                                <label for="ordered_status" class='checkbox'>
                                    <?php echo $form->checkBox($orderModel, 'uncheckOrderedStatus', array(
                                        'checked'      => $orderModel->trueOrderedStatus,
                                        'id'           => 'ordered_status',
                                        'value'        => 'ordered',
                                        'uncheckValue' => '0',
                                    )); ?>
                                    Ordered
                                </label>
                            </li>
                            <li>
                                <label for="delivered_status" class='checkbox'>
                                    <?php echo $form->checkBox($orderModel, 'uncheckDeliveredStatus', array(
                                        'checked'      =>  $orderModel->trueDeliveredStatus,
                                        'id'           => 'delivered_status',
                                        'value'        => 'delivered',
                                        'uncheckValue' => '0'
                                    )); ?>
                                    Delivered
                                </label>
                            </li>
                            <li>
                                <label for="gift" class='checkbox'>
                                   <?php echo $form->checkBox($orderModel, 'gift', array(
                                        'checked' => $orderModel->giftChecked,
                                        'id'      => 'gift',
                                        'value'   => '1',
                                    )); ?>

                                    <i class="icon-gift icon-large" title='gift'></i>
                                </label>
                            </li>
                        </ul>
                        <div class="row">
                            <a href="#" class='clndr'>
                               <?php echo $form->textFieldRow($orderModel, 'delivery_date', array(
                                   'id'      => 'preferable_date',
                                    'append' => '<i class="icon-calendar icon-large"></i>',
                               )); ?>
                            </a>
                        </div>        
                           
                    </div>
                    <div class="span6">
                        <div class="row">
                            <div class="form-actions">

                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                    'buttonType'  => 'submit',
                                    'type'        => 'primary',
                                    'label'       => 'Save',
                                    'htmlOptions' => array(
                                        'name' => 'sub',
                                    )
                                 )); ?>

                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                    'buttonType'  => 'submit',
                                    'label'       => 'Order',
                                    'htmlOptions' => array(
                                        'name' => 'ordered',
                                    )
                                )); ?>
                                
                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                    'buttonType'     => 'reset',
                                    'label'      => 'Cancel',
                                    'htmlOptions' => array(
                                        'data-toggle' => 'modal',
                                        'data-target' => '#myModal',
                                    )
                                )); ?>
                            </div>
                        </div>
                        
                    </div>

                    
                    
                </fieldset>
                
            </div>
        </div>
    </div>
</div>
    
    
   

<?php $this->endWidget(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); ?>

    <div class='modal-header'>
        <a class='close' data-dismiss='modal'>&times;</a>
        <h4>Warning</h4>
    </div>

    <div class='modal-body'>
        <p>Are you sure you want to cancel operation?</p>
        <p>All data will be lost in this page</p>
    </div>

    <?php $target = $this->createUrl('merchandiser/index'); ?>

    <div class='modal-footer'>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'  => 'primary',
            'label' => 'Yes',
            'url'   => $target,
        )); ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'       => 'No',
            'url'         => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )); ?>
    </div>
<?php $this->endWidget(); ?>



<script>
    $(document).ready(function () {
        if($('#ordered_status').prop("checked"))
        {
            $('#ordered_status').prop("disabled", true);
        }
        if(!$('#ordered_status').prop("checked"))
        {
            $('#delivered_status').prop("disabled", true);
        }
        if($('#delivered_status').prop("checked"))
        {
            $('#delivered_status').prop("disabled", true);
        }
        if($('#delivered_status').prop("checked"))
        {
            $('#gift').prop("disabled", true);
        }
        $('#ordered_status').change(function(){
            if($(this).attr('checked')){
                $('#delivered_status').prop("disabled", false);
            }
            if(!$(this).attr('checked')){

                $('#delivered_status').prop("disabled", true);
            }
            if(!$(this).attr('checked')){

                $('#delivered_status').prop("checked", false);
            }
        })

        $("#preferable_date").datepicker({          
            
        });

        $('.clndr').click(function (e) {
            $('#preferable_date').datepicker("show");
            e.preventDefault();
        });
    });
</script>

