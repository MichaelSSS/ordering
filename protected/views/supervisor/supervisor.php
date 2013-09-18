<?php
//$dataProvider = new CActiveDataProvider('Item');
$dataProvider = $model->search(); 
//ArticleData::model()->with('article','article.category')->findAll();
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true, 
    ),
));
   
   $emps=price::model()->with('item')->findAll();   
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
         <?php

                echo CHtml::SubmitButton('submit', '',
                    array(
                        'type' => 'GET',
                        'update' => 'search-fields',
                    ),
                    array(
                        'type' => 'submit',
                    ));


                ?>
        
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
<?php $grid = $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>'grid-extend',
    'updateSelector'=>'{page}, {sort}, {search-fields}, #page-size',
    'filterSelector'=>'#search-fields',

    'columns'=>array(
		array(
			'name'=>'id_item',
		),
		array(
			'name'=>'name',
		),
		array(
			'name'=>'description',
		),
		array(
			'name'=>'price.price',
                        //'value'=>'$emps[id_item]->price->id_price',
		),
		array(
			'name'=>'quantity',
		),
        	array(
			'name'=>'totalprice',
                   'value'=>'$data->Totalprice',
                    

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