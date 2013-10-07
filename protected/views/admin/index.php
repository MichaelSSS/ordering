<?php $this->renderPartial('_del'); ?> <!--modal-->


<p>This page is appointed for creating new and managing existing users</p>
<div class="span3">
    <?php echo CHtml::link('Create New User ', array('admin/create'));  ?>
    <?php   $dataProvider = $model->search(); 
        echo '<div id="search-result" >Number of Found Users<span id="search-result-count">'
            . $dataProvider->getTotalItemCount() . '</span></div>';
    ?>
</div> 

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
            <div class='row'>
                <div class="input-append">
                    <?php echo $form->textField($fields, 'keyValue', array(
                        'onkeyup' => 'document.getElementById(\'btn-search\').disabled = !(this.value.length);',
                        'class' => 'span2',
                        'placeholder' => 'Search'
                    )); ?>
                    <button class='btn btn-info' type='submit' disabled='true' id='btn-search'>Search</button>
                    <button class="btn" type="reset">Reset</button> 
                </div>
            </div>>
        </div>
    </div>
</fieldset>
<div class="span12">&nbsp;</div>
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


