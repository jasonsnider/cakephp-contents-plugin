<aside>
	<?php if(!empty($relatedContent)): ?>
		<h4>
			<?php echo $this->Html->link(
				'Related Posts', 
				"/contents/contents/index/{$relatedContent[0]['Category']['id']}"); ?>
		</h4>
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
