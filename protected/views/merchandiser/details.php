

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
        <div class="span5">
            <p>Customer name <?php echo $orderModel->userNameOrder->username; ?> </p>
            <p><span class="details_row">Customer type</span> <?php echo $orderModel->customerType->customer_type; ?></p>
            <p><span class="details_row">Order Number</span> <?php echo $orderModel->id_order; ?></p>
            <p><span class="details_row">Total price</span></p>
            <p><span class="details_row">Total number of items</span> </p>
            <p><span class="details_row">Assignee </span><?php echo $orderModel->assignees->username; ?></p>
            <p><span class="details_row">Date of ordering</span> <?php echo $orderModel->order_date; ?></p>
            <p><span class="details_row">Preferable Delivery Date</span> <?php echo $orderModel->preferable_date; ?></p>
        </div>
        <div class="span4">
            <p>Status</p>
        </div>
    </fieldset>


<?php $this->endWidget(); ?>

