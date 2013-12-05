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
        echo $this->Form->input('description', array('type'=>'textarea', 'rows'=>4));
        echo $this->Form->input('keywords', array('type'=>'textarea', 'rows'=>4));

        echo $this->Form->input('controller', array('type'=>'text', 'value'=>$controller));
        echo $this->Form->input('action', array('type'=>'text', 'value'=>$action));

        echo $this->Form->submit(
             __d('contents', 'Submit'), 
             array(
                 'div'=>array(
                     'class'=>'form-group'
                 ),
                 'class'=>'btn btn-primary'
             )
         ); 
        echo $this->Form->end();
    ?>
    </div>
</div>