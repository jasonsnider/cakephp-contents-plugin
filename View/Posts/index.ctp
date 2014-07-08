<?php foreach ($data as $post): ?>
<article>
	<header>
		<?php 
			echo $this->Html->tag(
				'h1',
				$this->Html->link(
					$post['Post']['title'], 
					array(
						'plugin'=>'contents',
						'controller'=>'posts',
						'action'=>'view',
						$post['Post']['slug']
					)
				)
			);
		?>
		<div class="meta-data">
			Posted On <time 
				class="meta-data"
				datetime="<?php echo date('m/d/y', strtotime($post['Post']['created'])); ?>">
				<?php echo date('l, F jS, Y \a\t H:i', strtotime($post['Post']['created'])); ?></time>
				By Jason D Snider
		</div>
	</header>
	<?php echo $post['Post']['body']; ?>
	
	<aside>
	<?php 
		echo $this->Html->link(
			'Comments', 
			"/post/{$post['Post']['slug']}#comments"
		);
	?>
	</aside>
</article>
<?php endforeach; ?>

<?php echo $this->element('pager'); ?>
