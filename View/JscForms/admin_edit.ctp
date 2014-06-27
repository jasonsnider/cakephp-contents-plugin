<?php 
echo $this->Form->create(
	'JscForm', 
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
echo $this->Form->input('name');
echo $this->Form->input('form', array('type'=>'textarea'));
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
?>

<h2>Preview</h2>
<?php

//[TODO] Convert this to a helper
//Build the form
$form = json_decode($this->Form->value('JscForm.form'), true);
$this->request->data = array();
if(isset($form['Form'])):
	$theForm = null;
	
	//The form will always resolve itself to the page from which it was submitted
	$formOptions = array('url'=>$this->here);

	if(isset($form['Form'][0][1])){
		$formOptions = array_merge($formOptions, $form['Form'][0][1]);
	}

	//Create the form with element the results of element 0 merged with $this->here as the URL.
	$theForm .= $this->Form->create(
		(isset($form['Form'][0][0])?$form['Form'][0][0]:(isset($form['Form'][0])?$form['Form'][0]:array())),
		$formOptions
	);

	//Loop through all of the elements in the JSON string and build the form accordingly
	foreach($form['Form'] as $field => $options):
		
		//Skip element 0 and element 'submit'
		if(!in_array($field, array('0', 'submit'))):
			$theForm .= $this->Form->input(
				$field,
				(isset($options)?$options:array())
			);
		endif;
		
	endforeach;
	

	//If element 'submit' exists, build the button accordinlgy otherwise use CakePHP's default.
	if(isset($form['Form']['submit'])):
		$theForm .= $this->Form->submit(
			$form['Form']['submit'][0], 
			(isset($form['Form']['submit'][1])?$form['Form']['submit'][1]:array())
		);
		$theForm .= $this->Form->end();
	else:
		$theForm .= $this->Form->end(__('Submit'));		
	endif;
	
	echo $theForm;
endif;