

<div class="row">
    <div class="span10"></div>
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'horizontalForm',
        'type'=>'horizontal',
        'enableClientValidation'  =>  true,
        'clientOptions'           =>  array(
            'validateOnSubmit'        =>  true )
    ));
    ?>
    <?php
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css'
    );
    ?>
    <div class="row">
        <div class="span10">This page is appionted for selecting and buying products</div>

    </div>
    <div class="row">
        <div class="span10">
            <fieldset >
                <legend>Items selection</legend>
                items table here.....
            </fieldset >
        </div>
    </div>

    <div class="row">
        <div class="span5">



            <fieldset >
                <legend>Totals</legend>

                <div class="row">
                    <div class="span5">
                    <?php echo $form->textFieldRow($model, 'order_name', array('hint'=>'')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span5">
                    <?php echo $form->labelEx($model,'status', array('class'=>'control-label')); ?>
                    <div class="text-order"><?php echo "Created"; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="span5">
                    <?php echo "<label class='control-label'>Total number of items</label>"; ?>
                        <div class="text-order"><?php echo  "12";  ?></div>
                    </div>

                </div>
                <div class="row">
                    <div class="span5">
                    <?php echo $form->labelEx($model,'total_price', array('class'=>'control-label')); ?>
                        <div class="text-order"><?php echo "1200"."\$"; ?></div>
                    <?php echo  $form->hiddenField($model,'total_price', array('value'=>1200)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span5">
                    <?php echo $form->labelEx($model,'order_date', array('class'=>'control-label')); ?>
                        <div class="text-order"><?php echo date('m/d/Y'); ?></div>
                    <?php echo  $form->hiddenField($model,'order_date', array('value'=>date('m/d/Y'))); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span5">
                    <?php echo $form->textFieldRow($model, 'preferable_date',  array('hint'=>'',)); ?>
                    </div>

                </div>

                <div class="row">
                    <div class="span5">
                    <?php echo $form->labelEx($model,'delivery_date', array('class'=>'control-label')); ?>
                        <div class="text-order"><?php echo "//"; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="span5">
                    <?php echo $form->dropDownListRow($model, 'assignee', $model->getMerchandisers());  ?>
                    </div>
                </div>
            </fieldset>

        </div>
        <div class="span5">
            <fieldset >
                <legend>Card Info</legend>

                Credit card view goes here
            </fieldset>

        </div>






    </div>
    <div class="row">
        <div class="span3 offset7">
            <div class="order-buttons">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Order')); ?>


            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cancel',
                'type'=>'action',
                'htmlOptions'=>array(
                    'data-toggle'=>'modal',
                    'data-target'=>'#myModal',
                ),
            )); ?>

            </div>



        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
</div>


<?php $this->renderPartial('/order/_err'); ?>
<script type="text/javascript">
    $(function(){
        $("#Order_preferable_date").datepicker({
            showOn:"button",
            buttonImage:"/images/Calendar.png",
            buttonImageOnly:true
        });
      $('#Order_preferable_date').tooltip({title:'Type date in format mm/dd/yyyy'})
    })
</script>
