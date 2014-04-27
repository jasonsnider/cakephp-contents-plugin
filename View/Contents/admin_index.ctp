<table class="table table-bordered table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Type</th>
			<th>Status</th>
			<th>Title</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($data as $content): ?>
		<tr>
			<td><?php echo $content['Content']['content_type']; ?></td>
			<td><?php echo $content['Content']['content_status']; ?></td>
			<td>
				<?php 
					$controller = Inflector::pluralize($content['Content']['content_type']);
					echo $this->Html->link(
						$content['Content']['title'], 
						"/admin/contents/{$controller}/edit/{$content['Content']['id']}"
					);
				?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php echo $this->element('pager'); ?>