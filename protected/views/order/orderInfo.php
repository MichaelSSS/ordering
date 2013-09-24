
<fieldset>
                <legend>Totals</legend>
                <div class="row">
                    <div class="span5">
                        <?php echo $form->textFieldRow($model, 'order_name', array('hint' => '')); ?>
</div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo "Created"; ?></div>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo "<label class='control-label'>Total number of items</label>"; ?>
        <div class="text-order"><?php echo "12"; ?></div>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($model, 'total_price', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo "1200" . "\$"; ?></div>
        <?php echo $form->hiddenField($model, 'total_price', array('value' => 1200)); ?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($model, 'order_date', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo date('m/d/Y'); ?></div>
        <?php echo $form->hiddenField($model, 'order_date', array('value' => date('m/d/Y'))); ?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->textFieldRow($model, 'preferable_date', array('hint' => '',)); ?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($model, 'delivery_date', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo "//"; ?></div>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->dropDownListRow($model, 'assignee', $model->getMerchandisers()); ?>
    </div>
</div>
</fieldset>
