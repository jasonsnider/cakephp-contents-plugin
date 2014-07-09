<aside>
	<?php if(!empty($widgetRelatedContent)): ?>
		<header>Related</header>
		<ul>
			<?php foreach($widgetRelatedContent as $related): ?>
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
	<?php if(!empty($widgetRecentContent)): ?>
		<header>Recent</header>
		<ul>
			<?php foreach($widgetRecentContent as $recent): ?>
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
	<?php if(!empty($widgetCategories)): ?>
		<header>Categories</header>
		<ul>
			<?php foreach($widgetCategories as $key=>$value): ?>
				<li><?php echo $this->Html->link($value, "/contents/contents/index/{$key}"); ?></li>
			<?php endforeach; ?>
		</ul>

	<?php endif; ?>
</aside>