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

echo $this->Html->tag('a', '', array('id'=>'PostCategoriesAnchor', 'class'=>'anchor'));
echo $this->Form->input('category_id', array('empty'=>true));

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