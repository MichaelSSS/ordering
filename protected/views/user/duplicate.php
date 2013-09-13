<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/gridview/styles.css" />

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'        =>  true )
));
?><p>This page is appointed for creating new user for particular role</p>
<div id="create-form-wrapper">

    <fieldset>
        <legend>Create new user</legend>

        <div class="row">
            <?php echo $form->textFieldRow($model, 'username', array('hint'=>'')); ?>
        </div>
        <div class="row">
            <?php echo $form->textFieldRow($model, 'firstname', array('hint'=>'')); ?>
        </div>
        <div class="row">
            <?php echo $form->textFieldRow($model, 'lastname', array('hint'=>'')); ?>
        </div>

        <div class="password-group">
            <div class="row">
                <?php echo $form->passwordFieldRow($model, 'password', array('hint'=>'','title'=>'if you','placeholder'=>'enter new password')); ?>
            </div>

            <div class="row">
                <?php echo $form->passwordFieldRow($model, 'confirmPassword', array('hint'=>'')); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->textFieldRow($model, 'email', array('hint'=>'')); ?>
        </div>
        <div class="row">
            <?php echo $form->dropDownListRow($model, 'region', array(
                'north'=>'North',
                'south'=>'South',
                'west'=>'West',
                'east'=>'East'
            )); ?>
        </div>
    </fieldset>


    <fieldset>
        <legend>Role</legend>
        <div class="row role-list">
            <?php echo $form->radioButtonList($model, 'role', array(
                'admin'=>'Administrator',
                'merchandiser'=>'Merchandiser',
                'supervisor'=>'Supervisor',
                'customer'=>'Customer',
            ));
            ?>
        </div>
    </fieldset>

    <div class="row">
        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>


            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cancel',
                'type'=>'action',
                'htmlOptions'=>array(
                    'data-toggle'=>'modal',
                    'data-target'=>'#myModal',
                ),
            )); ?>


            <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

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
                    'type'=>'primary',
                    'label'=>'Yes',
                    'url'=> $target,

                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'No',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); ?>
                <?php $this->endWidget(); ?>

            </div>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Refresh')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

