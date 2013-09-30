<div class="row">
    <div class="span10"></div>
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'horizontalForm',
        'type' => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true)
    ));
    ?>
    <?php
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css'
    );
    ?>
    <div class="row">
        <div class="span10">This page is appointed for selecting and buying products</div>
    </div>
    <div class="row">
        <div class="span10">
            <fieldset>
                <legend>Items selection</legend>
                items table here.....
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="span5">
            <?php $this->renderPartial('/order/orderInfo', array('model' => $model, 'form'=>$form)); ?>
        </div>
        <div class="span5">
            <fieldset>
                <legend>Card Info</legend>
                <?php $this->renderPartial('/order/cardInfo', array('modelCreditCard' => $modelCreditCard)); ?>
            </fieldset>
        </div>

    </div>
    <div class="row">
        <div class="span3 offset7">
            <div class="order-buttons">
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Save', 'htmlOptions' => array('id' => 'save'))); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Order', 'htmlOptions' => array('id' => 'order','onClick' => 'js:$(\'#credit-card-form\').submit()'))); ?>
                <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'ajaxSubmitButton', 'type' => 'primary', 'label' => 'Order','ajaxOptions' => array('url' => 'creditcard/validatecc'))); ?>


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
</div>
</div>


<?php $this->renderPartial('/order/_err'); ?>
<?php $this->renderPartial('/order/_cancel'); ?>
<script type="text/javascript">
    $(function () {
        $("#Order_preferable_date").datepicker({
            showOn: "button",
            buttonImage: "/images/Calendar.png",
            buttonImageOnly: true
        });
        $('#Order_preferable_date').tooltip({title: 'Type date in format mm/dd/yyyy'})
    })
</script>
