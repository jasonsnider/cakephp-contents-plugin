<?php echo $this->element('Utilities.sidebar'); ?>
<div class="view">
    <h2><?php echo __d('contents', 'New Content'); ?></h2>
    <?php
    echo $this->Form->create('Content');
    echo $this->Form->input('title');
    echo $this->Form->input('body');
    echo $this->Form->input('description', array('type'=>'textarea', 'rows'=>2));
    echo $this->Form->input('keywords', array('type'=>'textarea', 'rows'=>2));
    echo $this->Form->input('content_type');
    echo $this->Form->end(__d('contents', 'Submit'));
    ?>
</div>

