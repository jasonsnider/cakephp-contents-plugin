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

echo $this->Form->input('title');

echo $this->Form->input('content_status', array('value'=>'draft', 'type'=>'hidden'));

echo $this->Form->submit(
	 __('Submit'), 
	 array(
		 'div'=>array(
			 'class'=>'form-group'
		 ),
		 'class'=>'btn btn-default'
	 )
 ); 
echo $this->Form->end();