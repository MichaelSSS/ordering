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
                <?php echo $form->textField($fields, 'keyValue', array(
                    'onkeyup' => 'document.getElementById(\'btn-search\').disabled = !(this.value.length);',
                    'class' => 'span3',
                    'placeholder' => 'Search'
                )); ?>

                <input class='btn pull-right' type='reset' value='Reset'>
                <input class='btn btn-info pull-right' type='submit' disabled='true' id='btn-search' value='Search'>

            </div>
        </div>
    </div>
</fieldset>
<div class="span10">&nbsp;</div>
<fieldset>
<div class="span3 offset6">
    <a class="pull-right" id="toggle-deleted" href="<?php echo CHtml::normalizeUrl(array('admin/index','showDel'=>'1'));?>">show deleted users</a>
</div>
</fieldset>

<?php $this->endWidget(); ?>
<?php 
$gridParams = require('gridParams.php');
$grid = $this->widget('OmsGridView', $gridParams); 
?>


