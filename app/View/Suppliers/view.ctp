<div class="suppliers view">
<h2><?php echo __('Supplier'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trade Name'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['trade_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Supplier'), array('action' => 'edit', $supplier['Supplier']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Supplier'), array('action' => 'delete', $supplier['Supplier']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $supplier['Supplier']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier'), array('action' => 'add')); ?> </li>
	</ul>
</div>
