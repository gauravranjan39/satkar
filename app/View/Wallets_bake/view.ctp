<div class="wallets view">
<h2><?php echo __('Wallet'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wallet['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $wallet['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wallet['Order']['order_number'], array('controller' => 'orders', 'action' => 'view', $wallet['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wallet['OrderItem']['name'], array('controller' => 'order_items', 'action' => 'view', $wallet['OrderItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['item']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Metal Type'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['metal_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Return Percentage'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['return_percentage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cheque Number'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['cheque_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank Name'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['bank_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Date'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['transaction_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Transaction Id'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['payment_transaction_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['credit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Debit'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['debit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Balance'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['balance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refund'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['refund']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Wallet'), array('action' => 'edit', $wallet['Wallet']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Wallet'), array('action' => 'delete', $wallet['Wallet']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $wallet['Wallet']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Wallets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Wallet'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
