<?php $this->renderPartial('_del2'); ?> <!--modal-->

<p>This page is appointed for creating new and managing existing users</p>

<?php echo CHtml::link('Create New User', array('admin/create')); ?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                     => 'search-form',
    'enableClientValidation' => true,
    'type'                   => 'inline',
    'clientOptions'          => array(
        'validateOnSubmit'   => true,
    ),
    'htmlOptions' => array(
        'class'   => '',
    )
));
?>

<fieldset>
    <legend>Search <span>by</span></legend>
    <div class='span9'><p>Field Filter</p></div>
    <div class='control-group'>
        <div class='controls'>
            <div class='span3'>
                <?php echo $form->dropDownListRow($fields, 'keyField',
                    array('All Columns', 'User Name', 'First Name', 'Last Name', 'Role'),
                    array('class' => 'input-large',
                        'options' => array(
                            array_search('User Name', $fields->keyFields) => array(
                                'selected' => true
                            )
                        )
                    ));
                ?>
            </div>
            <div class='span3'>
                <?php echo $form->dropDownListRow($fields, 'criteria',
                    array('equals', 'not equal to', 'starts with', 'contains', 'does not contain'),
                    array('class' => 'input-large',
                        'options' => array(
                            array_search('starts with', $fields->criterias) => array(
                                'selected' => true
                            )
                        )
                    ));
                ?>
            </div>
            <div class='row'>
                <div class="input-append">
                    <?php echo $form->textField($fields, 'keyValue', array(
                        'onkeyup' => 'document.getElementById(\'btn-search\').disabled = !(this.value.length);',
                        'class' => 'span2',
                        'placeholder' => 'Search'
                    )); ?>
                    <button class='btn btn-info' type='submit' disabled='true' id='btn-search'>Search</button>
                    <button class="btn" type="reset">Reset</button> 
                </div>
            </div>
        </div>
    </div>
</fieldset>
<div class="span10">&nbsp;</div>
<fieldset>
<div class="row">
    <div class="span10">
         <?php
            $dataProvider = $model->search();
            echo '<div id="search-result">Number of Found Users <span id="search-result-count">'
                . $dataProvider->getTotalItemCount() . '</span></div>';
        ?>

    <div class="row">
        <a class="pull-right" id="toggle-deleted" href="<?php echo CHtml::normalizeUrl(array('admin/index','showDel'=>'1'));?>">show deleted users</a>
    </div>
</div>
   
    
</div>
</fieldset>
<?php $this->endWidget(); ?>

<div id="oms-grid-view0" class="grid-view">
    <div id="grid-extend"><a id="page-size" href="/ordering/index.php?r=admin/index&amp;ajax=yw0&amp;pageSize=25">show 25 items</a></div>
    <table class="items table table-striped table-bordered table-condensed" id="table-user">
    <thead><tr>
        <th id="oms-grid-view0_c0">
            <a class="sort-link" href="?r=admin/index&amp;User_sort=username">User Name<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c1">
            <a class="sort-link" href="?r=admin/index&amp;User_sort=firstname">First Name<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c2">
            <a class="sort-link" href="?r=admin/index&amp;User_sort=lastname">Last Name<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c3">
            <a class="sort-link" href="?r=admin/index&amp;User_sort=role">Role<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c4">
            <a class="sort-link" href="?r=admin/index&amp;User_sort=email">Email<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c5">
            <a class="sort-link" href="?r=admin/index&amp;User_sort=region">Region<span class="caret"></span></a>
        </th>
        <th class="button-column" id="oms-grid-view0_c6">Edit</th>
        <th class="button-column" id="oms-grid-view0_c7">Remove</th>
        <th class="button-column" id="oms-grid-view0_c8">Duplicate</th>
    </tr></thead>
    </table>
    <div class="grid-footer">
        <div class="summary">Page #: </div>
        <div class="oms-pager">
            <ul class="yiiPager" id="yw1">
                <li class="first hidden">First</li>
                <li class="backward hidden">Backward</li>
                <li class="forward hidden">Forward</li>
                <li class="last hidden">Last</li>
            </ul>
        </div>
    </div>
</div>
<?php
    $cs=Yii::app()->getClientScript();

    $cs->registerCssFile('gridview_JSON/pager.css');

    //$cs->registerCssFile('gridview/styles.css');

    $cs->registerCoreScript('jquery');
    $cs->registerCoreScript('bbq');

    $cs->registerScriptFile('gridview_JSON/underscore.js',CClientScript::POS_END);
    $cs->registerScriptFile('gridview_JSON/backbone_002.js',CClientScript::POS_END);
    $cs->registerScriptFile('gridview_JSON/user.js',CClientScript::POS_END);

    $cs->registerScript('1','
        oms.users.reset(' . $this->prepareAjaxData($dataProvider) . ');
        //oms.fields.set({userCount:'. $dataProvider->getTotalItemCount() . ',nextPageSize:25,currentPage:1,totalPage:' . $dataProvider->getPagination()->getPageCount() . '});

    ');

?>
<script type="text/template" id="row-template">
    <td> <%= username %> </td>
    <td> <%= firstname %> </td>
    <td> <%= lastname %> </td>
    <td> <%= role %> </td>
    <td> <%= email %> </td>
    <td> <%= region %> </td>
    <td class="button-column">
        <a title="edit" rel="tooltip" href= <%= '"?r=admin/edit&amp;id=' + id + '"' %> >
            <i class="icon-edit icon-large">
    </i></a></td>
    <td class="remove" >
        <%= 
            ( deleted==1 ) ? (
                '<a rel="tooltip" title="deleted user">&times;</a>'
            ) : (( active ) ? (
'<a rel="tooltip" title="active user"><i class="icon-remove" style="background-image: url(gridview_JSON/glyphicons-halflings-white.png)"></i></a>'
            ) : (
'<a rel="tooltip" title="remove" href="?r=admin/remove&amp;id=' 
+ id + '"><i class="icon-remove icon-large"></i></a>'
            ))
        %>
    </td>
    <td class="button-column">
        <a title="duplicate" rel="tooltip" href= <%= '"?r=admin/duplicate&amp;id='+id+'"' %> >
            <i class="icon-copy icon-large">
    </i></a></td>
</script>