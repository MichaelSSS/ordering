<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<?php Yii::app()->bootstrap->register(); ?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'login.css'); ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
  <div class='container'>
    <?php echo $content; ?>
  </div>
</body>
</html>
