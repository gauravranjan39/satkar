<div class="wallets index">
	<h2><?php echo __('Wallets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('item'); ?></th>
			<th><?php echo $this->Paginator->sort('metal_type'); ?></th>
			<th><?php echo $this->Paginator->sort('weight'); ?></th>
			<th><?php echo $this->Paginator->sort('return_percentage'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('cheque_number'); ?></th>
			<th><?php echo $this->Paginator->sort('bank_name'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_date'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_transaction_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('credit'); ?></th>
			<th><?php echo $this->Paginator->sort('debit'); ?></th>
			<th><?php echo $this->Paginator->sort('balance'); ?></th>
			<th><?php echo $this->Paginator->sort('refund'); ?></th>
			<th><?php echo $this->Paginator->sort('comments'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($wallets as $wallet): ?>
	<tr>
		<td><?php echo h($wallet['Wallet']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($wallet['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $wallet['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($wallet['Order']['order_number'], array('controller' => 'orders', 'action' => 'view', $wallet['Order']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($wallet['OrderItem']['name'], array('controller' => 'order_items', 'action' => 'view', $wallet['OrderItem']['id'])); ?>
		</td>
		<td><?php echo h($wallet['Wallet']['item']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['metal_type']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['weight']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['return_percentage']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['rate']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['cheque_number']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['bank_name']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['transaction_date']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['payment_transaction_id']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['type']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['credit']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['debit']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['balance']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['refund']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['comments']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['status']); ?>&nbsp;</td>
		<td><?php echo h($wallet['Wallet']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $wallet['Wallet']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $wallet['Wallet']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $wallet['Wallet']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $wallet['Wallet']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Wallet'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
