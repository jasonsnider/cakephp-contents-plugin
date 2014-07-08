<?php foreach ($data as $content): ?>
<article>
	<header>
		<?php 
			echo $this->Html->tag(
				'h1',
				$this->Html->link(
					$content['Content']['title'], 
					array(
						'plugin'=>'contents',
						'controller'=>"{$content['Content']['content_type']}s",
						'action'=>'view',
						$content['Content']['slug']
					)
				)
			);
		?>
		<div class="meta-data">
			Pageed On <time 
				class="meta-data"
				datetime="<?php echo date('m/d/y', strtotime($content['Content']['created'])); ?>">
				<?php echo date('l, F jS, Y \a\t H:i', strtotime($content['Content']['created'])); ?></time>
				By Jason D Snider
		</div>
	</header>
	<?php echo $content['Content']['body']; ?>
</article>
<?php endforeach; ?>

<?php echo $this->element('pager'); ?>
