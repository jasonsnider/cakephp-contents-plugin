<div class="jscForms form">
<?php echo $this->Form->create('JscForm'); ?>
	<fieldset>
		<legend><?php echo __('Edit Jsc Form'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('form');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('JscForm.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('JscForm.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Jsc Forms'), array('action' => 'index')); ?></li>
	</ul>
</div>
