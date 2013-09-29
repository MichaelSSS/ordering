<fieldset>
                <legend>Totals</legend>
                <div class="row">
                    <div class="span5">
                    <?php echo $form->textFieldRow($order, 'order_name', array('hint' => '')); ?>
</div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($order, 'status', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo "Created"; ?></div>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo "<label class='control-label'>Total number of items</label>"; ?>
        <div class="text-order"><?php echo OrderDetails::$totalItemsQuantity; ?></div>
        <?php echo $form->hiddenField($order, 'totalQuantity', array('value' =>OrderDetails::$totalItemsQuantity)); ?>
        <?php echo $form->error($order,'totalQuantity');?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($order, 'total_price', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo OrderDetails::$totalPrice . "\$"; ?></div>
        <?php echo $form->hiddenField($order, 'total_price', array('value' => OrderDetails::$totalPrice)); ?>

    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($order, 'order_date', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo date('m/d/Y'); ?></div>
        <?php echo $form->hiddenField($order, 'order_date', array('value' => date('m/d/Y'))); ?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->textFieldRow($order, 'preferable_date', array('hint' => '', 'title'=>'Type date in format mm/dd/yyyy')); ?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($order, 'delivery_date', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo "//"; ?></div>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->dropDownListRow($order, 'assignee', $order->getMerchandisers()); ?>
    </div>
</div>
</fieldset>
