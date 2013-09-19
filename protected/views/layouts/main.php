<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<?php Yii::app()->bootstrap->register(); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'main.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'.css'); ?>



<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
    <div class='container'>
        <div class='row'>
            <div class='span12'>
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
                <section>
                    <?php echo $content; ?>
                </section>
            </div>
        </div> 
    </div>
</body>
</html>