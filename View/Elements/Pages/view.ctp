<aside>
	<?php if(!empty($relatedContent)): ?>
		<h4><?php echo !empty($relatedContent[0])?$relatedContent[0]['Category']['title']:'Related'; ?></h4>
		<ul>
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
</aside>
