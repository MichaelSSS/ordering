
<fieldset>
    <legend>Item Create</legend>

    <?php /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'   => 'horizontalForm',
            'type' => 'horizontal',
        ));
    ?>
    <div class='row'>
        <?php echo $form->textFieldRow($model, 'id_item', array('hint'=>'')); ?>
    </div>
    <div class='row'>
        <?php echo $form->textFieldRow($model, 'price', array('hint'=>'')); ?>
    </div>
    <div class='row'>
        <?php echo $form->textFieldRow($model, 'name', array('hint'=>'')); ?>
    </div>
    <div class='row'>
        <?php echo $form->textFieldRow($model, 'description', array('hint'=>'')); ?>
    </div>
    <div class='row'>
        <?php echo $form->textFieldRow($model, 'quantity',array('hint'=>'')); ?>
    </div>

    <div class='form-actions'>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'info',
            'label'      => 'Create',
            'size'       => 'null',));
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'reset',
            'type'       => 'primary',
            'label'      => 'Reset ',
            'size'       => 'null',
            ));
         ?>
        <?php $this->endWidget(); ?>
    </div>
</fieldset>

	
