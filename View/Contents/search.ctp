<?php

foreach($contents as $content):
    
    $link = $this->Html->link(
        $content['Content']['title'],
        array(
            'plugin'=>'contents',
            'controller'=>Inflector::pluralize($content['Content']['content_type']),
            'action'=>'view',
            $content['Content']['slug']
        )
    );

    $snippet = $this->Html->tag('h4', $link);

    echo $this->Html->div(
        'well well-sm',
        $snippet
    );
    
endforeach;

echo $this->Form->create(
    'Content', 
    array(
        'url' => $this->here,
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
echo $this->Form->input('body');
echo $this->Form->submit(__('Search'));
echo $this->Form->end();