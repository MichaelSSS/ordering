<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() . '/css/main.css'); ?> 


<?php
    $this->pageTitle=Yii::app()->name . ' - Error';
    $this->breadcrumbs=array(
        'Error',
); ?>

<div class="wrp1">
    <div class='panel panel-warning'>
        <div class='panel-heading'>
            <p class='lead text'><?php echo CHtml::encode($message);?></p>
        </div>
        <div class='panel-body'>
            <div class="span4 hero-unit">
                <h1 class='btn'>
                    <?= $code; ?>
                    <?php if ( $code == 404 ) {
                        echo '<p class="lead">Page not found.</p>';
                        }
                    ?>
                </h1>
                <ul class='nav'>
                    <li class='btn btn-danger'>E</li>
                    <li class='btn btn-danger'>R</li>
                    <li class='btn btn-danger'>R</li>
                    <li class='btn btn-danger'>O</li>
                    <li class='btn btn-danger'>R</li>
                </ul>
            </div>
            <div class="span5">
                <div class='span5'>
                    <img class='img-circle' src="<?php echo Yii::app()->getBaseUrl(true) . '/images/LAMP.jpg' ?>" />
                </div>
            </div>
        </div>
        <div class='panel-footer'>
            <?php if ( $code == 403 ) {
                echo '<p class="lead">Please '  . CHtml::link('login', array('site/login')) .
                    ' under appropriate User Name</p>';
                }
            ?>
        </div>
    </div>
</div>

    
    




 
   
   
