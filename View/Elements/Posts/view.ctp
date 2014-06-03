<div class="panel panel-default">
	<?php if(!empty($relatedContent)): ?>
		<div class="panel-heading">
			<?php echo $this->Html->link(
				$relatedContent[0]['Category']['title'], 
				"/contents/contents/index/{$relatedContent[0]['Category']['id']}"); ?>
		</div>
		<ul class="nav nav-list">
			<?php foreach($relatedContent as $related): ?>
			<li>
				<?php echo $this->Html->link(
					$related[$model]['title'], 
					"/{$related[$model]['content_type']}/{$related[$model]['slug']}"); 
				?>
			</li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>
</div>