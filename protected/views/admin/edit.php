

<p>This page is appointed for editing user for particular role</p>
<script>

    $(document).ready(function () {
        $('.password-group').hide();
       // $('#User_password').val('');
        $('.slide').click(function(){
            $('.password-group').slideToggle();
            return false;
        })
    });
</script>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                      => 'horizontalForm',
    'type'                    => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'    =>  true
    )
)); ?>
    <fieldset>
        <legend>edit user</legend>
        
            <?php echo $form->textFieldRow($model, 'username'); ?>
            <?php echo $form->textFieldRow($model, 'firstname'); ?>
            <?php echo $form->textFieldRow($model, 'lastname'); ?>

            <div class='row offset2 change-link' >
                <p> 
                    <a href='#' class='slide'>Change password</a>
                </p>
            </div>

            <div class='password-group'>
               <?php echo $form->passwordFieldRow($model, 'password', array(
                   'placeholder' => 'enter new password'));
               ?>
               <?php echo $form->passwordFieldRow($model, 'confirmPassword'); ?>
                <div class="controls password_buttons">
                    <input type="button" class="show_pass btn-info btn-mini" value="Show/Hide password"/>
                    <input type="button" class="generate_pass btn-info btn-mini" value="Generate "/>
                </div>
            </div>

            <?php echo $form->textFieldRow($model, 'email'); ?>
            
            <?php echo $form->dropDownListRow($model, 'region', array(
                'north' => 'North',
                'south' => 'South',
                'west'  => 'West',
                'east'  => 'East'
            )); ?>
            
            <?php echo $form->dropDownListRow($model, 'deleted', array(
                0 =>'Active',
                1 =>'Deleted',
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

    <div class='form-actions'>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
                  'type' => 'primary',
                 'label' => 'Save'
            ));
        ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
                  'label' => 'Cancel',
                   'type' => 'action',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                 ),
            ));
        ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Refresh')); ?>
    </div>
        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); ?>

            <div class='modal-header'>
                <a class='close' data-dismiss='modal'>&times;</a>
                <h4>Warning</h4>
            </div>

            <div class='modal-body'>
                <p>Are you sure you want to cancel operation?</p>
                <p>All data will be lost in this page</p>
            </div>

            <?php $target = $this->createUrl('admin/index'); ?>

            <div class='modal-footer'>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                     'type' => 'primary',
                    'label' => 'Yes',
                      'url' => $target,

                    ));
                ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                          'label' => 'No',
                            'url' => '#',
                    'htmlOptions' => array('data-dismiss' => 'modal'),
                    ));
                ?>

                <?php $this->endWidget(); ?>
            </div>
<?php $this->endWidget(); ?>
<?php $this->renderPartial('_password');?>


