<h2><?php echo __d('contents', 'New Content'); ?></h2>
<div class="row">
    <div class="col-md-8">
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
    ?>
    </div>
</div>