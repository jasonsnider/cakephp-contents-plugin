<div class="jscForms view">
<h2><?php echo __('Jsc Form'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($jscForm['JscForm']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($jscForm['JscForm']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Form'); ?></dt>
		<dd>
			<?php echo h($jscForm['JscForm']['form']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($jscForm['JscForm']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($jscForm['JscForm']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Jsc Form'), array('action' => 'edit', $jscForm['JscForm']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Jsc Form'), array('action' => 'delete', $jscForm['JscForm']['id']), null, __('Are you sure you want to delete # %s?', $jscForm['JscForm']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Jsc Forms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jsc Form'), array('action' => 'add')); ?> </li>
	</ul>
</div>
