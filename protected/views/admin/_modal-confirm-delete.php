<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'confirm-deleting','options'=>array('backdrop'=>'static'))); ?>

    <div class='modal-header'>
        <a class='close' data-dismiss='modal'>&times;</a>
        <h4>Warning!</h4>
    </div>

    <div class='modal-body'>
        <p>The user will be deleted from the list of Users.</p>
        <p>Are you sure you want to proceed?</p>
    </div>

    <div class='modal-footer'>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                   'type' => 'primary',
                  'label' => 'OK',
                    'url' => '#',
            'htmlOptions' => array(
                'data-dismiss' => 'modal'
                ),
            ));
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                  'label' => 'Cancel',
                    'url' => '#',
            'htmlOptions' => array(
               'data-dismiss' => 'modal',
                      'class' => 'close-modal'
                ),
            ));
        ?>
    </div>

<?php $this->endWidget(); ?> <!--modal-->