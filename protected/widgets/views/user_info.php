<div class="btn-group">
	 <a class="btn btn-info" href="#">
		<i class="icon-info-sign"></i>
	</a>
	<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="icon-caret-down"></span>
	</a>
	<ul class="dropdown-menu">
		<li>
			<a href="#">
				<i class="i"></i> User Info:
			</a>
		</li>
		<li class="divider"></li>
		<li>
			<a href="#">	
				<i class="icon-large icon-user"></i> User Name: <?= $model->username ?>
			</a>
		</li>
		<li>
			<a href="#">
				<i class="icon-large icon-pushpin"></i> Role:	<?= $model->role ?>
			</a>
		</li>
		<?php if($model->role == 'customer') : ?>
			<?php $customer = Customer::model()->findByPk($user_id);?>
		<li>
			<a href="#">
				<i class="icon-large icon-credit-card"></i> Customer Type: <?= $customer->customer_type ?>
			</a>
		</li>
		<li>
			<a href="#"><i class="icon-large icon-money"></i> Account balance: <?= $customer->account_balance ?>
			</a>
		</li>
		<li class="divider"></li>
		<li>
			<a href="#">
				<i class="i"></i>
				<span class='required'>*</span>
				<small>Need to spend 1000$ more to become a Gold type of customer.</small>
			</a>
		</li>
	</ul>
</div>
		<?php endif ?>