<div id="modal-editing" class="modal hide" data-backdrop="static">
    <div class='modal-header'>
        <a class='close' data-dismiss='modal'>&times;</a>
        <p class='page-appointment'></p>
        <h4 class='modal-title'></h4>
    </div>
    <div id="modal-editing-body" class='modal-body'></div>
    <?php $this->renderPartial('_modal-confirm-save'); ?>
    <div class='modal-footer'>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'   => 'submit',
                'type'         => 'primary',
                'label'        => 'Save',
                'htmlOptions'  => array(
                    'id' => 'edit-save',
                ),
            )); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'         => 'Cancel',
                'type'          => 'action',
                'htmlOptions'   => array(
                    'id' => 'edit-cancel',
                ),
            )); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'reset',
                'label'      => 'Refresh',
                'htmlOptions'   => array(
                    'id' => 'edit-refresh',
                ),
            )); ?>
    </div>
    <div class='edit-shade'></div>    
</div>