
<p>This page is appointed for creating new user for particular role</p>

<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'horizontalForm',
        'type'                   => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions'          => array(
            'validateOnSubmit'   => true
        )
    ));
?>

    <fieldset>
        <legend>Create new user</legend>
        
        <?php echo $form->textFieldRow($model, 'username'); ?>
        <?php echo $form->textFieldRow($model, 'firstname'); ?>
        <?php echo $form->textFieldRow($model, 'lastname'); ?>
        
        <?php echo $form->passwordFieldRow($model, 'password', array(
            'title' => 'Password should contain at least one uppercase and one lowercase Alphabetic symbol, 
                        at least one numeric and special character',
            'class'=>'showpass')); ?>

        <?php echo $form->passwordFieldRow($model, 'confirmPassword'); ?>

       <div><button class="show_pass">Show password</button>
           <button class="generate_pass">Generate password</button>
       </div>
        <?php echo $form->textFieldRow($model, 'email') ?>
        
        <?php echo $form->dropDownListRow($model, 'region', array(
            'north' => 'North',
            'south' => 'South',
            'west'  => 'West',
            'east'  => 'East'
        )); ?>
    
    </fieldset>

    <fieldset>
        <legend>Role</legend>

        <?php echo $form->radioButtonList($model, 'role', array(
            'admin'        => 'Administrator',
            'merchandiser' => 'Merchandiser',
            'supervisor'   => 'Supervisor',
            'customer'     => 'Customer',
            ));
        ?>
    </fieldset>
        <div class='form-actions'>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                      'type' => 'primary',
                     'label' => 'Create'
            )); ?>

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                      'label' => 'Cancel',
                       'type' => 'action',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#myModal',
                    ),
            )); ?>

            <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); ?>

                <div class='modal-header'>
                    <a class='close' data-dismiss='modal'>&times;</a>
                    <h4>Warning</h4>
                </div>

                <div class='modal-body'>
                    <p>Are you sure you want to cancel operation?</p>
                    <p>All data will be lost in this page</p>
                </div>

                <?php $target = $this->createUrl('admin/index'); ?>

                <div class='modal-footer'>
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'type'  => 'primary',
                        'label' => 'Yes',
                        'url'   => $target,
                    )); ?>

                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label'       => 'No',
                        'url'         => '#',
                        'htmlOptions' => array('data-dismiss' => 'modal'),
                    )); ?>
                </div>
            <?php $this->endWidget(); ?>
            
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Refresh')); ?>
        </div>
<?php $this->endWidget(); ?>

<script>
    $(document).ready(function () {
        $('#User_password').tooltip();

        $('.show_pass').click(function(){
            element =  $('#User_password');
            element.replaceWith(element.clone().attr('type',(element.attr('type') == 'password') ? 'text' : 'password'))
        })
        $('.show_pass').on('click',(function(){
            element =  $('#User_confirmPassword');
            element.replaceWith(element.clone().attr('type',(element.attr('type') == 'password') ? 'text' : 'password'))
            return false;
        }))
        $('.generate_pass').click(function(){
            var pass = '';
            var lowLetter = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
            var highLetter = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
            var number = [1,2,3,4,5,6,7,8,9,0];
            var spChar = ['!','@','#','$','%','^','&','*','(',')','_','-','+','=','~','/',';',':','<','>','?'];

            for(i=0;i<2;i++){
                pass += lowLetter[parseInt(Math.random()*lowLetter.length)]
                pass += highLetter[parseInt(Math.random()*highLetter.length)]
                pass += number[parseInt(Math.random()*number.length)]
                pass += spChar[parseInt(Math.random()*spChar.length)]
            }

            pass = pass.split('')

             function shuffle( b )
            {
                var i = this.length, j, t;
                while( i )
                {
                    j = Math.floor( ( i-- ) * Math.random() );
                    t = b && typeof this[i].shuffle!=='undefined' ? this[i].shuffle() : this[i];
                    this[i] = this[j];
                    this[j] = t;
                }

                return this;
            };
            shuffle(pass);
            pass = pass.join('');
            console.log(pass);
            $('#User_password').val(pass);
            $('#User_confirmPassword').val(pass);
            return false;
        })

    });
</script>