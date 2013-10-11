        <div id="cofirm-edit-cancel" class="modal hide " data-backdrop="static">

            <div class='modal-header'>
                <a class='close edit-cancel-not'>&times;</a>
                <h4>Warning</h4>
            </div>

            <div class='modal-body'>
                <p>Are you sure you want to cancel operation?</p>
                <p>All data will be lost</p>
            </div>

            <div class='modal-footer'>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'         => 'primary',
                    'label'        => 'Yes',
                    'htmlOptions'  => array(
                        'data-dismiss' => 'modal',
                        'class' => 'edit-cancel-yes',
                    ),
                ));
                ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'       => 'No',
                    'url'         => '#',
                    'htmlOptions' => array('class' => 'edit-cancel-not'),
                ));
                ?>

            </div>
        </div>
