<h6>This page is appointed to create new and managing existing users</h6>

<!----------------------------------------------------------------
--- ссылка на создание пользователя------------------------------>
<?php echo CHtml::link('Create New User',array('admin/create'));?>



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
            echo $form->dropDownlist($fields,'keyField',$fields->keyFields, 
                                        array(
                                            'options'=>array(
                                                array_search('User Name',$fields->keyFields) => array('selected'=>true)
                                        )
            ));
            echo $form->dropDownlist($fields,'criteria',$fields->criterias, 
                                        array(
                                            'options'=>array(
                                                array_search('starts with',$fields->criterias) => array(
                                                                                                    'selected'=>true
                                             ))
            ));
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
        'admin/index',
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
			'name'=>'username',
		),
		array(
			'name'=>'firstname',
		),
		array(
			'name'=>'lastname',
		),
		array(
			'name'=>'role',
		),
		array(
			'name'=>'email',
		),
		array(
			'name'=>'region',
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
		array(
			'class'=>'CButtonColumn',
            'header'=>'Duplicate',
            'buttons'=>array(
                'duplicate'=>array(
                    'label'=>'duplicate',
                    'imageUrl'=>'images/grid_duplicate.bmp',
                ),
            ),
            'template'=>'{duplicate}',
		),
	),
)); ?>
