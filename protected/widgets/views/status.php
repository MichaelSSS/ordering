<?php $userHome = $this->id;
$this->widget('bootstrap.widgets.TbMenu', array(
    'items' => array(
        array('label' => 'Ordering',        'url'  => '#', 'visible' => $userHome == 'merchandiser', ),
        array('label' => 'Ordering',        'url'  => '#', 'visible' => $userHome == 'customer',     ),
        array('label' => 'Administration',  'url'  => '#', 'visible' => $userHome == 'admin',        ),
        array('label' => 'Item management', 'url'  => '#', 'visible' => $userHome == 'supervisor',   ),  
    ), 
)); ?>