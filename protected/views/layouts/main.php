<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<?php Yii::app()->bootstrap->register(); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'main.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getBaseUrl() .  '/css/'.'pager.css'); ?>

    <?php
    //    $cs = Yii::app()->getClientScript();
    //    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-ui-1.10.2.js');
    //    $cs->registerCssFile(Yii::app()->baseUrl.'/css/yourcss.css');
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css'
    );
    ?>


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

            <div class='span10 offset1'>
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
                                    'linkOptions'=>array(
                                        'class'=>TbHtml::ICON_INFO_SIGN.' user_info ',

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
                    <div class="info not_visible">
                        <div class="info-head">User info:</div>
                        <div class="info_body">

                            <?php UserInfo::info()?>
                        </div>
                        <div class="info_footer"></div>
                    </div>
                </header>
            </div>
        </div>
        <div class="row">
            <div class="span10 offset1">
                <section>
                    <?php echo $content; ?>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="span10 offset1">
                <footer>

                </footer>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $.fn.clicktoggle = function(a, b) {
                return this.each(function() {
                    var clicked = false;
                    $(this).click(function() {
                        if (clicked) {
                            clicked = false;
                            return b.apply(this, arguments);
                        }
                        clicked = true;
                        return a.apply(this, arguments);
                    });
                });
            };

            $('.info').width($('header').width())

            $('.user_info').clicktoggle(
                function(){
                $('.info').show()},
                function(){
                    $('.info').hide()

            })
            $('.user_info').focusout(function(){
                alert('sdc')
            })

        });
    </script>

</body>
</html>