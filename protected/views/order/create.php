<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'        =>  true )
));
?>
<?php
//    $cs = Yii::app()->getClientScript();
//    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-ui-1.10.2.js');
//    $cs->registerCssFile(Yii::app()->baseUrl.'/css/yourcss.css');
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css'
    );
?>
<div class="container">
    <div class="row">
        <div class="row">
            <h1>Order creation</h1>
        </div>
        <div class="row">
            <fieldset>
                <legend>Create new Order</legend>

                <div class="row">
<!--                    --><?php //var_dump($model) ;exit; ?>
                    <?php echo $form->textFieldRow($model, 'order_name', array('hint'=>'')); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'status', array('class'=>'control-label')); ?>
                    <?php echo "Created"; ?>
                </div>
                <div class="row">
                    <?php echo "<label class='control-label'>Total number of items</label>"; ?>
                    <?php echo  "12";  ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'total_price', array('class'=>'control-label')); ?>
                    <?php echo 1200; ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'order_date', array('class'=>'control-label')); ?>
                    <?php echo date('m/d/Y'); ?>
                </div>
                <div class="row">
                    <?php echo $form->textFieldRow($model, 'preferable_date', array('hint'=>'',)); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'delivery_date', array('class'=>'control-label')); ?>
                    <?php echo "//"; ?>
                </div>
                <div class="row">
                    <?php echo $form->dropDownListRow($model, 'assignee', $model->getMerchandisers());  ?>
                </div>
            </fieldset>
        </div>

        <div class="row">
            <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Create')); ?>


                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Cancel',
                    'type'=>'action',
                    'htmlOptions'=>array(
                        'data-toggle'=>'modal',
                        'data-target'=>'#myModal',
                    ),
                )); ?>


                <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

                <div class="modal-header">
                    <a class="close" data-dismiss="modal">&times;</a>
                    <h4>Warning</h4>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to cancel operation?</p>
                    <p>All data will be lost</p>
                </div>

                <?php $target = $this->createUrl('customer/index'); ?>

                <div class="modal-footer">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'type'=>'primary',
                        'label'=>'Yes',
                        'url'=> $target,

                    )); ?>
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label'=>'No',
                        'url'=>'#',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                    )); ?>
                    <?php $this->endWidget(); ?>

                </div>
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Refresh')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $("#Order_preferable_date").datepicker();

    })
</script>
