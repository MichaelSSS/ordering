<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'   => '',
    'type' => 'horizontal',
)); ?>

    <fieldset>
        <legend>totals</legend>
        <div class="row">
            <div class="span5">
                <?php echo $form->textFieldRow($order, 'order_name'); ?>
            </div>
        </div>    
        <div class="row">
            <div class="span5">
                <dl class="dl-horizontal">
                    <dt>
                        <?php echo $form->labelEx($order, 'status', array('class' => 'control-label')); ?>
                    </dt>
                    <dd class='block'>
                        <?php echo "Created"; ?>
                    </dd>
                    <dt>
                        <?php echo "<label class='control-label'>Total number of items</label>"; ?>
                    </dt>
                    <dd class='block'>
                        <?php echo OrderDetails::$totalItemsQuantity; ?>
                        <?php echo $form->hiddenField($order, 'totalQuantity', array('value' => OrderDetails::$totalItemsQuantity)); ?>
                    </dd>
                    <dt>
                        <?php echo $form->labelEx($order, 'total_price', array('class' => 'control-label')); ?>
                    </dt>
                    <dd class='block'>
                        <?php echo OrderDetails::$totalPrice . "\$"; ?>
                        <?php echo $form->hiddenField($order, 'total_price', array('value' => OrderDetails::$totalPrice)); ?>
                    </dd>
                    <dt>
                        <?php echo $form->labelEx($order, 'order_date', array('class' => 'control-label')); ?>
                    </dt>
                    <dd class='block'>
                        <?php echo date('m/d/Y'); ?>
                    </dd>
                </dl>
            </div>
        </div>    
        <div class="row">
            <div class="span5">
                <?php echo $form->hiddenField($order, 'order_date', array('value' => date('m/d/Y'))); ?>

                <?php echo $form->textFieldRow($order, 'preferable_date', array(
                    'title'  => 'Type date in format mm/dd/yyyy',
                    'append' => "<i class='icon-calendar icon-large'></i>",
                )); ?>

                <?php echo $form->textFieldRow($order, 'delivery_date', array(
                    'disabled'    => true,
                    'append'      => "<i class='icon-calendar-empty icon-large'></i>",
                    'placeholder' => '//',
                 )); ?>

                <?php echo $form->dropDownListRow($order, 'assignee', $order->getMerchandisers()); ?>
            </div>
        </div>
    </fieldset>
<?php $this->endWidget(); ?>
