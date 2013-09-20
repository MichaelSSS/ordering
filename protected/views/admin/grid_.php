<?php $dataProvider = $model->search(); ?>

<?php $this->widget('TGridView', array(
    'id'             => 'id',
    'type'           => 'striped bordered condensed',
    'dataProvider'   => $dataProvider,
    'ajaxUpdate'     => 'search-result-count',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
    'filterSelector' => '#search-fields',
    'template'       => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager'          => array(
        'class'          => 'OmsPager',
        'header'         => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => 'First',
        'prevPageLabel'  => 'Backward',
        'nextPageLabel'  => 'Forward',
        'lastPageLabel'  => 'Last',
        'htmlOptions'    => array(
            'class'      => 'yiiPager',
        ),
        'cssFile'        => 'css/pager.css',
    ),
    'pagerCssClass'  => 'oms-pager',
    'baseScriptUrl'  => 'gridview',
    'columns'        => array(
        array('name' => 'username',  'header' => 'User Name'),
        array('name' => 'firstname', 'header' => 'First Name'),
        array('name' => 'lastname',  'header' => 'Last Name'),
        array('name' => 'role',      'header' => 'Role'),
        array('name' => 'email',     'header' => 'Email'),
        array('name' => 'region',    'header' => 'Region'),
        array(
            'header'      => 'Edit',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{edit}',
            'htmlOptions' => array(
            ),
            'buttons'  => array(
                'edit' => array(
                    'icon' => 'pencil',
                    'url'  => 'Yii::app()->createUrl(\'admin/edit\',array(\'id\'=>$data->id))',
                ),
            )
        ),
        array(
            'header'      => 'Remove',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{remove}',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                'class'       => 'remove'
            ),
            'buttons'    => array(
                'remove' => array(
                    'icon' => 'icon-trash',
                    'url'  => 'Yii::app()->createUrl(\'admin/remove\',array(\'id\'=>$data->id))',
                ),
            )
        ),
        array(
            'header'      => 'Duplicate',
            'class'       => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{duplicate}',
            'htmlOptions' => array(
            ),
            'buttons'       => array(
                'duplicate' => array(
                    'icon' => 'icon-file',
                    'url'  => 'Yii::app()->createUrl(\'admin/duplicate\',array(\'id\'=>$data->id))',
                ),
            )
        ),
    ),
));
?>





