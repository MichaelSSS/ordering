<?php /** @var BootActiveForm $form */
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
  'id'=>'horizontalForm',
  'type'=>'horizontal',
  'enableClientValidation'  =>  true,
  'clientOptions'           =>  array(
  'validateOnSubmit'        =>  true )
  ));
?>

<div class="container">
  <div class="row">
    <div class="row">
      <h1>administation</h1>
    </div>
    <div class="row">
      <fieldset>
        <legend>Create new user</legend>
        <div class="row">
          <p>This page is appointed for creating new user for particular role</p>
        </div>
        <div class="row">
          <?php echo $form->textFieldRow($model, 'username', array('hint'=>'')); ?>
        </div>
        <div class="row">
          <?php echo $form->textFieldRow($model, 'firstname', array('hint'=>'')); ?>
        </div>
        <div class="row">
          <?php echo $form->textFieldRow($model, 'lastname', array('hint'=>'')); ?>
        </div>
        <div class="row">
          <?php echo $form->passwordFieldRow($model, 'password', array('hint'=>'')); ?>
        </div>
        <div class="row">
          <?php echo $form->passwordFieldRow($model, 'confirmPassword', array('hint'=>'')); ?>
        </div>
        <div class="row">
          <?php echo $form->textFieldRow($model, 'email', array('hint'=>'')); ?>
        </div>
        <div class="row">
          <?php echo $form->dropDownListRow($model, 'region', array( 'North', 'South', 'West', 'East')); ?>
        </div>
      </fieldset>
    </div>
    <div class="row">
      <fieldset>
        <legend>Role</legend>
        <div class="row">
          <?php echo $form->radioButtonListRow($model, 'role', array(
            1=>'Administrator',
            3=>'Merchandiser',
            2=>'Supervisor',
            4=>'Customer',
            )); 
          ?>
        </div>
      </fieldset>
    </div>
    <div class="row">
      <div class="form-actions">
          <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Create')); ?>
          

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
            </div>
