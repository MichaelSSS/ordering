<?php
return array(
    'id'=>'oms-grid-view0',
    'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>'search-result-count',
    'updateSelector'=>'{page}, {sort}, #page-size',
    'filterSelector'=>'#search-fields',
    'type' => TbHtml::GRID_TYPE_STRIPED . ' ' . TbHtml::GRID_TYPE_BORDERED . ' ' . TbHtml::GRID_TYPE_CONDENSED,
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
    'baseScriptUrl' => 'gridview_JSON',
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
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'header'=>'Edit',
            'buttons'=>array(
                'edit'=>array(
                    'url' => 'Yii::app()->createUrl(\'admin/edit\',array(\'id\'=>$data->id))',
                    'label'=>'edit',
                    //'imageUrl'=>'images/grid_edit.png',
                    'icon' => 'pencil',
                ),
            ),
            'template'=>'{edit}',
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'header'=>'Remove',
            'htmlOptions'=>array(
                'data-toggle'=>'modal',
                'data-target'=>'#myModal',
                'class'=>'remove',
            ),
            'buttons'=>array(
                'remove'=>array(
                    'url' => '( !Yii::app()->user->isActive($data->id,time()) ) ?
                            Yii::app()->createUrl("admin/remove",array("id"=>$data->id)) : "";',
                    'label'=>'remove',
                    //'imageUrl'=>'images/grid_remove.bmp',
                    'icon' => 'icon-trash',

                ),
            ),
            'template'=>'{remove}',
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'header'=>'Duplicate',
            'buttons'=>array(
                'duplicate'=>array(
                    'url' => 'Yii::app()->createUrl(\'admin/duplicate\',array(\'id\'=>$data->id))',
                    'label'=>'duplicate',
                    'icon' => 'icon-tags'
                    //'imageUrl'=>'images/grid_duplicate.bmp',
                ),
            ),
            'template'=>'{duplicate}',
        ),
    ),
);