<h1><?php echo __d('contents', 'Create Meta Data'); ?></h1>
<div class="row">
    <div class="col-md-9">
    <?php
        echo $this->Form->create(
            'Content', 
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
    echo $this->Form->input('body');
    echo $this->Form->input('description', array('type'=>'textarea', 'rows'=>2));
    echo $this->Form->input('keywords', array('type'=>'textarea', 'rows'=>2));
    echo $this->Form->input('content_type');
    echo $this->Form->end(__d('contents', 'Submit'));
    ?>
    </div>
</div>