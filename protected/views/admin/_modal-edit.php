<div id="modal-editing" class="modal hide" data-backdrop="static">
    <div class='modal-header'>
        <a class='close' data-dismiss='modal'>&times;</a>
        <h4 id='modal-edit-header'>Create New User</h4>
        <p id="page-appointment">This page is appointed for creating new user for particular role</p>

    </div>

    <div id="modal-editing-body" class='modal-body'>



<script type='text/javascript'>

    $(document).ready(function () {
        $('#form-passwords-edit .password-group').hide();
       // $('#User_password').val('');
        $('.slide').click(function(){
            $('#form-passwords-edit .password-group').slideToggle();
            return false;
        })
    });
</script>


<?php /** @var BootActiveForm $form */
$model = new User('edit');
$dupl = new User('duplicate');
$dupl->password = '';
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                         'id' => 'form-start',
                       'type' => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'    =>  true, 
    )
));
?>
        <ul>
            <li><?php echo $form->textFieldRow($model, 'username', array('hint' => '')); ?></li>
            <li><?php echo $form->textFieldRow($model, 'firstname', array('hint' => '')); ?></li>
            <li><?php echo $form->textFieldRow($model, 'lastname', array('hint' => '')); ?></li>
        </ul>
    <input class="submit-handler" type="submit" style="display:none;"/>
<?php $this->endWidget(); ?>


            <?php $formEdit = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                     'id' => 'form-passwords-edit',
                                   'type' => 'horizontal',
                'enableClientValidation'  =>  true,
                'clientOptions'           =>  array(
                    'validateOnSubmit'    =>  true, 
                )
            ));
            ?>

            <div class='row offset2 change-link' >
                <p> <a href='#' class='slide'>Change password</a></p>
            </div>

            <div class='password-group'>
            <ul>
               <li>
                   <?php echo $formEdit->passwordFieldRow($model, 'password', array(
                       'hint' => '',
                       'placeholder' => 'enter new password'));
                   ?>
               </li>
               <li><?php echo $formEdit->passwordFieldRow($model, 'confirmPassword', array('hint' => '')); ?></li>
            </ul>
            </div>
            <input class="submit-handler" type="submit" style="display:none;"/>
            <?php $this->endWidget(); ?>

            <?php $formDuplicate = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                     'id' => 'form-passwords-duplicate',
                                   'type' => 'horizontal',
                'enableClientValidation'  =>  true,
                'clientOptions'           =>  array(
                    'validateOnSubmit'    =>  true, 
                )
            ));
            ?>
            <div class=''>
            <ul>
               <li>
                   <?php echo $formDuplicate->passwordFieldRow($dupl, 'password', array(
                       'hint' => '',
                       'placeholder' => 'enter new password'));
                   ?>
               </li>
               <li><?php echo $formDuplicate->passwordFieldRow($dupl, 'confirmPassword', array('hint' => '')); ?></li>
            </ul>
            </div>
            <input class="submit-handler" type="submit" style="display:none;"/>
            <?php $this->endWidget(); ?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                         'id' => 'form-end',
                       'type' => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'    =>  true, 
    )
));
?>
        <ul>

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

    <input class="submit-handler" type="submit" style="display:none;"/>
<?php $this->endWidget(); ?>
<?php $this->renderPartial('_modal-confirm-save'); ?>

    </div>
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