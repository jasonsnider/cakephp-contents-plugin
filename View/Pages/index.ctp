<?php foreach ($data as $content): ?>
<div>
    <?php 
        echo $this->Html->tag(
			'h2',
			$this->Html->link(
				$content['Page']['title'], 
				array(
					'plugin'=>'contents',
					'controller'=>'pages',
					'action'=>'view',
					$content['Page']['slug']
				)
			)
        );
    ?>
    <div>
		<?php 
			echo $this->Text->truncate(
				$content['Page']['body'], 
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

