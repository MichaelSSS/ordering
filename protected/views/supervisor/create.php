
<fieldset>
    <legend>Item Create</legend>

    <?php /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'   => 'horizontalForm',
            'type' => 'horizontal',
        ));
    ?>
    
    <?php echo $form->textFieldRow($model, 'id_item',array('class' => 'span3',)); ?>

    <?php echo $form->textFieldRow($model, 'price',array('class' => 'span3',)); ?>

    <?php echo $form->textFieldRow($model, 'name',array('class' => 'span3',)); ?>

    <?php echo $form->textAreaRow($model, 'description', array('class' => 'span3', 'rows' => 5)); ?>

    <?php echo $form->textFieldRow($model, 'quantity',array('class' => 'span3',)); ?>

    <div class='form-actions'>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'info',
            'label'      => 'Create',
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'reset',
            'type'       => 'primary',
            'label'      => 'Reset ',
            'size'       => 'null',
            ));
        
         ?>
          <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Cancel',
                    'type' => 'action',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#cancelModal',
                    ),
                )); ?>

    

        <?php $this->endWidget(); ?>
        <?php $this->renderPartial('/supervisor/_cancel'); ?>
    </div>
</fieldset>

	
