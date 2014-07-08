<article>
	<header>
		<h1><?php echo $content['Post']['title']; ?></h1>
		<div class="meta-data">
			Posted On <time 
				class="meta-data"
				datetime="<?php echo date('m/d/y', strtotime($content['Post']['created'])); ?>">
				<?php echo date('l, F jS, Y \a\t H:i', strtotime($content['Post']['created'])); ?></time>
				By Jason D Snider
		</div>
	</header>
	<?php echo $content['Post']['body']; ?>
	
</article>

<aside>
	<?php 
	foreach($content['Tag'] as $tag):
		echo $this->Html->link(
			$tag['name'], 
			array(
				'plugin'=>'contents',
				'controller'=>'contents',
				'action'=>'search',
				'tags'=>$tag['name']
			), 
			array(
				'class'=>'tags'
			)
		);
		echo '&nbsp;';
	endforeach; 
	?>
</aside>