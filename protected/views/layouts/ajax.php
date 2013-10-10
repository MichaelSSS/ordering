<?php
    Yii::app()->bootstrap->register();
    $cs=Yii::app()->getClientScript();
    $cs->registerCssFile($cs->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
    $cs->registerCssFile(Yii::app()->getBaseUrl() . '/css/fontAwesome.css');
    $cs->registerCssFile(Yii::app()->getBaseUrl() . '/css/main.css');
    $cs->registerCssFile(Yii::app()->getBaseUrl() . '/css/pager.css');
//    $cs->registerCoreScript('jquery.ui');
    $cs->registerCoreScript('bbq');
    $cs->registerCoreScript('yiiactiveform');
?>


    <div class='container'>
        <div class="row">
            <div class="span10 offset1">
                <section>
                    <?php echo $content; ?>
                </section>
            </div>
        </div>
    </div>