<h2><?php echo __('Related Contents'); ?></h2>
<?php if (!empty($category['Content'])): ?>
	<table class="table table-bordered table-condensed table-striped table-hover">
	<tr>
		<th><?php echo __('Title'); ?></th>
	</tr>
	<?php foreach ($category['Content'] as $content): ?>
		<tr>
			<td>
				<?php 
					$controller = Inflector::pluralize($content['content_type']);
					echo $this->Html->link(
						$content['title'], 
						"/contents/{$controller}/view/{$content['id']}"
					);
				?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php 

else:
	echo $this->Html->div('well well-sm', __('This category has no content'));
endif;

