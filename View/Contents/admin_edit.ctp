<?php echo $this->element('Utilities.sidebar'); ?>
<div class="view">
    <h2><?php echo __d('contents', 'Edit Content'); ?></h2>
    <?php
    echo $this->Form->create('Content');
    echo $this->Form->input('id');
    echo $this->Form->input('title');
    echo $this->Form->input('body');
    echo $this->Form->input('description', array('type'=>'text'));
    echo $this->Form->input('keywords', array('type'=>'text'));
    echo $this->Form->input('content_type');
    echo $this->Form->end(__d('contents', 'Submit'));
    ?>
</div>

