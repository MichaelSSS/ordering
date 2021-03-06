<div class="row">
    <div class="span5">
        <?php echo $form->textFieldRow($order, 'order_name', array('class' => 'input-large')); ?>
        <?php echo $form->hiddenField($order, 'id_order', array('value' => $order->id_order)); ?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($order, 'status', array('class' => 'control-label')); ?>
        <div class="text-order"><?php echo (empty($order->status)) ? "Created" : $order->status; ?></div>
        <?php echo $form->hiddenField($order, 'status', array('value' => $order->status)); ?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo "<label class='control-label'>Total number of items</label>"; ?>
        <div class="text-order"><?php echo OrderDetails::$totalItemsQuantity; ?></div>
        <?php echo $form->hiddenField($order, 'totalQuantity', array('value' => OrderDetails::$totalItemsQuantity)); ?>
        <?php echo $form->error($order, 'totalQuantity'); ?>
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
        <div class="text-order"><?php echo Yii::app()->dateFormatter->format("MM/dd/yyyy", $order->order_date); ?></div>
        <?php echo $form->hiddenField($order, 'order_date', array('value' => Yii::app()->dateFormatter->format("MM/dd/yyyy", $order->order_date))); ?>
    </div>
</div>
<div class="row">
    <div class="span5">
        <a href="#" class='clndr'>
            <?php echo $form->textFieldRow($order, 'preferable_date', array(
                'class' => 'input-large',
                'title' => 'Type date in format mm/dd/yyyy',
                'append' => '<i class="icon-calendar icon-large clndr"></i>',
                'value' => Yii::app()->dateFormatter->format("MM/dd/yyyy", $order->preferable_date)
            )); ?>
        </a>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->labelEx($order, 'delivery_date', array('class' => 'control-label')); ?>
        <div class="text-order">
            <?php echo ($order->delivery_date != "0000-00-00") ?
                Yii::app()->dateFormatter->format("MM/dd/yyyy", $order->delivery_date) : "//";; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="span5">
        <?php echo $form->dropDownListRow($order, 'assignee', $order->getMerchandisers()); ?>
    </div>
</div>

