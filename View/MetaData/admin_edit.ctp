<?php
echo $this->Form->create(
	'MetaData', 
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
echo $this->Html->tag('a', '', array('id'=>'MetaDataTitleAnchor', 'class'=>'anchor'));
echo $this->Form->input('title');
echo $this->Html->tag('a', '', array('id'=>'MetaDataDescriptionAnchor', 'class'=>'anchor'));
echo $this->Form->input('description', array('type'=>'textarea', 'rows'=>4));
echo $this->Html->tag('a', '', array('id'=>'MetaDataDescriptionAnchor', 'class'=>'anchor'));
echo $this->Form->input(
	'body', 
	array(
		'type'=>'textarea', 
		'rows'=>4, 'class'=>'editor', 
		'label'=>'Body* (Must be set in code to appear on the desired page.)'
	)
);
echo $this->Html->tag('a', '', array('id'=>'MetaDataKeywordsAnchor', 'class'=>'anchor'));
echo $this->Form->input('keywords', array('type'=>'textarea', 'rows'=>4));
echo $this->Html->tag('a', '', array('id'=>'MetaDataTagsAnchor', 'class'=>'anchor'));
echo $this->Form->input('tags', array('type'=>'textarea', 'rows'=>4));
echo $this->Html->tag('a', '', array('id'=>'MetaDataCategoriesAnchor', 'class'=>'anchor'));
echo $this->Form->input('category_id', array('empty'=>true));
echo $this->Form->submit(
	 __d('contents', 'Submit'), 
	 array(
		 'div'=>array(
			 'class'=>'form-group clearfix'
		 ),
		 'class'=>'btn btn-default'
	 )
 );

echo $this->Form->end();