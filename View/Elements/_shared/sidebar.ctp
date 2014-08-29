<aside>
	<?php if(!empty($widgetRelatedContent)): ?>
		<header>Related</header>
		<ul>
			<?php foreach($widgetRelatedContent as $related): ?>
			<li>
				<?php 
				
					$uri = "/{$related['Content']['content_type']}/{$related['Content']['slug']}";
					if($related['Content']['content_type'] === 'meta_data'){
						$uri = "/{$related['Content']['plugin']}/{$related['Content']['controller']}/"
							. $related['Content']['action'];
					}
					
					echo $this->Html->link($related['Content']['title'], $uri);
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
				<?php 
					$uri = "/{$recent['Content']['content_type']}/{$recent['Content']['slug']}";
					if($recent['Content']['content_type'] === 'meta_data'){

						$uri = null;
						if(!empty($recent['Content']['plugin'])){
							$uri .= "/{$recent['Content']['plugin']}";
						}

						$uri .= "/{$recent['Content']['controller']}/{$recent['Content']['action']}";

					}
					
					echo $this->Html->link($recent['Content']['title'], $uri);
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
