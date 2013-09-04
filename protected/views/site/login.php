<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name; ?>

<!doctype html>
<html lang="en">
<head>
    <?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/myForm.css" />
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="">
                <fieldset>
                    <legend>order management system</legend>
                         
                        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', 
                            array('layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                                // 'htmlOptions'=>array('class'=>'well'),
                                'id'=>'login-form',
                                'enableClientValidation'=>true,
                                'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                                ),
                                
                        )); ?>

                        <div class="row6">
                            <!-- поле ввода username -->
                            <?php echo $form->textFieldControlGroup($model, 'username', 
                            array('help' => '','prepend' => TbHtml::icon(TbHtml::ICON_USER),
                                'placeholder'=>'username',
                                'span' => 3));
                            ?>
                            <!-- поле ввода пароля -->
                            <?php echo $form->passwordFieldControlGroup($model, 'password',
                                 array('help' => '','prepend' => TbHtml::icon(TbHtml::ICON_LOCK),
                                'placeholder'=>'password',
                                'span' => 3 )); 
                             ?>
                            <!-- кнопка отправить данные с формы -->
                            <!-- div.form-actions -->
                                <?php echo $form->checkBoxControlGroup($model, 'rememberMe', array(
                                'label' => 'remember user name',
                                  'controlOptions' => array('after' => TbHtml::submitButton('login',array('color' => TbHtml::BUTTON_COLOR_INFO)
                                    )), 
                             )); ?>
                            
                            
                        </div>
                </fieldset>
                        <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</body>
</html>



 
