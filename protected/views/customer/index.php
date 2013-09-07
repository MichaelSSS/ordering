<h6>This page is appointed to create new and managing existing users</h6>

<!----------------------------------------------------------------
--- ?????? ?? ???????? ????????????------------------------------>
<?php echo CHtml::link('Create New Order',array('order/create'));?>



<?php /*$form=$this->beginWidget('CActiveForm', array(
    'id'=>'search-form',
    'enableClientValidation'=>true,
));
*/?>
<fieldset><legend>&nbspSearch by&nbsp</legend>
    <div>Field Filter</div>
    <div id="search-fields">
        <?php/*
        echo $form->dropDownlist($fields,'keyField',$fields->keyFields);
        echo $form->dropDownlist($fields,'criteria',$fields->criterias);
        echo $form->textField($fields,'keyValue');
       */ ?>
    </div>
    <input type='submit' value='Search'>
</fieldset>
<?php /*$this->endWidget();*/ ?>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'filter'=>$model,
    'ajaxUpdate'=>'grid-extend,search-fields',
    'updateSelector'=>'{page}, {sort}, #page-size',
    'filterSelector'=>'{filter}, #search-fields',
	'columns'=>array(
        'order_name',
        'total_price',

        'max_discount',
		'delivery_date',
		'status',


		array(
			'name'=>'assignee',
			'value'=>'$data->assignees->username',
		),
		array(
			'name'=>'assigneesRole',
			'value'=>'$data->assignees->role',

		),


		array(
			'class'=>'CButtonColumn',
            'header'=>'Edit',
            'buttons'=>array(
                'edit'=>array(
                    'label'=>'edit',
                    'imageUrl'=>'images/grid_edit.png',
                ),
            ),
            'template'=>'{edit}',
		),
		array(
			'class'=>'CButtonColumn',
            'header'=>'Remove',
            'buttons'=>array(
                'remove'=>array(
                    'label'=>'remove',
                    'imageUrl'=>'images/grid_remove.bmp',
                ),
            ),
            'template'=>'{remove}',
		),

	),
));?>
