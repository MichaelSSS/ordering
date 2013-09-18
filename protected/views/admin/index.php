
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


</div>