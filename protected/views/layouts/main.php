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
	<title><?php echo CHtml::encode(Yii::app()->name); ?>, Release 1.0, Version 1.0, 09302013</title>
</head>

<body>

<div class="container" id="page">

	<div id="mainmenu">
        <div id="confirm-logout" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="confirm-logout-header">Warning</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out from the application?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" onclick="javascript:window.location.assign('<?php echo CHtml::normalizeUrl(array('site/logout')) ?>')">Yes</a>
                <a class="btn" data-dismiss="modal" aria-hidden="true">No</a>
            </div>
        </div>
		<?php 
        $userHome = $this->id;
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Ordering', 'visible'=> $userHome == 'merchandiser'),
				array('label'=>'Ordering', 'visible'=> $userHome == 'customer'),
				array('label'=>'Administration', 'visible'=> $userHome == 'admin'),
				array('label'=>'Item management', 'visible'=> $userHome == 'supervisor'),
                array('label'=>'Logged user:  ' . Yii::app()->user->name),
				array(
                    'label'=>'User Info',
                    'url'=>array('site/info'),
                    'linkOptions'=>array(
                        'title'      =>"User Info",
                    ),
                
                ),
				array(
                    'label'=>'Logout',
                    'linkOptions'=>array(
                        'data-toggle'=>'modal',
                        'data-target'=>'#confirm-logout',
                        'title'      =>"Log out/Log in",
                        'style'      =>'cursor:pointer',
                    ),
                    'url'=>'',
                )
			),
		)); ?>
	</div><!-- mainmenu -->


	<?php echo $content; ?>

</div><!-- page -->
</body>
</html>