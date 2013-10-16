<?php $grid = $this->widget('TGridView', array(
    'dataProvider'   => $model,
    'type'           => 'striped bordered condensed',
    'ajaxUpdate'     => '',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
    'filterSelector' => '{filter}',
    'template'       => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager' => array(
        'class'  => 'OmsPager',
        'header' => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => '&lsaquo; First',
        'prevPageLabel'  => '&larr; Backward',
        'nextPageLabel'  => 'Forward &rarr;',
        'lastPageLabel'  => 'Last &rsaquo;',
        'htmlOptions' => array(
            'class'   => 'yiiPager',
        ),
        'cssFile'     => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',
    'columns' => array(
        array('name' => 'id_item'),
        array('name' => 'Item Name', 'value'        => '$data->itemOredered->name'),
        array('name' => 'Item Description', 'value' => '$data->itemOredered->description'),
        array('name' => 'Dimension', 'value' => '$data->dimensionId->dimension'),
        array('name' => 'Price', 'value' => '$data->price . " $"'),
        array('name' => 'Price per line', 'value' => '$data->price *  $data->dimensionId->count_of_items *  $data->quantity. " $"'),
        array('name' => 'quantity'),
    ),
)); ?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                     => 'horizontalForm',
    'type'                   => 'horizontal',
    'enableClientValidation' => true,
    'enableAjaxValidation'   => true,
)); ?>

    <div class='row'>
        <div class='span6'> 
            <fieldset>
                <legend>Totals</legend>
                <div class='span5'>
                    <div class='row'>
                        <div class='span3'><b>Customer Name:</b></div>
                        <div class='span2'><?php echo $orderModel->userNameOrder->username; ?></div>
                    </div>
                    <div class='row'>
                        <div class='span3'><b>Customer Type:</b></div>
                        <div class='span2'><?php echo $orderModel->customerType->customer_type; ?></div>
                    </div>
                    <div class='row'>
                        <div class='span3'><b>Order Name:</b></div>
                        <div class='span2'><?php echo $orderModel->order_name; ?></div>
                    </div>
                    <div class='row'>
                        <div class='span3'><b>Order Number:</b></div>
                        <div class='span2'><?php echo $orderModel->id_order; ?></div>
                    </div>
                    <div class='row'>
                        <div class='span3'><b>Total Price:</b></div>
                        <div class='span2'><?php echo $orderModel->total_price; ?> $</div>
                    </div>
                    <div class='row'>
                        <div class='span3'><b>Total number of items:</b></div>
                        <div class='span2'><?php echo $model->getTotalItemCount();?></div>
                    </div>
                    <div class='row'>
                        <div class='span3'><b>Assignee:</b></div>
                        <div class='span2'><?php echo $orderModel->assignees->username; ?></div>
                    </div>
                    <div class='row'>
                        <div class='span3'><b>Date of ordering:</b></div>
                        <div class='span2'><?php echo $orderModel->order_date; ?></div>
                    </div>
                    <div class='row'>
                        <div class='span3'><b>Preferable Delivery:</b></div>
                        <div class='span2'><?php echo $orderModel->preferable_date; ?></div>
                    </div> 
                </div>     
            </fieldset>
        </div>
        <div class='span6'>     
            <fieldset>
                <legend>status</legend>                                         
                <div class='span2'>
                    <label for='ordered_status' class='checkbox'>
                        <?php echo $form->checkBox($orderModel, 'uncheckOrderedStatus', array(
                            'checked'      => $orderModel->trueOrderedStatus,
                            'id'           => 'ordered_status',
                            'value'        => 'ordered',
                            'uncheckValue' => '0',
                        )); ?>
                        Ordered
                    </label>
                </div>
                <div class='span2'>
                    <label for='delivered_status' class='checkbox'>
                        <?php echo $form->checkBox($orderModel, 'uncheckDeliveredStatus', array(
                            'checked'      =>  $orderModel->trueDeliveredStatus,
                            'id'           => 'delivered_status',
                            'value'        => 'delivered',
                            'uncheckValue' => '0'
                        )); ?>
                        Delivered
                    </label>
                </div>
                <div class='span1'>
                    <label for='gift' class='checkbox'>
                        <?php echo $form->checkBox($orderModel, 'gift', array(
                            'checked' => $orderModel->giftChecked,
                            'id'      => 'gift',
                            'value'   => '1',
                        )); ?>

                        <i class='icon-gift icon-large' title='gift'></i>
                    </label>
                </div>
                <div class='row'>
                    <div class='span5'>
                        <a href='#' class='clndr'>
                            <?php echo $form->textFieldRow($orderModel, 'delivery_date', array(
                               'id'     => 'preferable_date',
                               'class'  => 'span2',
                               'append' => '<i class="icon-calendar icon-large"></i>',
                            )); ?>
                        </a>
                    </div>
                </div>
                    
                <div class='well text-center'>
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
                        'buttonType'  => 'reset',
                        'label'       => 'Cancel',
                        'htmlOptions' => array(
                            'data-toggle' => 'modal',
                            'data-target' => '#myModal',
                        )
                    )); ?>
                </div>                       
            </fieldset>
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
        if ($('#ordered_status').prop("checked"))
        {
            $('#ordered_status').prop("disabled", true);
        }
        if (!$('#ordered_status').prop("checked"))
        {
            $('#delivered_status').prop("disabled", true);
        }
        if ($('#delivered_status').prop("checked"))
        {
            $('#delivered_status').prop("disabled", true);
            $('#preferable_date').prop("disabled", true);
            $('.add-on').click(function(){
                return false;
            })
        }

        if ($('#delivered_status').prop("checked"))
        {
            $('#gift').prop("disabled", true);
        }

        $('#ordered_status').change(function(){
            if ($(this).attr('checked')){
                $('#delivered_status').prop("disabled", false);
            }
            if (!$(this).attr('checked')){

                $('#delivered_status').prop("disabled", true);
            }
            if(!$(this).attr('checked')){

                $('#delivered_status').prop("checked", false);
            }
        })

        $("#preferable_date").datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $('.clndr').click(function (e) {
            $('#preferable_date').datepicker("show",{

            });
            e.preventDefault();
        });
    });
</script>
