<div id="grid-extend">
    <script type="text/javascript">

        function enableButton() {
            if ($('.items').find('.selected')) {
                $('#get_name').removeAttr('disabled');
            }
            else {
                $('#get_name').attr('disabled', 'disabled');
            }
        }

        $(document).ready(function () {
            $('#get_name').attr('disabled', 'disabled')
            $('.selected').on('click', function () {
                $('#get_name').attr('disabled', 'disabled');
            });
            $('button').on('click', function () {
                if ($('.items').find('.selected')) {
                    $('#get_name').attr('disabled', 'disabled');
                }

            });
            $('#get_name').on('click', function () {
                var item_id = $('.selected').attr('id');
                $.ajax({
                    type: "GET",
                    url: "index.php?r=customer/add",

                    dataType: "JSON",
                    data: "item_id=" + item_id,
                    success: function (data, textStatus, xhr) {
                        $('#item_result_name').html(data.item_name);
                        $('input[name="OrderDetails[id_item]"]').val(item_id);
                        $('input[id="max_quantity"]').val(data.item_quantity);
                        $('.quantity_of_item').html(data.item_quantity);
                        $('#item_result_price').html(data.item_price);

                    }
                });
                // if($('#ItemForm').find('input[name="OrderDetails[quantity]"]').val() !== ''){
                $('input[name="OrderDetails[quantity]"]').removeAttr('disabled');
                $('#save').removeAttr('disabled');
                //}
            });

            $('#save').attr('disabled', 'disabled');

            $("#OrderDetails_quantity").change(function () {
                allowToAdd();
            });

            $("#OrderDetails_id_dimension").change(function () {

                allowToAdd();
            });

            function allowToAdd() {
                var id_dimention = $("#OrderDetails_id_dimension").val() * 1;

                if (id_dimention == 1) {
                    var dimention = 1;
                } else if (id_dimention == 2) {
                    var dimention = 5;
                } else if (id_dimention == 3) {
                    var dimention = 10;
                }

                var quantity = $('input[id="OrderDetails_quantity"]').val() * 1 * dimention;
                var quantity_max = $('input[id="max_quantity"]').val() * 1;

                if ($('input[id="id_item"]').val() !== '' && quantity_max >= quantity) {
                    $('#save').removeAttr('disabled');
                    $('.item_error').html('');
                }
                else if (quantity_max < quantity) {
                    $('.item_error').html('You can not order more then ' + quantity_max + ' items');
                    $('#save').attr('disabled', 'disabled');
                }
                else {
                    $('#save').attr('disabled', 'disabled');
                }
            }

            $('#remove').on('click', function () {
                $('#item_result_name').html('----//----');
                $('input[name="OrderDetails[id_item]"]').val('');
                $('input[id="max_quantity"]').val('');
                $('.quantity_of_item').html('----//----');
                $('#item_result_price').html('');
                $('input[name="OrderDetails[quantity]"]').val('1');
                $('#save').attr('disabled', 'disabled');
                $('.item_error').html('');
            });


        });
    </script>

</div>
<fieldset class="item_search">
    <legend>Search <span>by</span></legend>


    <?php $searchForm = $this->beginWidget('CActiveForm', array(
        'id' => 'search-form',
        'method' => 'GET',
    ));
    ?>


    <div class="span2"><p>Search for item by:</p></div>
    <div class="span3">
        <?php echo $searchForm->dropDownlist($model, 'searchCriteria', $model->searchCriterias, array(
            'class' => 'span3',
            'options' => array(
                array_search('Item Name', $model->searchCriterias) => array('selected' => true)
            ),
        ));
        ?>
    </div>
    <div class="span3">
        <?php echo $searchForm->textField($model, 'searchValue', array('class' => 'span3')); ?>
    </div>

    <div class="span1 pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Apply',
            'buttonType' => 'submit',
            'type' => 'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'null', // null, 'large', 'small' or 'mini'
        ));?>
        <?php echo CHtml::errorSummary($model) ?>
    </div>

    <?php $this->endWidget(); ?>

</fieldset>
<?


$grid = $this->widget('TGridView', array(
    'dataProvider' => $model->search(),
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
        'prevPageLabel' => '&larr; Backward',
        'nextPageLabel' => 'Forward &rarr;',
        'lastPageLabel' => 'Last &rsaquo;',
        'htmlOptions' => array(
            'class' => 'yiiPager',
        ),
        'cssFile' => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',

    'rowHtmlOptionsExpression' => 'array("id"=>$data->id_item, "onclick"=>"enableButton()")',

    'columns' => array(
        array(
            'name' => 'name',
        ),
        array(
            'name' => 'description',
        ),
    ),
)); ?>
<div class="row">
    <div class="span3 offset7">
        <div class="order-buttons">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Add',
                'buttonType' => 'submit',
                'type' => 'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'null',
                'htmlOptions' => array('id' => 'get_name')
                //'class'=>'get_name'// null, 'large', 'small' or 'mini'
            ));?>

        </div>
    </div>
</div>


<?php
$itemForm = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'ItemForm',
    'type' => 'horizontal',
    'action' => Yii::app()->createUrl('customer/saveitem'),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true)
));
?>


<div class="row">
    <div class="span10">
        <fieldset>
            <div class="row">
                <div class="span1">
                    <p>Name:</p>
                </div>
                <div class="span6">
                    <p><span id="item_result_name"><?php echo $model->name ?></span></p>
                </div>
            </div>
            <div class="row">
                <div class="span1">
                    <p>Price:</p>

                </div>
                <div class="span6">
                    <p><span id="item_result_price"><?php echo $model->price ?></span>$</p>

                </div>
            </div>
            <div class="row">
                <div class="span6">
                    <?php
                    echo $itemForm->textFieldRow($orderDetails, 'quantity', array('value' => $currentItems[$key]['quantity'])); ?>
                    <p><span class="item_error" style="color: red;"></span></p>

                    <p>Maximum quantity of item: <span class="quantity_of_item"><?php echo $model->quantity ?></span>
                    </p>

                    <?php echo $itemForm->hiddenField($orderDetails, 'key', array('id' => 'key', 'value' => $key)); ?>
                    <?php echo $itemForm->hiddenField($orderDetails, 'id_item', array('id' => 'id_item', 'value' => $model->id_item)); ?>
                    <?php echo $itemForm->hiddenField($model, 'quantity', array('id' => 'max_quantity', 'value' => $model->quantity)); ?>
                    <?php echo $itemForm->hiddenField($orderDetails, 'id_customer', array('value' => Yii::app()->user->id)); ?>

                </div>
            </div>
            <div class="row">
                <div class="span5">
                    <p>
                        Dimension   <?php echo CHtml::dropDownList('OrderDetails[id_dimension]', null, CHtml::listData(dimension::model()->findAll(), 'id_dimension', 'dimension')) ?></p>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<div class="row">
    <div class="span3 offset7">
        <div class="order-buttons">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Done', 'htmlOptions' => array('id' => 'save'))); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('type' => 'primary', 'label' => 'Remove', 'htmlOptions' => array('style' => 'margin:0;', 'id' => 'remove'),)); ?>


            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Cancel',
                'type' => 'action',
                'url' => '?r=customer/create',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',

                ),
            )); ?>

        </div>
    </div>
</div>
<?php $this->endWidget(); ?>