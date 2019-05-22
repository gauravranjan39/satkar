<div class="wallets form">
<?php echo $this->Form->create('Wallet'); ?>
	<fieldset>
		<legend><?php echo __('Add Wallet'); ?></legend>
	<?php
		echo $this->Form->input('customer_id');
		echo $this->Form->input('order_id');
		echo $this->Form->input('order_item_id');
		echo $this->Form->input('item');
		echo $this->Form->input('metal_type');
		echo $this->Form->input('weight');
		echo $this->Form->input('return_percentage');
		echo $this->Form->input('rate');
		echo $this->Form->input('cheque_number');
		echo $this->Form->input('bank_name');
		echo $this->Form->input('transaction_date');
		echo $this->Form->input('payment_transaction_id');
		echo $this->Form->input('type');
		echo $this->Form->input('credit');
		echo $this->Form->input('debit');
		echo $this->Form->input('balance');
		echo $this->Form->input('refund');
		echo $this->Form->input('comments');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Wallets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
