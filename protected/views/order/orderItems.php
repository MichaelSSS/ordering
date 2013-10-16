<?php
echo CHtml::link('Add Item', array('customer/additem'));
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
        'firstPageLabel' => '&lsaquo; First',
        'prevPageLabel'  => '&larr; Backward',
        'nextPageLabel'  => 'Forward &rarr;',
        'lastPageLabel'  => 'Last &rsaquo;',
        'htmlOptions' => array(
            'class' => 'yiiPager',
        ),
        'cssFile' => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',
    'rowHtmlOptionsExpression' => 'array("id"=>$data["key"])',
    'emptyText' => 'No Items added yet',

    'columns'=>array(
        array(

            'header' => 'Item Number',
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
            'value'=>'(int)$data["price"] . "\$"',

        ),
        array(
            'header'    => 'Quantity',
            'value'=>'$data["quantity"]',

        ),
        array(
            'header'    => 'Price Per Line',
            'value'=>'$data["price_per_line"] . "\$"',

        ),

        array(
            'header'      => 'Edit',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{edit}',
            'htmlOptions' => array(
            ),
            'buttons'  => array(
                'edit' => array(
                    'icon' => 'edit large',
                    'url'  => 'Yii::app()->createUrl(\'customer/edititem\',array(\'id\'=>$data["id_item"], \'key\'=>$data["key"]))',
                ),
            )
        ),

        array(
            'header' => 'Remove',
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{remove}',
            'htmlOptions' => array(
                'id' => 'col_remove',
            ),
            'buttons' => array(
                'remove' => array(
                    'icon' => 'remove large',
                    'url' => 'Yii::app()->createUrl(\'customer/removeitem\',array(\'key\'=>$data["key"]))',
                    'options' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#removeitem',
                        'onclick' => 'beforeRemove(this)',
                    ),
                ),
            )
        ),
    ),
));

?>
<?php $this->renderPartial('/order/_del'); ?>

<script>
    function beforeRemove(el) {
        $('#modal_remove').attr('href', $(el).attr('href'));
    };

    $(function(){
        $('#modal_remove').click(function() {
            var url = $(this).attr('href');
            $.get(url, function(response) {
                $('.modal-header .close').click();
                $.fn.yiiGridView.update('yw0');
            });
            return false;
        });
    });
</script>