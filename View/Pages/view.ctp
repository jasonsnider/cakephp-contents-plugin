<div class="row">
    <div class="col-md-12">
        <h1><?php echo $content['Page']['title']; ?></h1>
        <div><?php echo $content['Page']['body']; ?></div>
    </div>
</div>

<?php

//Build the form
if(isset($form['Form'])):
	$formOptions = array('url'=>$this->here);

	if(isset($form['Form'][0][1])){
		$formOptions = array_merge($formOptions, $form['Form'][0][1]);
	}

	echo $this->Form->create(
		(isset($form['Form'][0][0])?$form['Form'][0][0]:(isset($form['Form'][0])?$form['Form'][0]:array())),
		$formOptions
	);

	foreach($form['Form'] as $key => $value):
		if(!in_array($key, array('0', 'submit'))):
			echo $this->Form->input(
				$key,
				(isset($value)?$value:array())
			);
		endif;
	endforeach;

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