<div class="jscForms form">
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

echo $this->Form->input('name');
echo $this->Html->tag('strong',__('A sample JSON strings for creating a form'));
echo $this->Html->tag('pre',
	$this->Html->tag('code',
		json_encode(
			array(
				'Form'=>array(
					array(
						'JscForm'
					),
					'name'=>array(
						'type'=>'text',
					),
					'email'=>array(
						'type'=>'email',
					),
					'message'=>array(
						'type'=>'textarea',
					),
					'submit'=>array(
						'Submit'
					)
				)
			)
		)
	)
);

echo $this->Html->tag('pre',
	$this->Html->tag('code',
		json_encode(
			array(
				'Form'=>array(
					array(
						'JscForm', 
						array(
							'role'=>'form',
							'inputDefaults'=>array(
								'div'=>array(
									'class'=>'form-group'
								),
								'class'=>'form-control',
								'required'=>false
							)
						)
					),
					'name'=>array(
						'type'=>'text',
					),
					'email'=>array(
						'type'=>'email',
					),
					'message'=>array(
						'type'=>'textarea',
					),
					'submit'=>array(
						'Submit',
						array(
							'div'=>array(
								'class'=>'form-group'
							),
							'class'=>'btn btn-default'
						)
					)
				),
				'Validate'=>array(
					'name' => array(
						'rule' => 'email',
						'message' => 'Please enter your name.'
					),
					'email' => array(
						'rule' => 'email',
						'message' => 'Please enter a valid email.'
					),
					'message' => array(
						'rule' => 'notEmpty',
						'message' => 'Please enter a message'
					)
				)
			)
		)
	)
);

echo $this->Form->input(
	'form', 
	array(
		'type'=>'textarea'
	)
);

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