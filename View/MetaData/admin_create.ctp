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
echo $this->Form->input('title');
echo $this->Form->input('controller', array('value'=>$controller));
echo $this->Form->input('action', array('value'=>$action));
echo $this->Form->input('content_type', array('type'=>'hidden', 'value'=>'meta_data'));
echo $this->Form->submit(
	 __d('contents', 'Submit'), 
	 array(
		 'div'=>array(
			 'class'=>'form-group clearfix'
		 ),
		 'class'=>'btn btn-primary pull-right'
	 )
 ); 
echo $this->Form->end();