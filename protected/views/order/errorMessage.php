<!-- Modal -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'errorModal')); ?>
<div id='errorModal' class="modal" role="dialog" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Error</h4>
    </div>
    <div id='errorMessage' class="modal-body">
        <p>  </p>
    </div>
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'OK',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<!-- Modal -->