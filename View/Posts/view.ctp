<div class="row">
    <div class="col-md-12">
        <h2><?php echo $content['Content']['title']; ?></h2>

        <strong>By: </strong><?php echo $content['CreatedUser']['username']; ?>
        <strong>On: </strong><?php echo date('m/d/y', strtotime($content['CreatedUser']['created'])); ?>

        <div><?php echo $content['Content']['body']; ?></div>
    
        <?php if(Configure::check('Parbake.Blog.comment_engine')): ?>
            <?php if(Configure::read('Parbake.Blog.comment_engine') === true): ?>
                <hr>
                <h2>Leave a comment</h2>
                <?php echo $this->Form->create('Discussion'); ?>
                <?php echo $this->Form->input('model', array('type'=>'hidden', 'value'=>'Content')); ?>
                <?php echo $this->Form->input('model_id', array('type'=>'hidden', 'value'=>$content['Content']['id'])); ?>
                <?php echo $this->Form->input('body', array('Comment')); ?>
                <?php echo $this->Form->end('Submit'); ?>

                <?php foreach($content['Discussion'] as $comment): ?>
                    <div>
                        <?php echo $comment['body']; ?>
                        <div>
                            <strong>By:</strong><?php echo $comment['CreatedUser']['username']; ?>
                            <strong>On:</strong><?php echo $comment['CreatedUser']['created']; ?>
                        </div>
                        <hr>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>