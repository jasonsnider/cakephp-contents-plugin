<div class="jscForms form">
<?php echo $this->Form->create('JscForm'); ?>
	<fieldset>
		<legend><?php echo __('Add Jsc Form'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('form');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Jsc Forms'), array('action' => 'index')); ?></li>
	</ul>
</div>
