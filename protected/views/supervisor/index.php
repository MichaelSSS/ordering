
<script type="text/javascript">
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
<div id="wrapper">
<h6>This page is appointed to create new and managing existing items by supervisor</h6>

<!----------------------------------------------------------------
--- ������ �� �������� ������������------------------------------>
<?php echo CHtml::link('Create New Items',array('supervisor/create'));?>



<div class="form">
 <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
    'enableClientValidation'=>true,
));
?>
    <fieldset><legend>&nbspSearch by&nbsp</legend> 
        <div>Field Filter</div>
        <div id="search-fields">
        <?php 
            echo $form->dropDownlist($fields,'keyField',$fields->keyFields);
            echo $form->dropDownlist($fields,'criteria',$fields->criterias);
            echo $form->textField($fields,'keyValue');
        ?>
        </div>
        <input type='submit' value='Search'>
    </fieldset>
<?php $this->endWidget(); ?>
</div>
<div id="grid-extend">
<?php echo CHtml::link('show ' . $model->nextPageSize[$model->currentPageSize] . ' items',
    array(
        'supervisor/index',
        'pageSize'=>$model->nextPageSize[$model->currentPageSize],
    ),
    array('id'=>'page-size')
);?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
//    'filter'=>$model,
    'ajaxUpdate'=>'grid-extend,search-fields',
    'updateSelector'=>'{page}, {sort}, #page-size',
    'filterSelector'=>'{filter}, #search-fields',
	'columns'=>array(
		array(
			'name'=>'id_item',
		),
            array(
                'name'=>'id_price',
                
            ),
		array(
			'name'=>'name',
		),
		array(
			'name'=>'description',
		),
	
		array(
			'name'=>'quantity',
		),
		array(
			'class'=>'CButtonColumn',
                   
            'header'=>'Edit',
            'buttons'=>array(
                'edit'=>array(
                    'url' => 'Yii::app()->createUrl(\'supervisor/edit\',array(\'id\'=>$data->id_item))',
                    'label'=>'edit',
                    'imageUrl'=>'images/grid_edit.png',
                ),
            ),
            'template'=>'{edit}',
		),
		array(
			'class'=>'CButtonColumn',
            'header'=>'Remove',
              'htmlOptions'=>array(
                'data-toggle'=>'modal',
                'data-target'=>'#myModal',
                'class'=>'remove',
            ),       
            'buttons'=>array(
               
                'remove'=>array(
                    'url' => 'Yii::app()->createUrl(\'supervisor/remove\',array(\'id\'=>$data->id_item))',
                    'label'=>'remove',
                    'imageUrl'=>'images/grid_remove.bmp',
                ),
            ),
            'template'=>'{remove}',
		),
		array(
			'class'=>'CButtonColumn',
                   
            'header'=>'Duplicate',
            'buttons'=>array(
                'duplicate'=>array(
                    'url' => 'Yii::app()->createUrl(\'supervisor/duplicate\',array(\'id\'=>$data->id_item))',
                    'label'=>'duplicate',
                    'imageUrl'=>'images/grid_duplicate.bmp',
                ),
            ),
            'template'=>'{duplicate}',
		),
	),
)); ?>
</div>
<?php $this->renderPartial('/supervisor/_del'); ?>