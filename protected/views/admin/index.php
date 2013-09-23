<?php $this->renderPartial('/user/_del'); ?> <!--modal-->

<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'      => 'tabs',
    'placement' => 'above', // 'above', 'right', 'below' or 'left'
    'tabs'      => array(
        array('label' => 'Administration',
            'content' => '<p>This page is appointed for creating new and managing existing users</p>',
            'active'  => true
        ),
    ),
));
?>

<?php echo CHtml::link('Create New User', array('admin/create'));
$dataProvider = $model->search();
//file_put_contents('d:\\log.txt', print_r($dataProvider->getTotalItemCount(),true));
echo '<div id="search-result">Number of Found Users <span id="search-result-count">'
    . $dataProvider->getTotalItemCount() . '</span></div>';
?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                     => 'search-form',
    'enableClientValidation' => true,
    'type'                   => 'inline',
    'clientOptions'          => array(
        'validateOnSubmit'   => true,
    ),
    'htmlOptions' => array(
        'class'   => '',
    )
));
?>

<fieldset>
    <legend>Search <span>by</span></legend>
    <div class='span9'><p>Field Filter</p></div>
    <div class='control-group'>
        <div class='controls'>
            <div class='span3'>
                <?php echo $form->dropDownListRow($fields, 'keyField',
                    array('All Columns', 'User Name', 'First Name', 'Last Name', 'Role'),
                    array('class' => 'span3',
                        'options' => array(
                            array_search('User Name', $fields->keyFields) => array(
                                'selected' => true
                            )
                        )
                    ));
                ?>
            </div>
            <div class='span3'>
                <?php echo $form->dropDownListRow($fields, 'criteria',
                    array('equals', 'not equal to', 'starts with', 'contains', 'does not contain'),
                    array('class' => 'span3',
                        'options' => array(
                            array_search('starts with', $fields->criterias) => array(
                                'selected' => true
                            )
                        )
                    ));
                ?>
            </div>
            <div class='span3'>
                <?php echo $form->textField($fields, 'keyValue', array('class' => 'span3', 'placeholder' => 'Search')); ?>

                <input class='btn btn-info pull-right' type='submit' value='Search'>

            </div>
        </div>
    </div>
</fieldset>

<?php $this->endWidget(); ?>
<?php $this->renderPartial('grid', array('model' => $model, 'fields' => $fields)); ?>

<?php //$this->renderPartial('grid',array('dataProvider'=>$dataProvider, 'fields'=>$fields)); ?>



<?php /*$this->renderPartial('/user/_del'); */?> <!--modal-->-->

<!--<div id="wrapper">
    <h6>This page is appointed to create new and managing existing users</h6>

    <?php
/*    echo CHtml::link('Create New User',array('admin/create'));

    $dataProvider = $model->search();

    echo '<div id="search-result">Number of Found Users <span id="search-result-count">'
        . $dataProvider->getTotalItemCount() . '</span></div>';

    */?>

    <div class="form">

        <?php /*$form=$this->beginWidget('CActiveForm', array(
            'id'=>'search-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        ));
        */?>
        <fieldset><legend>&nbspSearch by&nbsp</legend>
            <div>Field Filter</div>
            <div id="search-fields">
                <?php
/*                echo $form->dropDownlist($fields,'keyField',$fields->keyFields, array(
                    'options'=>array(
                        array_search('User Name',$fields->keyFields) => array('selected'=>true),
                    )
                ));
                echo $form->dropDownlist($fields,'criteria',$fields->criterias, array(
                    'options'=>array(
                        array_search('starts with',$fields->criterias) => array('selected'=>true),
                    )
                ));
                echo $form->textField($fields,'keyValue');
                */?>
            </div>
            <input class='btn' type='submit' value='Search'>
        </fieldset>
        <?php /*$this->endWidget(); */?>
    </div>
    <?php /*$this->renderPartial('grid',array('dataProvider'=>$dataProvider, 'fields'=>$fields)); */?>
</div>-->

