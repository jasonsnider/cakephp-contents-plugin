<h2><?php echo __d('contents', 'Edit Content'); ?></h2>
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
    echo $this->Form->input('id');
    echo $this->Form->input('title');
    echo $this->Form->input('body', array('class'=>'editor'));
    ?>
        
    <div 
        id="MetaDataFormFields" 
        style="display:<?php echo $this->request->data['Content']['content_type']=='meta_data'?'block':'none';?>;">
    <?php
        echo $this->Form->input('controller');
        echo $this->Form->input('action');
    ?>
    </div>

    </div>
    <div class="col-md-3">
        <?php 
        
            echo $this->Form->input('description', array('type'=>'textarea', 'rows'=>4)); 
            echo $this->Form->input('keywords', array('type'=>'textarea', 'rows'=>4)); 
            echo $this->Form->input('tags', array('label'=>'Tags (Comma Seperated)', 'type'=>'textarea', 'rows'=>4));
            echo $this->Form->input('content_type', array('onchange'=>'ContentForm.setDisplay()'));

            echo $this->Form->input('content_status');
            echo $this->Form->submit(
                 __d('contents', 'Submit'), 
                 array(
                     'div'=>array(
                         'class'=>'form-group'
                     ),
                     'class'=>'btn btn-primary btn-block'
                 )
             ); 
            echo $this->Form->end();
        ?>
    </div>
</div>