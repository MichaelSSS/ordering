<h6>This page is appointed to create new and managing existing users</h6>

<!----------------------------------------------------------------
--- ?????? ?? ???????? ????????????------------------------------>
<?php echo CHtml::link('Create New Order',array('order/create'));?>





<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
//    'filter'=>$model,
    'ajaxUpdate'=>'grid-extend,search-fields',
    'updateSelector'=>'{page}, {sort}, #page-size',
    'filterSelector'=>'{filter}, #search-fields',
	'columns'=>array(
        'order_name',
        'total_price',
        'max_discount',
		array(
			'name'=>'delivery_date',
		),
		array(
			'name'=>'status',
			'value'=>'status',
		),

		array(
			'name'=>'username',
			'value'=>'$data->assignees->username',
		),
		array(
			'name'=>'role',
			'value'=>'$data->assignees->role',
            'sortable'=>'true',
		),
		array(
			'name'=>'password',
			'value'=>'$data->assignees->password',
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
