<div id="NewComment<?php echo $modelId; ?>">
    <?php 
    echo $this->Html->link(
        'Leave a comment',
        "#NewComment{$modelId}",
        array(
            'onclick'=>"Discussion.loadCreate('{$modelId}'); return false;",
            'class'=>'btn btn-default btn-sm'
        )  
    );
    ?>
</div>
<div>&nbsp;</div>
<?php foreach($comments as $comment): ?>
<div class="well well-sm">
    <div class="text-muted">
        <?php echo $comment['CreatedUser']['UserProfile']['display_name']; ?>,
        <?php echo date('m/d/Y', strtotime($comment['Content']['created'])); ?>
    </div>
    <div><?php echo $comment['Content']['body']; ?></div>
</div>
<?php endforeach; ?>