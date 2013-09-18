<h6>This page is appointed to create new and managing existing users</h6>

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

<fieldset>
    <legend>&nbspSearch by&nbsp</legend>

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
            echo $form->dropDownlist($model, 'searchField', $model->searchFields,
                array(
                    'options' => array(
                        array_search('Order Name', $model->searchFields) => array('selected' => true
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

    <!--- modal window  start----->
    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'remove_order')); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Warning</h4>
    </div>

    <div class="modal-body">
        <p>The order will be deleted from the list of orders!!!</p>
        <p>Are you sure you want to proceed???</p>
    </div>

    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'label'=>'Yes',
            'url'=>'#',
            'htmlOptions'=>array('id'=>'modal_remove'),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'No',
            'url'=>'',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

    <!--- modal window  start----->

</fieldset>
<?php $this->endWidget(); ?>




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
        'total_price',

        'max_discount',
        'delivery_date',
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
