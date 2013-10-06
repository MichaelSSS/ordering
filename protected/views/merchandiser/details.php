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
    <fieldset>
        <legend>Totals</legend>
        <div class="row">
            <div class="span12">
                <div class="span6">
                    <ul class='inline nav'>
                        <li>
                            <ul class='nav'>
                                <li><?= 'Customer name:'; ?></li>
                                <li><?= 'Customer type:'; ?></li>
                                <li><?= 'Order Number:' ?></li>
                                <li><?= 'Total price:' ;?></li>
                                <li><?= 'Total number of items:' ;?></li>
                                <li><?= 'Assignee:' ;?></li>
                                <li><?= 'Date of ordering:' ;?></li>
                                <li><?= 'Preferable Delivery:' ;?></li>
                            </ul>
                        </li>
                        <li>
                            <ul class='nav'>
                                <li><?php echo $orderModel->userNameOrder->username; ?></li>
                                <li><?php echo $orderModel->customerType->customer_type; ?></li>
                                <li><?php echo $orderModel->id_order; ?></li>
                                <li>--</li>
                                <li>--</li>
                                <li><?php echo $orderModel->assignees->username; ?></li>
                                <li><?php echo $orderModel->order_date; ?></li>
                                <li><?php echo $orderModel->preferable_date; ?></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="span6">
                    <p>Status</p>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Totals</legend>
        <div class="row">
            <div class="span12">
                <div class="span6">
                    <ul class='inline nav'>
                        <li>
                            <ul class='nav'>
                                <li><?='Customer name:';?></li>
                                <li><?='Customer type:';?></li>
                                <li><?='Order Number:'?></li>
                                <li><?='Total price:';?></li>
                                <li><?='Total number of items:';?></li>
                                <li><?='Assignee:';?></li>
                                <li><?='Date of ordering:';?></li>
                                <li><?='Preferable Delivery:';?></li>
                            </ul>
                        </li>
                        <li>
                            <ul class='nav'>
                                <li><?php echo $orderModel->userNameOrder->username; ?></li>
                                <li><?php echo $orderModel->customerType->customer_type; ?></li>
                                <li><?php echo $orderModel->id_order; ?></li>
                                <li>--</li>
                                <li>--</li>
                                <li><?php echo $orderModel->assignees->username; ?></li>
                                <li><?php echo $orderModel->order_date; ?></li>
                                <li><?php echo $orderModel->preferable_date; ?></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="span6">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'verticalForm',
                        'htmlOptions' => array('class' => 'well'),
                    )); ?>

                    <?php echo $form->checkBoxListInlineRow($orderModel, 'status', array('Ordered', 'Delivered')); ?>

                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </fieldset>
<?php $this->endWidget(); ?>

