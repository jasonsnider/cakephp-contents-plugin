<ul class="nav nav-sidebar">
	<li><?php echo $this->Html->link(__('Content'), "/admin/contents/"); ?></li>
	<li><?php echo $this->Html->link(__('Categories'), "/admin/contents/categories/"); ?></li>
	<li><?php echo $this->Html->link(__('Forms'), "/admin/contents/jsc_forms/"); ?></li>
	<li class="divider"></li>
	<li><?php echo $this->Html->link(
		__('View'), "/admin/contents/categories/view/" . $this->Form->value('Category.id')); ?></li>
	<li><?php echo $this->Html->link(__('Top'), "#Top"); ?></li>
</ul>