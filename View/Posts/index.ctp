<?php foreach ($data as $post): ?>
<div>
    <?php 
        echo $this->Html->tag(
			'h2',
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
    <div class="text-muted">
        <em>
            <strong>Posted On:</strong>
            <?php echo date('m/d/y', strtotime($post['Post']['created'])); ?>
        </em>
    </div>
    <div>
		<?php 
			echo $this->Text->truncate(
				$post['Post']['body'], 
				'300', 
				array(
					'html'=>true, 
					'exact'=>false
				)
			); 
		?>
	</div>
</div>
<?php endforeach; ?>

<?php echo $this->element('pager'); ?>
