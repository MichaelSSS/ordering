<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() . '/css/main.css'); ?> 


<?php
    $this->pageTitle=Yii::app()->name . ' - Error';
    $this->breadcrumbs=array(
    'Error',
); ?>


<div class='panel panel-warning wr1'>   
    <div class='panel-heading'>
        <p class='lead text'><?php echo CHtml::encode($message);?></p>
    </div>
    <div class='panel-body'>
        <div class="span4 hero-unit hero-large">
            <h1 class='btn'><?php echo $code ?></h1>
             <ul class='nav'>
                <li class='btn btn-danger'>E</li>
                <li class='btn btn-danger'>R</li>
                <li class='btn btn-danger'>R</li>
                <li class='btn btn-danger'>O</li>
                <li class='btn btn-danger'>R</li>  
            </ul>
        </div>
        <div class="span5">
            <div class='mouse span5'>
                <img class='img-circle' src="<?php echo Yii::app()->getBaseUrl(true) . '/images/LAMP.jpg' ?>" />
            </div>
        </div>
    </div>
    <div class='panel-footer'>
        <?php if ( $code == 403 ) {
            echo '<p class="lead">Please ' . '<b>' . CHtml::link('login', array('site/login')) .'</b>'.
            ' under appropriate User Name</p>';
            }
        ?>
    </div>
</div>


<!-- <div class="wrp1">
    <div class="row">
        <div class="span5 hero-unit hero-large">
            <h1 class='btn'><?php echo $code ?></h1>
            <ul class='nav'>
                <li class='btn btn-danger'>E</li>
                <li class='btn btn-danger'>R</li>
                <li class='btn btn-danger'>R</li>
                <li class='btn btn-danger'>O</li>
                <li class='btn btn-danger'>R</li>  
                <li class='text-info'><?php echo CHtml::encode($message);?></li>
            </ul>
            <?php if ( $code == 403 ) {
                echo '<p class="lead">Please ' . '<b>' . CHtml::link('login', array('site/login')) .'</b>'.
                ' under appropriate User Name</p>';
                }
            ?>
        </div>
        <div class="span6 pull-right">
            <div class='mouse span5'>
                <img class='img-circle' src="<?php echo Yii::app()->getBaseUrl(true) . '/images/LAMP.jpg' ?>" />
            </div>
        </div>
    </div>
</div> -->



   
 

    
    




 
   
   
