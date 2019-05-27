<div class="emailTemplates index">
	<h2><?php echo __('Email Templates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($emailTemplates as $emailTemplate): ?>
	<tr>
		<td><?php echo h($emailTemplate['EmailTemplate']['id']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['subject']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['content']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['status']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['created']); ?>&nbsp;</td>
		<td><?php echo h($emailTemplate['EmailTemplate']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $emailTemplate['EmailTemplate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $emailTemplate['EmailTemplate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $emailTemplate['EmailTemplate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $emailTemplate['EmailTemplate']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Email Template'), array('action' => 'add')); ?></li>
	</ul>
</div>
