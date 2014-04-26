<h2><?php echo __d('contents', 'Edit Post'); ?></h2>
<div class="row">
    <div class="col-md-12">
    <?php
		echo $this->Form->create(
			'Post', 
			array(
				'url'=>$this->here,
				'role'=>'form',
				'inputDefaults'=>array(
					'div'=>array(
						'class'=>'form-group'
					),
					'class'=>'form-control',
					'required'=>false
				)
			)
		);
		
		echo $this->Form->input('id');
		
		echo $this->Html->tag('a', '', array('id'=>'PostTitleAnchor', 'class'=>'anchor'));
		echo $this->Form->input('title');
		
		echo $this->Html->tag('a', '', array('id'=>'PostBodyAnchor', 'class'=>'anchor'));
		echo $this->Form->input('body', array('class'=>'editor'));

		echo $this->Html->tag('a', '', array('id'=>'PostDescriptionAnchor', 'class'=>'anchor'));
		echo $this->Form->input('description', array('type'=>'textarea', 'rows'=>4)); 
		
		echo $this->Html->tag('a', '', array('id'=>'PostKeywordsAnchor', 'class'=>'anchor'));
		echo $this->Form->input('keywords', array('type'=>'textarea', 'rows'=>4)); 
		
		echo $this->Html->tag('a', '', array('id'=>'PostTagsAnchor', 'class'=>'anchor'));
		echo $this->Form->input('tags', array('label'=>'Tags (Comma Seperated)', 'type'=>'textarea', 'rows'=>4));

		echo $this->Html->tag('a', '', array('id'=>'PostTimeStampsAnchor', 'class'=>'anchor'));
		echo $this->Form->input('created', array('type'=>'text'));
		echo $this->Form->input('modified', array('type'=>'text'));
		
		echo $this->Form->submit(
			 __d('contents', 'Submit'), 
			 array(
				 'div'=>array(
					 'class'=>'form-group'
				 ),
				 'class'=>'btn btn-default'
			 )
		 ); 
		echo $this->Form->end();
	?>
    </div>
</div>