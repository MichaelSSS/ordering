<?php
//$dataProvider = new CActiveDataProvider('orderDetails');
?>
<div id="grid-extend">
<?php
//$criteria = new CDbCriteria();
//$criteria->addInCondition('id_orderDetails',  array('1'));
//$model = orderDetails::model()->findByAttributes(array('id_order' => 11111));

?>
</div>
<?php echo CHtml::link('Add Item',array('customer/additem'));
$grid = $this->widget('TGridView', array(
    'dataProvider' => $orderDetails->search(),
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
            'value'=>'$data->id_item',
        ),

		array(

                        'header'    => 'Item Name',
            'value'=>'$data->itemOredered->name',
		),
		array(
            'header'    => 'Item Description',
			'value'=>'$data->itemOredered->description',

		),
        array(
                'header'    => 'Dimension',
			    'value'=>'$data->dimensionId->dimension',

		),
		array(
            'header'    => 'Price',
			'value'=>'$data->itemOredered->price . "\$"',

		),
		array(
            'header'    => 'Quantity',
			'value'=>'$data->quantity',

		),
		array(
            'header'    => 'Price Per Line',
			'value'=>'$data->getPricePerLine() . "\$"',

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
        array(
            'header'      => 'Remove',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{remove}',
            'htmlOptions' => array(
                'id'=>'col_remove',
            ),
            'buttons'    => array(
                'remove' => array(
                    'icon' => 'icon-trash',
                    'url'  => 'Yii::app()->createUrl(\'order/remove\',array(\'id\'=>$data->id_item))',
                    'options'=>array(
                        'data-toggle'=>'modal',
                        'data-target'=>'#remove_order',
                        'onclick'=>'beforeRemove(this)',
                    ),



                ),
            )
        ),
        ),
));




// $grid = $this->widget('TGridView', array(
//    'dataProvider'=>$orderDetails->search(Yii::app()->user->getState('user_id')),
//    'type'           => 'striped bordered condensed',
//     'ajaxUpdate' => '',
//     'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
//     'filterSelector' => '{filter}',
//     'template' => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
//     'pager' => array(
//         'class' => 'OmsPager',
//         'header' => '',
//         'maxButtonCount' => 0,
//         'firstPageLabel' => 'First',
//         'prevPageLabel' => 'Backward',
//         'nextPageLabel' => 'Forward',
//         'lastPageLabel' => 'Last',
//         'htmlOptions' => array(
//             'class' => 'yiiPager',
//         ),
//         'cssFile' => 'css/pager.css',
//     ),
//     'pagerCssClass' => 'oms-pager',
//     'baseScriptUrl' => 'gridview',
//
//
//    'columns'=>array(
//        'id_item',
//////		'id_item',
//////
//////		array(
//////
//////                        'header'    => 'Name',
//////            'value'=>'$data->items->name',
//////		),
//////		array(
//////            'header'    => 'Description',
//////			'value'=>'$data->items->description',
//////
//////		),
//////        	array(
//////                'header'    => 'Dimention',
//////			'value'=>'$data->dimensions->dimention',
//////
//////		),
//////		array(
//////            'header'    => 'Price',
//////			'value'=>'$data->items->price',
//////
//////		),
//////		array(
//////            'header'    => 'Quantity',
//////			'value'=>'$data->quantity',
//////
//////		),
//////        	array(
////////			'name'=>'PricePerLine',
////////                   'value'=>'$data->PricePerLine',
////////                    'header'    => 'Price Per Line'
////////
//////
//////		),
//////                array(
//////            'header'      => 'Edit',
//////            'class'       => 'bootstrap.widgets.TbButtonColumn',
//////            'template'    => '{edit}',
//////            'htmlOptions' => array(
//////            ),
//////            'buttons'  => array(
//////                'edit' => array(
//////                    'icon' => 'pencil',
//////                ),
//////            )
//////        ),
//////                   array(
//////            'header'      => 'Remove',
//////            'class'       => 'bootstrap.widgets.TbButtonColumn',
//////            'template'    => '{remove}',
//////            'htmlOptions' => array(
//////                'id'=>'col_remove',
//////            ),
//////            'buttons'    => array(
//////                'remove' => array(
//////                    'icon' => 'icon-trash',
//////                    'url'  => 'Yii::app()->createUrl(\'order/remove\',array(\'id\'=>$data->id_order))',
//////                    'options'=>array(
//////                        'data-toggle'=>'modal',
//////                        'data-target'=>'#remove_order',
//////                        'onclick'=>'beforeRemove(this)',
//////                    ),
//////
//////
//////
//////                ),
//////            )
//////        ),
//	),
//));
?>