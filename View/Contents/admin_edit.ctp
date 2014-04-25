<h2><?php echo __d('contents', 'Edit Content'); ?></h2>
<div class="row">
    <div class="col-md-12">
    <?php
		echo $this->Form->create(
			'Content', 
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
		
		echo $this->Html->tag('a', '', array('id'=>'ContentTitleAnchor', 'class'=>'anchor'));
		echo $this->Form->input('title');
		
		echo $this->Html->tag('a', '', array('id'=>'ContentBodyAnchor', 'class'=>'anchor'));
		echo $this->Form->input('body', array('class'=>'editor'));

		echo $this->Html->tag('a', '', array('id'=>'ContentDescriptionAnchor', 'class'=>'anchor'));
		echo $this->Form->input('description', array('type'=>'textarea', 'rows'=>4)); 
		
		echo $this->Html->tag('a', '', array('id'=>'ContentKeywordsAnchor', 'class'=>'anchor'));
		echo $this->Form->input('keywords', array('type'=>'textarea', 'rows'=>4)); 
		
		echo $this->Html->tag('a', '', array('id'=>'ContentTagsAnchor', 'class'=>'anchor'));
		echo $this->Form->input('tags', array('label'=>'Tags (Comma Seperated)', 'type'=>'textarea', 'rows'=>4));

		echo $this->Html->tag('a', '', array('id'=>'ContentTimeStampsAnchor', 'class'=>'anchor'));
		echo $this->Form->input('created', array('type'=>'text'));
		echo $this->Form->input('modified', array('type'=>'text'));

		echo $this->Form->input('content_status', array('value'=>'post', 'type'=>'hidden'));
		
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