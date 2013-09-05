<p>This page is appointed to create new and managing existing users</p>


<?php echo CHtml::link('Create New User',array('user/create'));?>



<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
    <fieldset>
        <legend>Search by</legend> 
 <!--           <p>field Filter</p>
        <div class="row">
            <div class="span4">
                <?php /*echo $form->dropDownListRow($model, 'keyField', array('All Columns', 'User Name', 'First Name', 'Last Name', 'Role',)); */?>
            </div>
            <div class="span4">
                <?php /*echo $form->dropDownListRow($model, 'criteria', array('equals', 'not equals to', 'start with', 'contains', 'does not contain')); */?>
            </div>
            <div class="span4">
                <?php /*/** @var BootActiveForm $form */
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'searchForm',
                        'type'=>'search',
                        'htmlOptions'=>array('class'=>'well'),
                    )); */?>
                    <?php /*echo $form->textFieldRow($model, 'textField', array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>')); */?>
            </div>
        </div>-->





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
