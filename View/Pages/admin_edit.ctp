<?php
echo $this->Form->create(
	'Page', 
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

echo $this->Html->tag('a', '', array('id'=>'PageTitleAnchor', 'class'=>'anchor'));
echo $this->Form->input('title');

echo $this->Html->tag('a', '', array('id'=>'PageBodyAnchor', 'class'=>'anchor'));
echo $this->Form->input('body', array('class'=>'editor'));

echo $this->Html->tag('a', '', array('id'=>'PageDescriptionAnchor', 'class'=>'anchor'));
echo $this->Form->input('description', array('type'=>'textarea', 'rows'=>4)); 

echo $this->Html->tag('a', '', array('id'=>'PageKeywordsAnchor', 'class'=>'anchor'));
echo $this->Form->input('keywords', array('type'=>'textarea', 'rows'=>4)); 

echo $this->Html->tag('a', '', array('id'=>'PageTagsAnchor', 'class'=>'anchor'));
echo $this->Form->input('tags', array('label'=>'Tags (Comma Seperated)', 'type'=>'textarea', 'rows'=>4));

echo $this->Html->tag('a', '', array('id'=>'PageCategoriesAnchor', 'class'=>'anchor'));
echo $this->Form->input('category_id', array('empty'=>true));

echo $this->Html->tag('a', '', array('id'=>'PageContentStatusAnchor', 'class'=>'anchor'));
echo $this->Form->input('content_status');

echo $this->Html->tag('a', '', array('id'=>'PageJscFormAnchor', 'class'=>'anchor'));
echo $this->Form->input('jsc_form_id', array('empty'=>true));

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