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
        array('name' => 'Item Name','value'=>'$data->itemOredered->name'),
        array('name' => 'Item Description','value'=>'$data->itemOredered->description','htmlOptions'=>array('class'=>'ss')),
        array('name' => 'Dimension','value'=>'$data->dimensionId->dimension'),
        array('name' => 'Price','value'=>'$data->price . " $"'),
        array('name' => 'Price per line','value'=>'$data->price . " $"'),
        array('name' => 'quantity'),
    ),
));?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'horizontalForm',
        'type' => 'horizontal',
        'enableClientValidation' => true,

        'enableAjaxValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit'=>true,
            'hideErrorMessage'=>true,
            'afterValidate'=>'js:showError',
        )
    )
);
?>




<div class="row">
    <div class="span10 ">
        <fieldset>
            <legend>Totals</legend>
            <div class="span5">
                <p>Customer name      <?php echo $orderModel->userNameOrder->username; ?>


                </p>
                <p><span class="details_row">Customer type</span> <?php echo $orderModel->customerType->customer_type; ?></p>
                <p><span class="details_row">Order Number</span> <?php echo $orderModel->order_name; ?></p>
                <p><span class="details_row">Total price</span><?php echo $orderModel->total_price; ?> $</p>
                <p><span class="details_row">Total number of items</span> </p>
                <p><span class="details_row">Assignee </span><?php echo $orderModel->assignees->username; ?></p>
                <p><span class="details_row">Date of ordering</span> <?php echo $orderModel->order_date; ?></p>
                <p><span class="details_row">Preferable Delivery Date</span> <?php echo $orderModel->preferable_date; ?></p>
            </div>
            <div class="span4">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'verticalForm',
                    'htmlOptions'=>array('class'=>'well'),
                )); ?>

                <div> <span class="status">Status</span>
                    <?php echo $form->checkBox($orderModel,'status',array('checked'=>$orderModel->trueOrderedStatus,'id'=>'ordered_status')); ?>
                    <span>Ordered</span>
                    <?php echo $form->checkBox($orderModel,'status',array('checked'=>$orderModel->trueDeliveredStatus,'id'=>'delivered_status')); ?>
                    <span>Delivered </span>


                    <?php echo $form->textFieldRow($orderModel, 'delivery_date'); ?>
                </div>



                <?php $this->endWidget(); ?>
            </div>
        </fieldset>
        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Order')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Cancel')); ?>
        </div>
    </div>
</div>
</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
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

        $('#ordered_status').change(function(){
            if($(this).attr('checked')){
                $('#delivered_status').prop("disabled", false);
            }
            if(!$(this).attr('checked')){

                $('#delivered_status').prop("disabled", true);
            }
        })



    });
</script>

