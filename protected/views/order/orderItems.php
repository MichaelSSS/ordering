
<div id="grid-extend">

</div>
<?php

echo CHtml::link('Add Item',array('customer/additem'));
$grid = $this->widget('TGridView', array(
    'dataProvider' => $orderDetails,
    'type' => 'striped bordered condensed',
    'ajaxUpdate' => '',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
    'filterSelector' => '{filter}',
    'template' => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager' => array(
        'class' => 'OmsPager',
        'header' => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => 'First',
        'prevPageLabel' => 'Backward',
        'nextPageLabel' => 'Forward',
        'lastPageLabel' => 'Last',
        'htmlOptions' => array(
            'class' => 'yiiPager',
        ),
        'cssFile' => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',
    'emptyText' => 'No Items added yet',

    'columns'=>array(
        array(

            'header'    => 'Item Number',
            'value'=>'$data["id_item"]',
        ),

		array(

                        'header'    => 'Item Name',
            'value'=>'$data["name"]',
		),
		array(
            'header'    => 'Item Description',
			'value'=>'$data["description"]',

		),
        array(
                'header'    => 'Dimension',
			    'value'=>'$data["dimension"]',

		),
		array(
            'header'    => 'Price',
			'value'=>'$data["price"]',

		),
		array(
            'header'    => 'Quantity',
			'value'=>'$data["quantity"]',

		),
		array(
            'header'    => 'Price Per Line',
			'value'=>'$data["price_per_line"]',

		),

        array(
            'header'      => 'Edit',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{edit}',
            'htmlOptions' => array(
            ),
            'buttons'  => array(
                'edit' => array(
                    'icon' => 'pencil',
                ),
            )
        ),
//        array(
//            'header'      => 'Remove',
//            'class'       => 'bootstrap.widgets.TbButtonColumn',
//            'template'    => '{remove}',
//            'htmlOptions' => array(
//                'id'=>'col_remove',
//            ),
//            'buttons'    => array(
//                'remove' => array(
//                    'icon' => 'icon-trash',
//                    'url'  => 'Yii::app()->createUrl(\'order/remove\',array(\'id\'=>$data->id_item))',
//                    'options'=>array(
//                        'data-toggle'=>'modal',
//                        'data-target'=>'#remove_order',
//                        'onclick'=>'beforeRemove(this)',
//                    ),
//
//
//
//                ),
//            )
//        ),
        ),
));

?>