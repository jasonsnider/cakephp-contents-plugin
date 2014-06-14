<h2><?php echo $this->request->title; ?></h2>
<?php foreach ($data as $content): ?>
<div class="well well-sm well-result">
    <strong>
        <?php 
            echo $this->Html->link(
                $content['Content']['title'], 
                array(
                    'plugin'=>'contents',
                    'controller'=>"{$content['Content']['content_type']}s",
                    'action'=>'view',
                    $content['Content']['slug']
                )
            );
        ?>
    </strong>
    <div>
		<?php 
			echo $this->Text->truncate(
				$content['Content']['body'], 
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
