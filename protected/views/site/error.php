<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() . '/css/main.css'); ?> 


<?php
    $this->pageTitle=Yii::app()->name . ' - Error';
    $this->breadcrumbs=array(
        'Error',
); ?>

<div class="wrp1">
    <div class="span8 offset2">
        <div class="row">
            <div class='panel panel-warning'>
                <div class='panel-heading'>
                    <p class='lead text'><?php echo CHtml::encode($message);?></p>
                </div>
                <div class='panel-body'>
                    <div class="span3">
                        <h1 class='text-center oval'>
                            <?= $code; 
                                if( $code==403 ) {
                                    echo '<p class="lead">Error</p>';
                                }
                                if ( $code == 404 ) {
                                echo '<p class="lead">Page not found</p>';
                                }
                                if ( $code == 500 ) {
                                    echo '<p class="lead">Ooops, that\'s an error</p>';
                                }
                            ?>
                        </h1>   
                    </div>                
                    <div class='span4 pull-right'>
                        <img class='img-circle' title='A team of developers of LAMP(PHP)' src="<?php echo Yii::app()->getBaseUrl(true) . '/images/LAMP.jpg' ?>" />
                    </div>  
                </div>
                <div class='panel-footer'>
                    <?php if ( $code == 403 ) {
                            echo '<p><i class="icon-info-sign icon-large"></i> Please '  . CHtml::link('login', array('site/login')) .
                            ' under appropriate User Name</p>';
                        } if ( $code == 404 )
                            echo '<p><i class="icon-info-sign icon-large"></i> <i>Sorry, this page is not available.</i></p>';
                        if ( $code == 500 ) {
                            echo '<p><i class="icon-info-sign icon-large"></i> <i>Internal Server Error</i></p>';
                        }
                    ?>
                </div>
            </div>
        </div>
      
    </div>
  
</div>

    
    




 
   
   
