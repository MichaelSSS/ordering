<div id="modal-editing" class="modal hide" data-backdrop="static">
<div class='modal-header'>
    <a class='close' data-dismiss='modal'>&times;</a>
    <h4 id='modal-edit-header'>Create New User</h4>
    <p id="page-appointment">This page is appointed for creating new user for particular role</p>
</div>

<div id="modal-editing-body" class='modal-body'>

<script type='text/javascript'>

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
$model = new User('edit');
$dupl = new User('duplicate');
$dupl->password = '';
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                      => 'form-start',
    'type'                    => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit' => true, 
    )
));
?>
    <?php echo $form->textFieldRow($model, 'username'); ?>
    <?php echo $form->textFieldRow($model, 'firstname'); ?>
    <?php echo $form->textFieldRow($model, 'lastname'); ?>
    <input class="submit-handler" type="submit" style="display:none;"/>
<?php $this->endWidget(); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                      => 'form-passwords-edit',
    'type'                    => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit' => true, 
    )
));
?>
    <div class='row offset2 change-link' >
        <p> <a href='#' class='slide'>Change password</a></p>
    </div>

    <div class='password-group'>
        <?php echo $form->passwordFieldRow($model, 'password', array(
           'placeholder' => 'enter new password',
           'class'=>'User_password',
        ));
        ?>
        <?php echo $form->passwordFieldRow($model, 'confirmPassword', array(
            'class' => 'User_confirmPassword',
        )); ?>
        <div class="controls password_buttons">
            <input type="button" class="show_pass btn-info btn-mini" value="Show/Hide password"/>
            <input type="button" class="generate_pass btn-info btn-mini" value="Generate "/>
        </div>
    </div>
    <input class="submit-handler" type="submit" style="display:none;"/>
<?php $this->endWidget(); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                      => 'form-passwords-duplicate',
    'type'                    => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit' => true, 
    )
));
?>
    <?php echo $form->passwordFieldRow($dupl, 'password', array(
        'title' => 'Password should contain at least one uppercase and one lowercase Alphabetic symbol, 
                    at least one numeric and special character',
        'id' => 'User_password2',
        'class'=>'showpass User_password',
    )); ?>

    <?php echo $form->passwordFieldRow($dupl, 'confirmPassword', array(
        'id'    => 'User_confirmPassword2',
        'class' => 'User_confirmPassword',
    )); ?>
    <div class="controls password_buttons">
        <input type="button" class="show_pass btn-info btn-mini" value="Show/Hide password"/>
        <input type="button" class="generate_pass btn-info btn-mini" value="Generate "/>
    </div>
    
    <input class="submit-handler" type="submit" style="display:none;"/>
<?php $this->endWidget(); ?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                      => 'form-end',
    'type'                    => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit' => true, 
    )
));
?>
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
            
    <fieldset>
        <legend>Role</legend>
            <?php echo $form->radioButtonList($model, 'role', array(
                'admin'        => 'Administrator',
                'merchandiser' => 'Merchandiser',
                'supervisor'   => 'Supervisor',
                'customer'     => 'Customer',
            )); ?>
    </fieldset>

    <input class="submit-handler" type="submit" style="display:none;"/>
<?php $this->endWidget(); ?>
</div>

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