<?php $this->renderPartial('/user/_del'); ?> <!--modal-->
<?php $this->widget('bootstrap.widgets.TbTabs', array(
         'type' => 'tabs',
    'placement' => 'above', // 'above', 'right', 'below' or 'left'
         'tabs' => array(
        array('label' => 'Administration',
            'content' => '',
             'active' => true
             ),
        ),
    ));
?>

<div id="wrapper">
<h6>This page is appointed to create new and managing existing users</h6>

<?php
    echo CHtml::link('Create New User',array('admin/create'));

    $dataProvider = $model->search();

    echo '<div id="search-result">Number of Found Users <span id="search-result-count">'
                 . $dataProvider->getTotalItemCount() . '</span></div>';

?>

<div class="admin-form">

    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'search-form',
    	'enableClientValidation'=>true,
    	'clientOptions'=>array(
    		'validateOnSubmit'=>true,
        ),
    ));
    ?>
    <fieldset><legend>&nbspSearch by&nbsp</legend>
        <div class="span1"></div><div class="span9">Field Filter</div>
        <div id="search-fields">
        <div class="span3">
            <?php
            echo $form->dropDownlist($fields,'keyField',$fields->keyFields, array(
                'options'=>array(
                    array_search('User Name',$fields->keyFields) => array('selected'=>true),
                )
            ));
            ?>
        </div>
        <div class="span3">
            <?php
            echo $form->dropDownlist($fields,'criteria',$fields->criterias, array(
                'options'=>array(
                    array_search('starts with',$fields->criterias) => array('selected'=>true),
                 )
            ));
            ?>
        </div>
        <div class="span3 pull-right">
            <?php
            echo $form->textField($fields,'keyValue');
            ?>
        </div>
        <div class="row"></div>
        </div>
        <div class="pull-right">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'      => 'Search',
                'buttonType' => 'submit',
                'type'       => 'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'       => 'null', // null, 'large', 'small' or 'mini'
            ));?>
        </div>
    </fieldset>
    <?php $this->endWidget(); ?>
</div>
<?php 
$gridParams = require('gridParams.php');
$grid = $this->widget('OmsGridView', $gridParams); 
?>
</div>