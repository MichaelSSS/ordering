
<p>This page is appointed for duplicating user for particular role</p>
<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'duplicateForm',
                          'type' => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions'          => array(
            'validateOnSubmit'   =>  true
            )
        ));
?>

    <fieldset>
        <legend>user creation</legend>

        <?php echo $form->textFieldRow($model, 'username'); ?>

        <?php echo $form->textFieldRow($model, 'firstname'); ?>

        <?php echo $form->textFieldRow($model, 'lastname'); ?>

        <?php echo $form->passwordFieldRow($model, 'password', array(
            'title' => '',
            'placeholder' => 'enter new password'));
        ?>

        <?php echo $form->passwordFieldRow($model, 'confirmPassword'); ?>

        <?php echo $form->textFieldRow($model, 'email'); ?>

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

    <input type="submit" style="display:none;" onclick="return false;"/>

<?php 
$this->renderPartial('_modal-confirm-save');
$this->endWidget(); 
?>


