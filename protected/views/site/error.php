<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() . '/css/main.css'); ?> 


<?php
    $this->pageTitle=Yii::app()->name . ' - Error';
    $this->breadcrumbs=array(
    'Error',
); ?>

<div class="wrp1">
    <div class="row">
        <div class="span5 hero-unit hero-large">
            <h1 class='btn'><?php echo $code ?></h1>
            <ul class='nav'>
                <li class='btn btn-danger'>E</li>
                <li class='btn btn-danger'>R</li>
                <li class='btn btn-danger'>R</li>
                <li class='btn btn-danger'>O</li>
                <li class='btn btn-danger'>R</li>  
                <li class='label label-warning'><?php echo CHtml::encode($message);?></li>
                <li> 
                    <b class=''><?php if ( $code == 403 ) {
                        echo '<p class="lead">Please ' . '<i>' . CHtml::link('login', array('site/login')) .'</i>'.
                        ' under appropriate User Name</p>';
                        } ?>
                    </b>
                </li>
            </ul>
        </div>
        <div class="span6 pull-right">
            <div class='mouse span5'>
                <img class='img-circle' src="<?php echo Yii::app()->getBaseUrl(true) . '/images/LAMP.jpg' ?>" />
            </div>
        </div>
    </div>
</div>



   
 

    
    




 
   
   
