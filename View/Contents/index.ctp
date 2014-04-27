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
    <?php 
        echo $this->Html->tag(
            'strong',    
            Inflector::humanize($content['Content']['content_type']),
            array(
                'class'=>'text-muted'
            )
        ); 
    ?>
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
