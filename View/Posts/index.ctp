<style>
    
    /* We don't want search results getting all whacky with different sizes of font */
    .well-result *{
        font-size: 14px;
        line-height: 20px;
    }
    
    .well-trans{
        background: transparent;
        border: none;
        box-shadow: none;
    }
    
</style>
<h2><?php echo $this->request->title; ?></h2>
<small class="text-muted well well-sm well-trans clearfix">
<?php
echo $this->Paginator->counter(array(
    'format' => 'Page {:page} of {:pages}, showing {:current} records out of
             {:count} total, starting on record {:start}, ending on {:end}'
));
?>
</small>
<?php foreach ($data as $content): ?>
<div class="well well-sm well-result">
    <strong>
    <?php 
        echo $this->Html->link(
            $content['Content']['title'], 
            array(
                'plugin'=>'contents',
                'controller'=>'posts',
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
