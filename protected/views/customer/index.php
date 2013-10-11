
<p>This page is appointed for creating new and managing existing users</p>

<?php echo CHtml::link('Create New Order', array('customer/create')); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
    /*'enableAjaxValidation'=>true*/
));
?>

<fieldset>
    <legend>Search 
        <span>by</span>
    </legend>
    <div id='search-fields'>
        <div class="span12">
            <div class='span2'><p>Filter orders by:</p></div>
            <div class='span3'>
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
            <div class='span3'>
                <?php echo $form->dropDownlist($model, 'filterValue', $model->filterStatuses,
                    array('class' => 'span3',
                        'options' => array(
                            array_search('None', $model->filterStatuses) => array('selected' => true)
                        ),
                    ));
                ?>
            </div>
        </div>
        <div class="span12">
            <div class='span2'>Search for orders by:</div>
            <div class='span3'>
                <?php echo $form->dropDownlist($model, 'searchCriteria', $model->searchCriterias,
                    array('class' => 'span3',
                        'options' => array(
                            array_search('Order Name', $model->searchCriterias) => array('selected' => true
                            ))
                    ));
                ?>
            </div>
            <div class='span3'>
                <?php echo $form->textField($model, 'searchValue', array('class' => 'span3')); ?>
            </div>
            <div class='span2 pull-right'>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'      => 'Apply',
                    'buttonType' => 'submit',
                    'type'       => 'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'       => 'null', // null, 'large', 'small' or 'mini'
                ));?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'      => 'Reset',
                    'buttonType' => 'ajaxLink',
                    'buttonType' => 'ajaxLink',
                    'type'       => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'htmlOptions'       => array(
                        'name'=>'reset',

                    ),
                    'ajaxOptions' => array(
                        'data'=>'reset',
                        'url'=>'Yii::app()->createUrl(\'customer/resetFilter\')',
                        'success'=>'js:function(response){debugger;$.fn.yiiGridView.update("yw0");}',
                    ),

                )); ?>
                <?php echo CHtml::errorSummary($model) ?>
            </div>
        </div>
    </div>        
</fieldset>
<?php $this->endWidget(); ?>

<?php
$grid = $this->widget('TGridView', array(
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
            'name' => 'total_price',
            'value' => '(int)$data->total_price . "\$"',
        ),
        array(
            'name' => 'max_discount',
            'value' => '$data->max_discount.""."%"',
        ),
        array(
            'name' => 'delivery_date',
            'value' => '($data->delivery_date != "0000-00-00") ?
                Yii::app()->dateFormatter->format("MM/dd/yyyy",$data->delivery_date) : "Delivery Date not assigned";',
        ),
        'status',
        array(
            'name' => 'assignee',
            'value' => '$data->assignees->username',
        ),
        array(
            'name' => 'assigneesRole',
            'value' => '$data->assignees->role',

        ),
        array(
            'header' => 'Edit',
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{edit}',
            'htmlOptions' => array(),
            'buttons' => array(
                'edit' => array(
                    'icon' => 'edit large',
                    'url'  => 'Yii::app()->createUrl(\'customer/edit\',array(\'id\'=>$data->id_order))',
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
                    'icon' => 'remove large',
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

    };
    $(function(){
        $('#modal_remove').click(function() {
            var url = $(this).attr('href');
            $.get(url, function(response) {
                $('.modal-header .close').click();
                $.fn.yiiGridView.update('yw0');


            });
            return false;
        });
    });

</script>
