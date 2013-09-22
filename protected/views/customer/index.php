
<!----------------------------------------------------------------
--- ?????? ?? ???????? ????????????------------------------------>
<?php echo CHtml::link('Create New Order', array('order/create')); ?>
<?php ?>


<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
//    'enableClientValidation' => true,
//    'clientOptions' => array(
//        'validateOnSubmit' => true,
//    ),
));
?>

<fieldset class="order_search">
    <legend>&nbsp;Search by&nbsp;</legend>

    <div id="search-fields">
        <div class="row">
            <div class="span2">Filter by</div>
            <div class="span3 offset">
            <?php
            echo $form->dropDownlist($model, 'filterCriteria', $model->filterCriterias, array(
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
            <?php
            echo $form->dropDownlist($model, 'filterValue', $model->filterStatuses,
                array(
                    'options' => array(
                        array_search('None', $model->filterStatuses) => array('selected' => true
                        )),

                ));
            ?>
        </div>
        </div>
        <div class="row">
            <div class="span2">Search by</div>
            <div class="span3 offset">
            <?php
            echo $form->dropDownlist($model, 'searchCriteria', $model->searchCriterias,
                array(
                    'options' => array(
                        array_search('Order Name', $model->searchCriterias) => array('selected' => true
                        ))
                ));
            ?>
            </div>
            <div class="span3">
            <?php
            echo $form->textField($model, 'searchValue');
            ?>
            </div>
            <div class="span1">

                <?php



              $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Search',
                    'buttonType'=>'submit',
                    'type'=>'action', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'=>'small', // null, 'large', 'small' or 'mini'
                ));?>

                <?php echo CHtml::errorSummary($model) ?>
            </div>
        </div>
    </div>

</fieldset>
<?php $this->endWidget(); ?>

<?php $this->renderPartial('/customer/_delete'); ?>



<?php $grid = $this->widget('OmsGridView', array(
    'dataProvider' => $model->search(),
//    'filter'=>$model,
    'ajaxUpdate' => '',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
    'filterSelector' => '{filter}',
    'template' => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager' => array(
        'class' => 'OmsPager',
        'header' => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => 'First',
        'prevPageLabel' => 'Backward',
        'nextPageLabel' => 'Forward',
        'lastPageLabel' => 'Last',
        'htmlOptions' => array(
            'class' => 'yiiPager',
        ),
        'cssFile' => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',
    'columns' => array(
        'order_name',

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
            'value' => 'Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($data->delivery_date));',
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
            'class' => 'CButtonColumn',
            'header' => 'Edit',
            'buttons' => array(
                'edit' => array(
                    'label' => 'edit',
                    'imageUrl' => 'images/grid_edit.png',
                ),
            ),
            'template' => '{edit}',
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Remove',
            'buttons' => array(
                'remove' => array(
                    'url' => 'Yii::app()->createUrl(\'order/remove\',array(\'id\'=>$data->id_order))',
                    'label' => 'remove',
                    'imageUrl' => 'images/grid_remove.bmp',
                    'options'=>array( 'data-toggle'=>'modal',
                        'data-target'=>'#remove_order',),
                    'click'=>'beforeRemove',
                ),
                'htmlOptions'=>array(

                ),

            ),

            'template' => '{remove}',
        ),

    ),
));?>

<script type="text/javascript">
    function beforeRemove(){
        $('#modal_remove').attr('href',$(this).attr('href'));
    }
</script>
