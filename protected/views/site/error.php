<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php 
echo CHtml::encode($message);
if ( $code == 403 ) {
    echo '<br>Please ' . CHtml::link('login',array('site/login')) . ' under appropriate User Name';
}
?>
</div>