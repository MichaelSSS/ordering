<?php $dataProvider = $model->search();?>
<?php $grid = $this->widget('OmsGridView', array(
'id'=>'id',
    'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>'search-result-count',
    'updateSelector'=>'{page}, {sort}, #page-size, .yiiPager',
    'filterSelector'=>'#search-fields',
//    'type' => TbHtml::GRID_TYPE_STRIPED . ' ' . TbHtml::GRID_TYPE_BORDERED ,
    'template' => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager'  => array(
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
    'pagerCssClass'=>'oms-pager',
    'baseScriptUrl' => 'gridview',
    'columns'=> array(
        array(
            'name'=>'username',
        ),
        array(
            'name'=>'firstname',
        ),
        array(
            'name'=>'lastname',
        ),
        array(
            'name'=>'role',
        ),
        array(
            'name'=>'email',
        ),
        array(
            'name'=>'region',
        ),
        array(
            'class'=>'CButtonColumn',
            'header'=>'Edit',
            'buttons'=>array(
                'edit'=>array(
                    'url' => 'Yii::app()->createUrl(\'admin/edit\',array(\'id\'=>$data->id))',
                    'label'=>'edit',
                    'imageUrl'=>'images/grid_edit.png',
                ),
            ),
            'template'=>'{edit}',
        ),
        array(
            'class'=>'CButtonColumn',
            'header'=>'Remove',
            'htmlOptions'=>array(
                'data-toggle'=>'modal',
                'data-target'=>'#myModal',
                'class'=>'remove',
            ),
            'buttons'=>array(
                'remove'=>array(
                    'url' => 'Yii::app()->createUrl(\'admin/remove\',array(\'id\'=>$data->id))',
                    'label'=>'remove',
                    'imageUrl'=>'images/grid_remove.bmp',

                ),
            ),
            'template'=>'{remove}',
        ),
        array(
            'class'=>'CButtonColumn',
            'header'=>'Duplicate',
            'buttons'=>array(
                'duplicate'=>array(
                    'url' => 'Yii::app()->createUrl(\'admin/duplicate\',array(\'id\'=>$data->id))',
                    'label'=>'duplicate',
                    'imageUrl'=>'images/grid_duplicate.bmp',
                ),
            ),
            'template'=>'{duplicate}',
        ),
    ),
));

?>