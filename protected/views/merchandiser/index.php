
<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs',
    'placement' => 'above', // 'above', 'right', 'below' or 'left'
    'tabs' => array(
        array('label' => 'Ordering',
            'content' => '',
            'active' => true
        ),
    ),
));
?>

<?php echo CHtml::link('Create New Order', array('customer/create')); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
));
?>

<fieldset class="order_search">
    <legend>Search <span>by</span></legend>
    <div id="search-fields">
        <div class="span2"><p>Filter orders by:</p></div>
        <div class="span3">
            <?php echo $form->dropDownlist($model, 'filterCriteria', $model->filterCriterias, array(
                'class' => 'span3',
                'options' => array(
                    array_search('Status', $model->filterCriterias) => array('selected' => true)
                ),
                'ajax' => array(
                    'type' => 'Post',
                    'url' => $this->createUrl('customer/dependentselect'),
                    'update' => '#Order_filterValue',
                ),
            ));
            ?>
        </div>
        <div class="span3">
            <?php echo $form->dropDownlist($model, 'filterValue', $model->filterStatuses,
                array('class' => 'span3',
                    'options' => array(
                        array_search('None', $model->filterStatuses) => array('selected' => true)
                    ),
                ));
            ?>
        </div>
        <div class="span2">Search for orders by:</div>
        <div class="span3">
            <?php echo $form->dropDownlist($model, 'searchCriteria', $model->searchCriterias,
                array('class' => 'span3',
                    'options' => array(
                        array_search('Order Name', $model->searchCriterias) => array('selected' => true
                        ))
                ));
            ?>
        </div>
        <div class="span3">
            <?php echo $form->textField($model, 'searchValue', array('class' => 'span3')); ?>
        </div>
        <div class="span1 pull-right">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Apply',
                'buttonType' => 'submit',
                'type' => 'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'null', // null, 'large', 'small' or 'mini'
            ));?>
            <?php echo CHtml::errorSummary($model) ?>
        </div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>



<?php $grid = $this->widget('TGridView', array(
    'dataProvider' => $model->search(),
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
        array('name' => 'order_name', 'header' => 'Order Name'),
        array(
            'name' => 'assignee',
            'header'=>'Customer Name',
            'value' => '$data->assignees->username',
        ),
        array(
            'name' => 'total_price',
            'value' => '$data->total_price.""."\$"',
        ),
        array(
            'name' => 'max_discount',
            'value' => '$data->max_discount.""."%"',
        ),
        array(
            'name' => 'delivery_date',
//            'value' => '$model->formatDate($data->delivery_date)',
            'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",$data->delivery_date);',
        ),
        'status',
        array(
            'name' => 'assignee',
            'header'=>'Customer Name',
            'value' => '$data->assignees->username',
        ),
        array(
            'header' => 'Edit',
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{edit}',
            'htmlOptions' => array(),
            'buttons' => array(
                'edit' => array(
                    'icon' => 'pencil',
                    //'url'  => 'Yii::app()->createUrl()',
                ),
            )
        ),
        array(
            'header' => 'Remove',
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{remove}',
            'htmlOptions' => array(
                'id' => 'col_remove',
            ),
            'buttons' => array(
                'remove' => array(
                    'icon' => 'icon-trash',
                    'url' => 'Yii::app()->createUrl(\'customer/remove\',array(\'id\'=>$data->id_order))',
                    'options' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#remove_order',
                        'onclick' => 'beforeRemove(this)',
                    ),
                ),
            )
        ),
    ),
));?>
<?php $this->renderPartial('/customer/_delete'); ?>
<script>
    function beforeRemove(el) {
        $('#modal_remove').attr('href', $(el).attr('href'));


    }
</script>