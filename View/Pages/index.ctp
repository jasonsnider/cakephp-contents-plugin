<?php foreach ($data as $post): ?>
<article>
	<header>
		<?php 
			echo $this->Html->tag(
				'h1',
				$this->Html->link(
					$post['Page']['title'], 
					array(
						'plugin'=>'contents',
						'controller'=>'posts',
						'action'=>'view',
						$post['Page']['slug']
					)
				)
			);
		?>
		<div class="meta-data">
			Pageed On <time 
				class="meta-data"
				datetime="<?php echo date('m/d/y', strtotime($post['Page']['created'])); ?>">
				<?php echo date('l, F jS, Y \a\t H:i', strtotime($post['Page']['created'])); ?></time>
				By Jason D Snider
		</div>
	</header>
	<?php echo $post['Page']['body']; ?>
	
	<aside>
	<?php 
		echo $this->Html->link(
			'Comments', 
			"/post/{$post['Page']['slug']}#comments"
		);
	?>
	</aside>
</article>
<?php endforeach; ?>

<?php echo $this->element('pager'); ?>
