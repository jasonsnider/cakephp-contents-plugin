<?php 
echo $this->Form->create(
    'Content', 
    array(
        'data-ajax-form',
        'id'=>'NewCommentForm',
        'url'=>"/ajax/contents/discussions/create/{$modelId}/{$model}/",
        'data-form-target'=>"#NewComment{$modelId}",
        'data-stream-target'=>"#CommentStream{$modelId}",
        'data-spinner-target'=>"#NewCommentSubmitButton{$modelId}",
        'data-stream-url'=>"/ajax/contents/discussions/index/{$modelId}/{$model}/",
        'role'=>'form',
        'class'=>'well well-sm',
        'method'=>'POST',
        'inputDefaults'=>array(
            'div'=>array(
                'class'=>'form-group'
            ),
            'class'=>'form-control',
            'required'=>false
        )
    )
);

echo !empty($formError)?$this->Html->div('text-danger', $formError):false;

echo $this->Form->input(
    'body',
    array(
        'label'=>'Comment',
        'type'=>'textarea'
    )
);

echo $this->Form->input(
    'model',
    array(
        'type'=>'hidden'
    )
);


echo $this->Form->input(
    'model_id',
    array(
        'type'=>'hidden'
    )
);

echo $this->Form->input(
    'content_status',
    array(
        'type'=>'hidden',
        'value'=>'published'
    )
);


echo $this->Form->input(
    'content_type',
    array(
        'type'=>'hidden',
        'value'=>'discussion'
    )
);

echo $this->Form->submit(
     __d('contents', 'Submit'), 
     array(
         'div'=>array(
            'class'=>'form-group',
            'id'=>"NewCommentSubmitButton{$modelId}"
         ),
         'class'=>'btn btn-primary'
     )
 ); 

echo $this->Form->end();