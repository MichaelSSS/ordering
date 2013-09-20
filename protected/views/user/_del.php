<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal','options'=>array('backdrop'=>'static'))); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Warning!</h4>
    </div>

    <div class="modal-body">
        <p>The user will be deleted from the list of Users.</p>
        <p>Are you sure you want to proceed?</p>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.remove a').live('click',function(){
                var link = $(this).attr('href');
                $('#myModal .btn-primary').attr('href',link);
            });

            $('#myModal .btn-primary').click(function() {
                var url = $(this).attr('href');
                $.get(url, function(response) {
                    $.fn.yiiGridView.update('yw0');
                    $('.close-modal').click();

                });
                return false;
            });

            $('.remove').click(function(){
              preventDefault();

            })
        });
    </script>
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'label'=>'OK',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Close',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal','class'=>'close-modal'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>