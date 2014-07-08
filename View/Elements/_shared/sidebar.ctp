<aside>
	<?php if(!empty($relatedContent)): ?>
		<header>Related</header>
		<ul>
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
</aside>

<aside>
	<?php if(!empty($recentContent)): ?>
		<header>Recent</header>
		<ul>
			<?php foreach($recentContent as $recent): ?>
			<li>
				<?php echo $this->Html->link(
					$recent['Content']['title'], 
					"/{$recent['Content']['content_type']}/{$recent['Content']['slug']}");
				?>
			</li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>
</aside>

<aside>
	<?php if(!empty($categories)): ?>
		<header>Categories</header>
		<ul>
			<?php foreach($categories as $key=>$value): ?>
				<li><?php echo $this->Html->link($value, "/contents/contents/index/{$key}"); ?></li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>
</aside>