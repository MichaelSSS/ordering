<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<?php Yii::app()->bootstrap->register(); ?>

<link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/main.css' />
<link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css' />
<link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/normalize.css' />


<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
    <div class='container'>
        <div class='row'>

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

            <div class='span12'>
                <header class='head pull-right'>
                    <?php 
                        $userHome = $this->id;
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
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