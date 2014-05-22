<div class="panel panel-default">
	<?php if(!empty($relatedContent)): ?>
		<div class="panel-heading">
			<?php echo $this->Html->link(
				$relatedContent[0]['Category']['title'], 
				"/category/{$relatedContent[0]['Category']['id']}"); ?>
		</div>
		<ul class="nav nav-list">
			<?php foreach($relatedContent as $related): ?>
			<li>
				<?php echo $this->Html->link(
					$related['Content']['title'], 
					"/{$related['Content']['content_type']}/{$related['Content']['slug']}"); 
				?>
			</li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>
</div>