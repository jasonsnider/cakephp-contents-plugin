<?php foreach ($data as $content): ?>
<div class="well well-sm well-result">
    <strong>
    <?php 
        echo $this->Html->link(
            $content['Content']['title'], 
            array(
                'plugin'=>'contents',
                'controller'=>'pages',
                'action'=>'view',
                $content['Content']['slug']
            )
        );
    ?>
    </strong>
    <div class="text-muted">
        <em>
            <strong>Posted On:</strong>
            <?php echo date('m/d/y', strtotime($content['Content']['created'])); ?>
        </em>
    </div>
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
