<table class="table table-bordered table-condensed table-striped table-hover">
	<tr>
		<th><?php echo $this->Paginator->sort('title'); ?></th>
	</tr>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo $this->Html->link(
			$category['Category']['title'], "/contents/categories/view/{$category['Category']['id']}"); ?></td>
	</tr>
<?php endforeach; ?>
</table>