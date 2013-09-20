<<<<<<< HEAD
<?php  $this->renderPartial('/admin/grid_', array('model' => $model))  ?>

=======
<?php 
$gridParams = require('gridParams.php');
$grid = $this->widget('OmsGridView', $gridParams);

?>
>>>>>>> d9e4fdafb997f6032792bd917308b6251f46ca17
