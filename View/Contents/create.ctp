<?php echo $this->element('sidebar'); ?>
<div class="view">
    <h1><?php echo __d('contents', 'New Content'); ?></h1>
    <?php
    echo $this->Form->create('Content');
    echo $this->Form->input('title');
    echo $this->Form->input('body');
    echo $this->Form->input('description', array('type'=>'text'));
    echo $this->Form->input('keywords', array('type'=>'text'));
    echo $this->Form->input('content_type');
    echo $this->Form->end(__d('contents', 'Submit'));
    ?>
</div>

