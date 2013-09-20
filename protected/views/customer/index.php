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

<?php echo CHtml::link('Create New Order', array('order/create')); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
//    'enableClientValidation' => true,
//    'clientOptions' => array(
//        'validateOnSubmit' => true,
//    ),
));
?>

<fieldset>
    <legend>Search <span>by</span></legend>

    <div id="search-fields">

            <div class="span2"><p>Filter orders by:</p></div>
            <div class="span3">
                <?php echo $form->dropDownlist($model, 'filterCriteria', $model->filterCriterias, array(
                    'class'   => 'span3',
                    'options' => array(
                        array_search('Status', $model->filterCriterias) => array('selected' => true)
                    ),
                    'ajax' => array(
                        'type'   => 'Post',
                        'url'    => $this->createUrl('customer/dependentselect'),
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
                <?php echo $form->dropDownlist($model, 'searchField', $model->searchFields,
                    array('class' => 'span3',
                        'options' => array(
                            array_search('Order Name', $model->searchFields) => array('selected' => true
                            ))
                    ));
                ?>
            </div>
            <div class="span3">
                <?php echo $form->textField($model, 'searchValue', array('class' => 'span3'));  ?>
            </div>
            <div class="span1 pull-right">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'      => 'Apply',
                    'buttonType' => 'submit',
                    'type'       => 'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'       => 'null', // null, 'large', 'small' or 'mini'
                ));?>

                <?php echo CHtml::errorSummary($model) ?>
            </div>
        </div>


    <!--- modal window  start----->
    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'remove_order')); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Warning</h4>
    </div>

    <div class="modal-body">
        <p>The order will be deleted from the list of orders!</p>
        <p>Are you sure you want to proceed?</p>
    </div>

    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'        => 'primary',
            'label'       => 'Yes',
            'url'         => '#',
            'htmlOptions' => array('id' => 'modal_remove'),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'       => 'No',
            'url'         => '',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

    <!--- modal window  start----->

</fieldset>
<?php $this->endWidget(); ?>


<?php $grid = $this->widget('TGridView', array(
    'dataProvider'   => $model->search(),
    'type'           => 'striped bordered condensed',
//    'filter'=>$model,
    'ajaxUpdate'     => '',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
    'filterSelector' => '{filter}',
    'template'       => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager'          => array(
        'class'          => 'OmsPager',
        'header'         => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => 'First',
        'prevPageLabel'  => 'Backward',
        'nextPageLabel'  => 'Forward',
        'lastPageLabel'  => 'Last',
        'htmlOptions'    => array(
            'class' => 'yiiPager',
        ),
        'cssFile'   => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',
    'columns' => array(
        array('name' => 'order_name', 'header'    => 'Order Name'),
        array('name' => 'total_price', 'header'   => 'Total Price'),
        array('name' => 'max_discount', 'header'  => 'Max Discount'),
        array('name' => 'delivery_date', 'header' => 'Delivery Date'),
        array('name' => 'status', 'header'        => 'Status'),
        array('name' => 'assignee', 'value'       => '$data->assignees->username'),
        array('name' => 'assigneesRole', 'value'  => '$data->assignees->role'),
        array(
            'header'      => 'Edit',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{edit}',
            'htmlOptions' => array(
            ),
            'buttons'  => array(
                'edit' => array(
                    'icon' => 'pencil',
                    //'url'  => 'Yii::app()->createUrl()',
                ),
            )
        ),
        array(
            'header'      => 'Remove',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{remove}',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#remove_order',
                'click'       => 'beforeRemove'
            ),
            'buttons'    => array(
                'remove' => array(
                    'icon' => 'icon-trash',
                    'url'  => 'Yii::app()->createUrl(\'order/remove\',array(\'id\'=>$data->id_order))',
                ),
            )
        ),
    ),
));?>

<script>
    function beforeRemove(){
        $('#modal_remove').attr('href',$(this).attr('href'));
    }
</script>
