<!--- modal window  start----->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'remove_order')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Warning</h4>
</div>

<div class="modal-body">
    <p>The order will be deleted from the list of orders!</p>

    <p>Are you sure you want to proceed?</p>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Yes',
        'url' => '#',
        'htmlOptions' => array('id' => 'modal_remove'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'No',
        'url' => '',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    )); ?>
</div>

<?php $this->endWidget(); ?>
<!--- modal window  start----->
