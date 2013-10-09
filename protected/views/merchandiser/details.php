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
                <p><span class="details_row">Total number of items ----- </p>
                <p><span class="details_row">Assignee </span><?php echo $orderModel->assignees->username; ?></p>
                <p><span class="details_row">Date of ordering</span> <?php echo $orderModel->order_date; ?></p>
                <p><span class="details_row">Preferable Delivery Date</span> <?php echo $orderModel->preferable_date; ?></p>
            </div>
            <div class="span4">


                <div> <span class="status">Status</span>
                    <?php echo $form->checkBox($orderModel,'uncheckOrderedStatus',
                        array(
                            'checked'=>$orderModel->trueOrderedStatus,
                            'id'=>'ordered_status',
                            'value'=>'ordered',
                            'uncheckValue'=>'0'
                        )
                    );
                    ?>
                    <span>Ordered</span>
                  <?php echo $form->checkBox($orderModel,'uncheckDeliveredStatus',
                        array(
                            'checked'=>$orderModel->trueDeliveredStatus,
                            'id'=>'delivered_status',
                            'value'=>'delivered',
                            'uncheckValue'=>'0'
                        )
                    );
                    ?>
                    <span>Delivered </span>
                </div>
               <div>Delivery date <?php echo $form->textField($orderModel, 'delivery_date',array('id'=>'preferable_date')); ?></div>
               <div> Gift <?php echo $form->checkBox($orderModel,'gift',
                    array(
                        'checked'=>$orderModel->giftChecked,
                        'id'=>'gift',
                        'value'=>'1',
                    )
                );
                ?>
               </div>
    </div>

        </fieldset>
        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton',
                array('buttonType'=>'submit',
                    'type'=>'primary',
                    'label'=>'Save',
                     'htmlOptions'=>array(
                         'name'=>'sub',
                     )
                 )
            );
            ?>
            <?php $this->widget('bootstrap.widgets.TbButton',
                array('buttonType'=>'submit',
                      'label'=>'Order',
                      'htmlOptions'=>array(
                          'name'=>'ordered',
                     )
                )
            );
            ?>
            <?php $this->widget('bootstrap.widgets.TbButton',
                array('buttonType'=>'reset',
                    'label'=>'Cancel',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#myModal',
                    ),
                )
            );
            ?>
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
            showOn: "button",
            buttonImage: "/images/Calendar.png",
            buttonImageOnly: true
        });


    });
</script>

