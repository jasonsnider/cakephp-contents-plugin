<ul class="nav nav-sidebar">
	<li><?php echo $this->Html->link(__('Content'), "/admin/contents/"); ?></li>
	<li><?php echo $this->Html->link(__('Categories'), "/admin/contents/categories/"); ?></li>
	<li class="divider"></li>
	<li><?php echo $this->Html->link(
		__('Edit'), "/admin/contents/categories/edit/{$category['Category']['id']}"); ?></li>
	<li><a href="#Top">Top</a></li>
</ul>