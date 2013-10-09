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
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                         'id' => 'horizontalForm',
                       'type' => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'    =>  true, 
    )
));
?>
    <fieldset>
        <ul>
            <li><?php echo $form->textFieldRow($model, 'username', array('hint' => '')); ?></li>
            <li><?php echo $form->textFieldRow($model, 'firstname', array('hint' => '')); ?></li>
            <li><?php echo $form->textFieldRow($model, 'lastname', array('hint' => '')); ?></li>
            <div class='row offset2 change-link' >
                <p> <a href='#' class='slide'>Change password</a></p>
            </div>
            <div class='password-group'>
               <li>
                   <?php echo $form->passwordFieldRow($model, 'password', array(
                       'hint' => '',
                       'placeholder' => 'enter new password'));
                   ?>
               </li>
               <li><?php echo $form->passwordFieldRow($model, 'confirmPassword', array('hint' => '')); ?></li>
            </div>
            <li><?php echo $form->textFieldRow($model, 'email', array('hint' => '')); ?></li>
            <li>
                <?php echo $form->dropDownListRow($model, 'region', array(
                    'north' => 'North',
                    'south' => 'South',
                     'west' => 'West',
                     'east' => 'East'
                )); ?>
            </li>
            <li>
                <?php echo $form->dropDownListRow($model, 'deleted', array(
                    0 =>'Active',
                    1 =>'Deleted',
                )); ?>
            </li>

        </ul>
    </fieldset>


    <fieldset>
        <legend>Role</legend>
            <?php echo $form->radioButtonList($model, 'role', array(
                       'admin' => 'Administrator',
                'merchandiser' => 'Merchandiser',
                  'supervisor' => 'Supervisor',
                    'customer' => 'Customer',
                ));
            ?>
    </fieldset>

    <input type="submit" style="display:none;" onclick="return false;"/>

<?php 
$this->renderPartial('_modal-confirm-save');
$this->endWidget(); 
?>


