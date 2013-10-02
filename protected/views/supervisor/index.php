<script>
    $(document).ready(function () {
        $('.remove a').live('click',function(){
            var link = $(this).attr('href');
            $('.btn-primary').attr('href',link);
        })

        $('.remove').click(function(){
            var link = $(this).find('a').attr('href');
            $('.btn-primary').attr('href',link);

        })
    });
</script>

<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'      => 'tabs',
    'placement' => 'above', // 'above', 'right', 'below' or 'left'
    'tabs'      => array(
        array('label' => 'Item Management ',
            'content' => '<p>This page is appointed to create new and managing existing items by supervisor</p>',
            'active'  => true
        ),
    ),
));
?>

<?php echo CHtml::link('Create New Items',array('supervisor/create'));?>


 <?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'search-form',
    'enableClientValidation' => true,
));
?>

<fieldset>
    <legend>Search <span>by</span></legend>
  
    <div class='control-group'>
        <div class='controls'>
            <div class='span3'>
              
  <?php echo $form->dropDownlist($model, 'searchCriteria', $model->searchCriterias,
                array('class' => 'span3',
                    'options' => array(
                        array_search('id_item', $model->searchCriterias) => array('selected' => true
                        ))
                ));
            ?>

                
            </div>
            <div class='span3'>
               
            <?php echo $form->textField($model, 'searchValue', array('class' => 'span3')); ?>
        
            </div>
            
            <div class="span1 pull-right">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Apply',
                'buttonType' => 'submit',
                'type' => 'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'null', // null, 'large', 'small' or 'mini'
            ));?>
            
           
               
                
            </div>
        </div>
    </div>
</fieldset>

<?php $this->endWidget(); ?>




<?php $this->widget('TGridView', array(
    'id'             => 'grig-extend',
    'type'           => 'striped bordered condensed',
    'dataProvider'   => $model->search(),
    'ajaxUpdate'     => 'search-result-count',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
//    'filterSelector' => '#search-fields',
//    'filter'=>$model,
    'template'       => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager'          => array(
        'class'          => 'OmsPager',
        'header'         => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => '&lsaquo; First',
        'prevPageLabel'  => '&larr; Backward',
        'nextPageLabel'  => 'Forward &rarr;',
        'lastPageLabel'  => 'Last &rsaquo;',
        'htmlOptions'    => array(
            'class'      => 'yiiPager',
        ),
        'cssFile'        => 'css/pager.css',
    ),
    'pagerCssClass'  => 'oms-pager',
    'baseScriptUrl'  => 'gridview',
    'columns'        => array(
        array('name' => 'id_item', 'header'     => 'Id Item'),
        array('name' => 'name', 'header'        => 'Name'),
        array('name' => 'description', 'header' => 'Description'),
        array('name' => 'price', 'header'       => 'Price','value'=>'$data->price." $"'),
        array('name' => 'quantity', 'header'    => 'Quantity'),
        array(
            'header'      => 'Update',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{edit}',
            'htmlOptions' => array(
            ),
            'buttons'  => array(
                'edit' => array(
                    'icon' => 'pencil',
                    'url'  => 'Yii::app()->createUrl(\'supervisor/edit\',array(\'id\'=>$data->id_item))',
                ),
            )
        ),
        array(
            'header'      => 'Remove',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{remove}',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                'class'       => 'remove'
            ),
            'buttons'    => array(
                'remove' => array(
                    'icon' => 'icon-remove',
                    'url'  => 'Yii::app()->createUrl(\'supervisor/remove\',array(\'id\'=>$data->id_item))',
                ),
            )
        ),
    ),
));
?>
<?php $this->renderPartial('/supervisor/_del'); ?>
