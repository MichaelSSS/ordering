<?php $this->widget('bootstrap.widgets.TbTabs', array(
         'type' => 'tabs',
    'placement' => 'above', // 'above', 'right', 'below' or 'left'
         'tabs' => array(
        array('label' => 'Duplicate',
            'content' => '<p>This page is appointed for duplicating user for particular role</p>',
             'active' => true
             ),
        ),
    ));
?>

<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'horizontalForm',
                          'type' => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions'          => array(
            'validateOnSubmit'   =>  true
            )
        ));
?>

    <fieldset>
        <legend>user creation</legend>

        <?php echo $form->textFieldRow($model, 'username', array('hint' => '')); ?>

        <?php echo $form->textFieldRow($model, 'firstname', array('hint' => '')); ?>

        <?php echo $form->textFieldRow($model, 'lastname', array('hint' => '')); ?>

        <?php echo $form->passwordFieldRow($model, 'password', array(
                   'hint' => '',
                  'title' => 'if you',
            'placeholder' => 'enter new password'));
        ?>

        <?php echo $form->passwordFieldRow($model, 'confirmPassword', array('hint' => '')); ?>

        <?php echo $form->textFieldRow($model, 'email', array('hint' => '')); ?>

        <?php echo $form->dropDownListRow($model, 'region', array(
            'north' => 'North',
            'south' => 'South',
            'west'  => 'West',
            'east'  => 'East'
        )); ?>
    </fieldset>


    <fieldset>
        <legend>Role</legend>

        <?php echo $form->radioButtonList($model, 'role', array(
            'admin'        => 'Administrator',
            'merchandiser' => 'Merchandiser',
            'supervisor'   => 'Supervisor',
            'customer'     => 'Customer',
        )); ?>
    </fieldset>


    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => 'Save'
        )); ?>


        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'       => 'Cancel',
            'type'        => 'action',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
            ),
        )); ?>


        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); ?>

        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Warning</h4>
        </div>

        <div class="modal-body">
            <p>Are you sure you want to cancel operation?</p>
            <p>All data will be lost</p>
        </div>

        <?php $target = $this->createUrl('admin/index'); ?>

        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'  => 'primary',
                'label' => 'Yes',
                'url'   => $target,
            )); ?>

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'No',
                'url'   => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )); ?>

            <?php $this->endWidget(); ?>
        </div>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Refresh')); ?>
    </div>
<?php $this->endWidget(); ?>


