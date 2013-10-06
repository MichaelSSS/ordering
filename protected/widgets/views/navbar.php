<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="#"><?= Yii::app()->name; ?></a>
            <ul class="nav" role='navigation'>
                <li>
                    <?php $userHome = $this->id;
                    $this->widget('bootstrap.widgets.TbMenu', array(
                        'items' => array(
                            array('label' => 'Ordering',        'url'  => '#', 'visible' => $userHome == 'merchandiser'),
                            array('label' => 'Ordering',        'url'  => '#', 'visible' => $userHome == 'customer'),
                            array('label' => 'Administration',  'url'  => '#', 'visible' => $userHome == 'admin'),
                            array('label' => 'Item management', 'url'  => '#', 'visible' => $userHome == 'supervisor'),
                        ),
                    ));
                    ?>
                </li>
            </ul>
            <ul class='nav pull-right'>
                <li>
                    <a href=''><?= 'Logged user: '. Yii::app()->user->name; ?></a>
                </li>
                <li>
                    <a href='#' data-toggle='modal' data-target='#confirm-logout' title='Log out/Log in'>
                        <?= ' Logout ' . '<i class='icon-signout icon-large'></i>' ?>
                    </a>
                </li>
                <li>
                    <?php  $this->widget('application.widgets.UserInfo'); ?>
                </li>
            </ul>
        </div>
    </div>
</div>


























<!--  <?php $userHome = $this->id;
    $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'     => 'null', // null or 'inverse'
    'brand'    => 'Order Management System',
    // 'brandUrl' => '#',
    'fixed'    => 'static',
    'collapse' => false, // requires bootstrap-responsive.css
    'items'    => array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items' => array(
                array('label' => 'Ordering',        'url'  => '#', 'visible' => $userHome == 'merchandiser', ),
                array('label' => 'Ordering',        'url'  => '#', 'visible' => $userHome == 'customer',     ),
                array('label' => 'Administration',  'url'  => '#', 'visible' => $userHome == 'admin',        ),
                array('label' => 'Item management', 'url'  => '#', 'visible' => $userHome == 'supervisor',   ),
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions' => array('class' => ''),
            'items' => array(
                array('label' => 'Logged user: ' . Yii::app()->user->name,'url' => '#'),
                array(
                    'label' => 'Logout',
                    'url'   => '',
                    'linkOptions'     => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#confirm-logout',
                        'title'       => 'Log out/Log in',
                        'style'       => 'cursor:pointer',
                    ),
                ),
            ),
        ),
        /*array(
            'class'=>('application.widgets.UserInfo'),
        ),
    ),*/
)); ?> -->