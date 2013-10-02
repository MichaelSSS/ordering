
<div id="grid-extend">


</div>
<fieldset class="item_search">
    <legend>Search <span>by</span></legend>


    <?php $searchForm = $this->beginWidget('CActiveForm', array(
        'id' => 'search-form',
        'method' => 'GET',
    ));
    ?>


    <div class="span2"><p>Search for item by:</p></div>
    <div class="span3">
        <?php echo $searchForm->dropDownlist($model, 'searchCriteria', $model->searchCriterias, array(
            'class' => 'span3',
            'options' => array(
                array_search('Item Name', $model->searchCriterias) => array('selected' => true)
            ),
        ));
        ?>
    </div>
    <div class="span3">
        <?php echo $searchForm->textField($model, 'searchValue', array('class' => 'span3')); ?>
    </div>

    <div class="span1 pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Apply',
            'buttonType' => 'submit',
            'type' => 'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'null', // null, 'large', 'small' or 'mini'
        ));?>
        <?php echo CHtml::errorSummary($model) ?>
    </div>

    <?php $this->endWidget(); ?>

</fieldset>
<?


$grid = $this->widget('TGridView', array(
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'ajaxUpdate' => '',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
    'filterSelector' => '{filter}',
    'template' => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager' => array(
        'class' => 'OmsPager',
        'header' => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => '&lsaquo; First',
        'prevPageLabel'  => '&larr; Backward',
        'nextPageLabel'  => 'Forward &rarr;',
        'lastPageLabel'  => 'Last &rsaquo;',
        'htmlOptions' => array(
            'class' => 'yiiPager',
        ),
        'cssFile' => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',

    'columns'=>array(
		array(
			'name'=>'name',
		),
		array(
			'name'=>'description',
		),
	),
)); ?>

<?php
$itemForm = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'        =>  true )
));
?>
    <div class="row">
        <div class="span10">
            <fieldset >
                   <div class="row">
                    <div class="span5">
                         <?php echo $itemForm->textFieldRow($model, 'name', array('hint'=>'')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span5">
                         <?php echo $itemForm->labelEx($model,'price', array('hint'=>'')); ?>
                   
                    </div>
                </div>
                   <div class="row">
                    <div class="span5">
                         <?php echo $itemForm->labelEx($model,'quantity', array('hint'=>'')); ?>
                    
                    </div>
                </div>
                  <div class="row">
                    <div class="span5">
                         <?php echo $itemForm->labelEx($model,'dimention', array('hint'=>'')); ?>
                    
                    </div>
                </div>
            </fieldset >
        </div>
    </div>
 <?php $this->endWidget(); ?>