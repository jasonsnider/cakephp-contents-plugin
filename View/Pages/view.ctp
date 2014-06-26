<div class="row">
    <div class="col-md-12">
        <h1><?php echo $content['Page']['title']; ?></h1>
        <div><?php echo $content['Page']['body']; ?></div>
    </div>
</div>

<?php

//Build the form
if(isset($form['Form'])):
	
	//The form will always resolve itself to the page from which it was submitted
	$formOptions = array('url'=>$this->here);

	if(isset($form['Form'][0][1])){
		$formOptions = array_merge($formOptions, $form['Form'][0][1]);
	}

	//Create the form with element the results of element 0 merged with $this->here as the URL.
	echo $this->Form->create(
		(isset($form['Form'][0][0])?$form['Form'][0][0]:(isset($form['Form'][0])?$form['Form'][0]:array())),
		$formOptions
	);

	//Loop through all of the elements in the JSON string and build the form accordingly
	foreach($form['Form'] as $key => $value):
		
		//Skip element 0 and element 'submit'
		if(!in_array($key, array('0', 'submit'))):
			echo $this->Form->input(
				$key,
				(isset($value)?$value:array())
			);
		endif;
	endforeach;

	//If element 'submit' exists, build the button accordinlgy otherwise use CakePHP's default.
	if(isset($form['Form']['submit'])):
		echo $this->Form->submit(
			$form['Form']['submit'][0], 
			(isset($form['Form']['submit'][1])?$form['Form']['submit'][1]:array())
		);
		echo $this->Form->end();
	else:
		echo $this->Form->end(__('Submit'));		
	endif;
	
endif;