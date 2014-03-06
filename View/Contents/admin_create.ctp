<h1><?php echo __d('contents', 'Create Content'); ?></h1>
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
    ?>
    </div>
    <div class="col-md-3">
        <?php 
            echo $this->Form->input('content_type', array('onchange'=>'ContentForm.setDisplay()'));

            echo $this->Form->input('content_status', array('type'=>'hidden', 'value'=>'draft'));
            
            echo "<div id=\"MetaDataFormFields\" style=\"display:none;\">";
                echo $this->Form->input('controller');
                echo $this->Form->input('action');
            echo "</div>";
            
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