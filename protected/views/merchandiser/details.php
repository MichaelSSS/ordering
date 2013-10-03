

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
                <p>Customer type <?php echo $orderModel->customerType->customer_type; ?></p>
                <p>Order Number <?php echo $orderModel->id_order; ?></p>
                <p>Total price</p>
                <p>Total number of items</p>
                <p>Assignee</p>
                <p>Date of ordering</p>
                <p>Preferable Delivery Date</p>
            </div>
            <div class="span4">
                <p>Status</p>
            </div>
        </fieldset>
    </div>
</div>
</div>
<?php $this->endWidget(); ?>

