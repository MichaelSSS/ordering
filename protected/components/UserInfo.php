<?php

class UserInfo extends CAction{
    public static function info(){

        $user_id =  $id=Yii::app()->user->id;
        $model=User::model()->findByPk($user_id);
?>

       <p>User Name: <?=$model->username?></p>
        <p>Role:      <?=$model->role?></p>

<?php
        if($model->role == 'customer'){
            $customer = Customer::model()->findByPk($user_id);
?>
            <p>Customer Type: <?=$customer->customer_type?></p>
            <p>Account Balance:      <?=$customer->account_balance?></p>


<?php
        }
    }

}