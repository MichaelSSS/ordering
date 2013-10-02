
<p>User Name: <?=$model->username?></p>
<p>Role:      <?=$model->role?></p>

<?php if($model->role == 'customer') : ?>

   <?php $customer = Customer::model()->findByPk($user_id);?>

    <p>Customer Type: <?=$customer->customer_type?></p>
    <p>Account Balance:      <?=$customer->account_balance?></p>

<?php endif ?>