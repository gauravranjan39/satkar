<div class="suppliers form">
<?php echo $this->Form->create('Supplier'); ?>
	<fieldset>
		<legend><?php echo __('Add Supplier'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('mobile');
		echo $this->Form->input('email');
		echo $this->Form->input('trade_name');
		echo $this->Form->input('image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Suppliers'), array('action' => 'index')); ?></li>
	</ul>
</div>
