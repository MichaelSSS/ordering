
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>
<div class='wrp'>
    <?php /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'                     => 'login-form',
            'type'                   => 'horizontal',
            'enableClientValidation' => true,
            'clientOptions'          => array(
                'validateOnSubmit'   => true,
                'afterValidate'      => new CJavaScriptExpression('function(form, data, hasError) {
                    if ( !hasError ) {
                        form.on("submit", function(e) {
                            $("button", this).attr("disabled", true);
                        });
                    }
                    return true;
                }'),
            ),
            'htmlOptions' => array(
                'class' => 'span6 offset2',
            ),
    )); ?>

    <div class="span12">
        <div class="span6">
            <fieldset>
                <legend>order management system</legend>
                <div class="wrp3">
                    <div class="span6">
                        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span4')); ?>
                        <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span4')); ?>
                    </div>
                    <div class="span6">
                        <div class="row">
                            <div class="span4">
                                <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
                            </div>
                            <div class="span2">
                                 <?php $this->widget('bootstrap.widgets.TbButton', array(
                                    'buttonType'  => 'submit',
                                    'type'        => 'info',
                                    'label'       => 'sign in',
                                    'htmlOptions' => array(
                                        'class'   => 'pull-right',
                                    ),
                                )); ?>
                            </div>
                        </div>  
                    </div>
                </div>     
            </fieldset>
        </div> 
    </div>
    <?php $this->endWidget(); ?>
</div>


