<?php

$dataProvider = new CActiveDataProvider('Item');
?>
<div id="grid-extend">

    <?    /* $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'horizontalForm',
        'type'=>'horizontal',
        'enableClientValidation'  =>  true,
        'clientOptions'           =>  array(
            'validateOnSubmit'        =>  true )
    ));*/?>
</div>
<fieldset class="item_search">
    <legend>Search <span>by</span></legend>

    <div id="search-fields">
            <div class="span2">Search for orders by:</div>
            <div class="span3">
                <?php /*echo $form->dropDownlist($model, 'searchCriteria', $model->searchCriteria,
                    array('class' => 'span3',
                        'options' => array(
                            array_search('Name', $model->searchCriterias) => array('selected' => true
                            ))
                    ));
                ?>
            </div>
            <div class="span3">
                <?php //echo $form->textField($model, 'searchValue', array('class' => 'span3'));  ?>
            </div>
            <div class="span1 pull-right">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'      => 'Apply',
                    'buttonType' => 'submit',
                    'type'       => 'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'       => 'null', // null, 'large', 'small' or 'mini'
                ));*/?>

                <?php //echo CHtml::errorSummary($model) ?>
            </div>
        </div>


</fieldset>
<?
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'horizontalForm',
        'type'=>'horizontal',
        'enableClientValidation'  =>  true,
        'clientOptions'           =>  array(
            'validateOnSubmit'        =>  true )
    ));

$grid = $this->widget('TGridView', array(
    'dataProvider'=>$dataProvider,
    'type'           => 'striped bordered condensed',
    'ajaxUpdate'=>'grid-extend',
    'updateSelector'=>'{page}, {sort}, {search-fields}, #page-size',
    'filterSelector'=>'#search-fields',

    'columns'=>array(
		array(
			'name'=>'name',
		),
		array(
			'name'=>'description',
		),
	),
)); ?>
    <div class="row">
        <div class="span10">
            <fieldset >
                   <div class="row">
                    <div class="span5">
                         <?php echo $form->textFieldRow($model, 'name', array('hint'=>'')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span5">
                         <?php echo $form->labelEx($model,'price', array('hint'=>'')); ?>
                   
                    </div>
                </div>
                   <div class="row">
                    <div class="span5">
                         <?php echo $form->labelEx($model,'quantity', array('hint'=>'')); ?>
                    
                    </div>
                </div>
                  <div class="row">
                    <div class="span5">
                         <?php echo $form->labelEx($model,'dimention', array('hint'=>'')); ?>
                    
                    </div>
                </div>
            </fieldset >
        </div>
    </div>
 <?php $this->endWidget(); ?>