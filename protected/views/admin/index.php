<<<<<<< HEAD

<?php $this->renderPartial('/user/_del'); ?> <!--modal-->
<div id="wrapper">
<h6>This page is appointed to create new and managing existing users</h6>

<?php 
    echo CHtml::link('Create New User',array('admin/create'));

    $dataProvider = $model->search();
//file_put_contents('d:\\log.txt', print_r($dataProvider->getTotalItemCount(),true));

    echo '<div id="search-result">Number of Found Users <span id="search-result-count">' 
                 . $dataProvider->getTotalItemCount() . '</span></div>';

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true, 
    ),
));
?>
    <fieldset><legend>&nbspSearch by&nbsp</legend> 
        <div>Field Filter</div>
        <div id="search-fields">
        <?php 
            echo $form->dropDownlist($fields,'keyField',$fields->keyFields, array(
                                            'options'=>array(
                                                array_search('User Name',$fields->keyFields) => array('selected'=>true)
                                            )
            ));
            echo $form->dropDownlist($fields,'criteria',$fields->criterias, 
                                        array(
                                            'options'=>array(
                                                array_search('starts with',$fields->criterias) => array('selected'=>true
                                             ))
            ));
            echo $form->textField($fields,'keyValue');
        ?>
        </div>
        <input class='btn' type='submit' value='Search'>
    </fieldset>
<?php $this->endWidget(); ?>
</div>
   <? $this->renderPartial('grid',array('model'=>$model, 'fields'=>$fields)); ?>
=======
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
<?php $this->renderPartial('/user/_del'); ?> <!--modal-->
<div id="wrapper">
<h6>This page is appointed to create new and managing existing users</h6>

<?php 
    echo CHtml::link('Create New User',array('admin/create'));

    $dataProvider = $model->search();
//file_put_contents('d:\\log.txt', print_r($dataProvider->getTotalItemCount(),true));

    echo '<div id="search-result">Number of Found Users <span id="search-result-count">' 
                 . $dataProvider->getTotalItemCount() . '</span></div>';

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true, 
    ),
));
?>
    <fieldset><legend>&nbspSearch by&nbsp</legend> 
        <div>Field Filter</div>
        <div id="search-fields">
        <?php 
            echo $form->dropDownlist($fields,'keyField',$fields->keyFields, array(
                                            'options'=>array(
                                                array_search('User Name',$fields->keyFields) => array('selected'=>true)
                                            )
            ));
            echo $form->dropDownlist($fields,'criteria',$fields->criterias, 
                                        array(
                                            'options'=>array(
                                                array_search('starts with',$fields->criterias) => array('selected'=>true
                                             ))
            ));
            echo $form->textField($fields,'keyValue');
        ?>
        </div>
        <input class='btn' type='submit' value='Search'>
    </fieldset>
<?php $this->endWidget(); ?>
</div>

<?php $grid = $this->widget('OmsGridView', array(

	'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>'search-result-count',
    'updateSelector'=>'{page}, {sort}, #page-size, .yiiPager',
    'filterSelector'=>'#search-fields',
//    'type' => TbHtml::GRID_TYPE_STRIPED . ' ' . TbHtml::GRID_TYPE_BORDERED ,
    'template' => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager'  => array(
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
    'pagerCssClass'=>'oms-pager',
    'baseScriptUrl' => 'gridview',
	'columns'=> array(
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
                    'url' => 'Yii::app()->createUrl(\'admin/edit\',array(\'id\'=>$data->id))',
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
                    'url' => 'Yii::app()->createUrl(\'admin/remove\',array(\'id\'=>$data->id))',
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
                    'url' => 'Yii::app()->createUrl(\'admin/duplicate\',array(\'id\'=>$data->id))',
                    'label'=>'duplicate',
                    'imageUrl'=>'images/grid_duplicate.bmp',
                ),
            ),
            'template'=>'{duplicate}',
		),
	),
)); 

?>
>>>>>>> 00b46913b5ac4fe73b496b904354d603fa54952d
</div>