
<?php $this->widget('bootstrap.widgets.TbTabs', array(
         'type' => 'tabs',
    'placement' => 'above', // 'above', 'right', 'below' or 'left'
         'tabs' => array(
        array('label' => 'Ordering',
            'content' => '',
             'active' => true
             ),
        ),
    ));
?>

<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'horizontalForm',
                          'type' => 'inline',
        'enableClientValidation' => true,
        'clientOptions'          => array(
            'validateOnSubmit'   => true
        )
    ));
?>

<div class="span6">
    <fieldset>
        <legend>Create new order</legend>
        <ul class='nav'>
            <li>Order Name <?php echo $form->textFieldRow($model, 'order_name', array('hint' => '')); ?></li>
            <li><?php echo $form->labelEx($model,'status', array('class'=>'control-label')); ?> Created </li>
            <li>Total number of items <span>12</span></li>
            <li>
                <?php echo  $form->hiddenField($model,'total_price', array('value' => 1200)); ?>
                <?php echo $form->labelEx($model,'total_price', array('class' => 'control-label')); ?> 1200
            </li>
            <li>
                <?php echo $form->labelEx($model,'order_date', array('class' => 'control-label')); ?>
                <?php echo date('m/d/Y'); ?>
                <?php echo  $form->hiddenField($model,'order_date', array('value' => date('m/d/Y'))); ?>
            </li>
            <li>Preferable Date<?php echo $form->textFieldRow($model, 'preferable_date', array('hint' => '',)); ?></li>
            <li><?php echo $form->labelEx($model,'delivery_date', array('class' => 'control-label')); ?> //</li>
            <li><?php echo $form->dropDownListRow($model, 'assignee', $model->getMerchandisers());  ?></li>
        </ul>
        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Save')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'info', 'label' => 'Order')); ?>

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Cancel',
                'type' => 'action',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#myModal',
                ),
            )); ?>
        </div>
    </fieldset>
</div>

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
            'type' => 'primary',
            'label' => 'Yes',
            'url' => $target,

        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                  'label' => 'No',
                    'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )); ?>
        <?php $this->endWidget(); ?>

    </div>

<?php $this->endWidget(); ?>

<script>
    $(function(){
        $("#Order_preferable_date").datepicker();

    })
</script>
