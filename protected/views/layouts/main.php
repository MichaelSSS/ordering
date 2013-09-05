<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!--<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/print.css" media="print" />
	
	<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/ie.css" media="screen, projection" />
	<![endif]-->
<!-- 
	<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/form.css" /> -->
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode(Yii::app()->name); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Ordering', 'url'=>array('merchandiser/index'), 'visible'=>false),
				array('label'=>'Administration', 'url'=>array('admin/index')),
				array('label'=>'Item management', 'url'=>array('supervisor/index'), 'visible'=>false),
                array('label'=>'Logged user:  ' . Yii::app()->user->name),
				array('label'=>'User Info', 'url'=>array('site/info')),
				array('label'=>'Logout', 'url'=>array('site/logout'))
			),
		)); ?>
	</div><!-- mainmenu -->


	<?php echo $content; ?>

</div><!-- page -->

</body>
</html>