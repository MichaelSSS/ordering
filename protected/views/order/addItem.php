
<div id="grid-extend">
 <script type="text/javascript">

     function enableButton(){

             if($('.items').find('.selected')){
                 $('#get_name').removeAttr('disabled');
             }
             else{
                 $('#get_name').attr('disabled','disabled');
             }


     }



                    $(document).ready(function () {
                        $('#get_name').attr('disabled','disabled')
                        $('.selected').on('click',function(){
                                $('#get_name').attr('disabled','disabled');
                        });
                        $('button').on('click',function(){
                            if($('.items').find('.selected')){
                            $('#get_name').attr('disabled','disabled');
                        }
                        
                        });





                        $('#get_name').on('click',function(){
                            var item_id = $('.selected').attr('id');
                            //alert(item_id);
                            $.ajax({
                            type: "GET",
                            url: "index.php?r=customer/add",

                            dataType: "JSON",
                            data: "item_id=" +item_id,
                            success: function(data, textStatus, xhr) {

                                $('#item_result_name').html(data.item_name);
                                $('input[name="OrderDetails[id_item]"]').val(item_id);
                                
                                $('#item_result_price').html(data.item_price);

                            }
        /*error: function (xhr, ajaxOptions, thrownError){
            //если ошибка аякса, то выведем ее
            alert(xhr.status);
            alert(thrownError);
        }*/
                
            
                });
            });
            
           $('#save').attr('disabled','disabled') 
           function AllowToAdd(){
            if($('.items').find('.selected') && $('#myform').find('input[name="OrderDetails[quantity]"]').val() != ''){
                $('#save').removeAttr('disabled');
            }
           }
            
            
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
    
    'rowHtmlOptionsExpression' => 'array("id"=>$data->id_item, "onclick"=>"enableButton()")',
    
    'columns'=>array(
		array(
			'name'=>'name',
		),
		array(
			'name'=>'description',
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
                                  'htmlOptions'=>array('id'=>'get_name')
                                //'class'=>'get_name'// null, 'large', 'small' or 'mini'
                            ));?>

            </div>
        </div>
    </div>

                          
<?php
$itemForm = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ItemForm',
    'type'=>'horizontal',
    'action'=>Yii::app()->createUrl('customer/saveitem'),
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'        =>  true )
));
?>


    <div class="row">
        <div class="span10">
            <fieldset >
                   <div class="row">
                    <div class="span1">
                         <p>Name:</p> 
                    </div>
                    <div class="span6">
                         <p><span id="item_result_name"></span></p> 
                    </div>
                   </div>    
                <div class="row">
                    <div class="span1">
                         <p>Price:</p>
                   
                    </div>
                    <div class="span6">
                         <p><span id="item_result_price"></span></p>
                   
                    </div>
                </div>
                   <div class="row">
                    <div class="span2">
                        <?php  
                        echo $itemForm->textFieldRow($orderDetails, 'quantity', array('hint'=>'')); ?>
                    
                        <?php echo $itemForm->hiddenField($orderDetails, 'id_item', array('type'=>'hidden')); ?>

                       <?php echo $itemForm->hiddenField($orderDetails, 'id_customer', array('value'=>Yii::app()->user->id)); ?>
                                       
                    </div>
                </div>
                  <div class="row">
                    <div class="span5">
                        <p>Dimension   <?php echo CHtml::dropDownList('OrderDetails[id_dimension]', null, CHtml::listData(dimension::model()->findAll(), 'id_dimension', 'dimension')) ?></p>
                    </div>
                </div>
            </fieldset >
        </div>
    </div>
    <div class="row">
        <div class="span3 offset7">
            <div class="order-buttons">
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Done', 'htmlOptions' => array('id' => 'save'))); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array( 'type' => 'primary', 'label' => 'Remove', 'url'=>'?r=customer/create')); ?>


                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Cancel',
                    'type' => 'action',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#cancelModal',
                    ),
                )); ?>

            </div>
        </div>
    </div>
 <?php $this->endWidget(); ?>