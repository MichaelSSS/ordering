
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'itemsEmpty', 'options'=>array('backdrop'=>'static') )); ?>

<div class='modal-header'>
    <a class='close' data-dismiss='modal'>&times;</a>
    <h4>Error</h4>
</div>

<div class='modal-body'>
   <p id="error-text">

   </p>
</div>

<div class='modal-footer'>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Ok',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>
    <?php $this->endWidget(); ?>

