<?php
return array(
    'id'              => 'oms-grid-view0',
    'dataProvider'    => $dataProvider,
    'ajaxUpdate'      => 'search-result-count',
    'ajaxUpdateError' => 'function(xhr,textStatus,et,err){
         if (xhr.status==403) {
            window.location.assign("' 
                . CHtml::normalizeUrl(array('site/logout'))
                . '");
        } else {
            alert(textStatus);
        }
    }',
    'updateSelector' => '{page}, {sort}, #page-size',
    'filterSelector' => '#search-fields',
    'type'           => TbHtml::GRID_TYPE_STRIPED . ' ' . TbHtml::GRID_TYPE_BORDERED . ' ' . TbHtml::GRID_TYPE_CONDENSED,
    'template'       => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pagerCssClass'  => 'oms-pager',
    'baseScriptUrl'  => 'gridview_JSON',
    'pager'          => array(
        'class'          => 'OmsPager',
        'cssFile'        => 'css/pager.css',
        'header'         => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => '&lsaquo; First',
        'prevPageLabel'  => '&larr; Backward',
        'nextPageLabel'  => 'Forward &rarr;',
        'lastPageLabel'  => 'Last &rsaquo;',
        'htmlOptions'    => array(
            'class' => 'yiiPager',
        ),
    ),
    'columns' => array(
        array('name' => 'username',),
        array('name' => 'firstname',),
        array('name' => 'lastname',),
        array('name' => 'role',),
        array('name' => 'email',),
        array('name' => 'region',),
        array(
            'class'    => 'bootstrap.widgets.TbButtonColumn',
            'header'   => 'Edit',
            'template' => '{edit}',
            'buttons'  => array(
                'edit'      => array(
                    'url'   => 'Yii::app()->createUrl(\'admin/edit\',array(\'id\' => $data->id))',
                    'label' => 'edit',
                    'icon'  => 'icon-edit icon-large',
                ),
            ),
        ),
        array(
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'header'      => 'Remove',
            'template'    => '{remove}',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                'class'       => 'remove',
            ),
            'buttons' => array(
                'remove' => array(
                    'url'     => '( !Yii::app()->user->isActive($data->id, time()) ) ?
                            Yii::app()->createUrl("admin/remove", array("id" => $data->id)) : "";',
                    'label'   => 'remove',
                    'icon'    => 'icon-remove icon-large',
                    'visible' => '!$data->deleted',
                ),
            ),
        ),
        array(
            'class'    => 'bootstrap.widgets.TbButtonColumn',
            'header'   => 'Duplicate',
            'template' => '{duplicate}',
            'buttons'  => array(
                'duplicate' => array(
                    'url'   => 'Yii::app()->createUrl(\'admin/duplicate\', array(\'id\' => $data->id))',
                    'label' =>'duplicate',
                    'icon'  => 'icon-copy icon-large'
                ),
            ),
        ),
    ),
);