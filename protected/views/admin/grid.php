<?php
/*    $gridParams = require('gridParams_.php');
    $grid = $this->widget('TGridView', $gridParams);
*/?>

<?php  $this->renderPartial('/admin/gridParams', array('model' => $model))  ?>