
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name;

?>
<div class='wrp'>
    <div class='span7 offset2'>
        <div class='panel panel-warning'>
            <button type='button' class='close' >&times;</button>
            <div class='panel-heading'>
                <h3 class='panel-title'>Warning Message</h3>
            </div>
            <div class='panel-body'>
                <p class='lead text-center'>This user is already logged into the system under other browser. Please use another session or log out and try to log in again</p>
            </div>
            <div class='panel-footer'>
                <p class=' text-center'>Click <a href='<?= Yii::app()->createUrl('site/forceLogin');?>'> here </a>  to log in current browser. Your session in another browser will be ended</p>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function(){

        $('.close').on('click',function(){
            document.location.href = '<?= Yii::app()->createUrl('site/login');?>'
        })

    })

</script>





