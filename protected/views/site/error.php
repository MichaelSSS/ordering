<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'main.css'); ?>
<h2>Error <?php echo $code; ?></h2>
<div class="lamp_photo">
    <img src=" <?php echo Yii::app()->getBaseUrl(true).'/images/LAMP.jpg' ?>"/>
</div>


<ul> Если что-то у вас сломалось, напишите нам Ж:)
    <li>юзер1</li>
    <li>юзер2</li>
    <li>юзер3</li>
</ul>
<div class="error">
<?php echo CHtml::encode($message); ?>
</div>