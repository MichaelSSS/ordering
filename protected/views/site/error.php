<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'error.css'); ?>
<div class="err">
    <div class="span5">
        <div class="lamp_photo">
            <img src=" <?php echo Yii::app()->getBaseUrl(true).'/images/LAMP.jpg' ?>"/>
        </div>
    </div>
    <div class="span6">
        <?php
        $this->pageTitle=Yii::app()->name . ' - Error';
        $this->breadcrumbs=array(
            'Error',
        );
        ?>
        <div class="err-message">
            <div class="text-error">
                <h2 class='label label-warning'>Error <?php echo $code ?></h2>
                <?php echo CHtml::encode($message);
                if ( $code == 403 ) {
                    echo '<br>Please ' . CHtml::link('login',array('site/login')) . ' under appropriate User Name';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="span6">
                <p class='lead'>Развве могло что-то "сломаться" в приложении ? Вы можете написать нам в Skype:</p>
                <ul class='well text-center'>
                    <li>m_i_c_h_a_el777</li>
                    <li>dima_zhdan</li>
                    <li>agamaya.support</li>
                    <li>dreamcast29</li>
                    <li>khersonskaia</li>
                    <li>domdom22963</li>
                    <li>marina_warrior</li>
                </ul>
                <p class='lead text-center'>Постараемся ответить на все ваши вопросы и решить вашу проблему. С уважением, команда LAMP </p>
            </div>
        </div>

    </div>
</div>