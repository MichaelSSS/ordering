<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<?php Yii::app()->bootstrap->register(); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'main.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'pager.css'); ?>

    <?php
    //    $cs = Yii::app()->getClientScript();
    //    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-ui-1.10.2.js');
    //    $cs->registerCssFile(Yii::app()->baseUrl.'/css/yourcss.css');
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css'
    );
    ?>


<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
    <div class='container'>
        <div class='row'>
            <div class='span10 offset1'>
                <header class='head pull-right'>
                    <?php $this->widget('zii.widgets.CMenu', 
                        array('items' => array(
                            array('label' => 'Ordering',        'url' => array('merchandiser/index'), 'visible' => false),
                            array('label' => 'Administration',  'url' => array('admin/index')),
                            array('label' => 'Item management', 'url' => array('supervisor/index'), 'visible' => false),
                            array('label' => 'Logged user:  ' . Yii::app()->user->name),
                            array('label' => 'User Info',       'url' => array('site/info')),
                            array('label' => 'Logout',          'url' => array('site/logout'))
                            ),
                        ));
                    ?>  
                </header>
            </div>
        </div>
        <div class="row">
            <div class="span10 offset1">
                <section>
                    <?php echo $content; ?>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="span10 offset1">
                <footer>

                </footer>
            </div>
        </div>
    </div>
</body>
</html>