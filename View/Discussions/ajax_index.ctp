<div id="NewComment<?php echo $modelId; ?>">
<?php 
echo $this->Html->link(
    'Leave a comment',
    "/ajax/contents/discussions/create/{$modelId}/{$model}/",
    array(
        'id'=>"NewCommentButton{$modelId}",
        'data-ajax-link',
        'data-target'=>"#NewComment{$modelId}",
        'class'=>'btn btn-default btn-sm',
    )  
);
?>
</div>
<div>&nbsp;</div>
<div id="CommentStream<?php echo $modelId; ?>">
    <?php foreach($comments as $comment): ?>
    <div class="well well-sm">
        <div class="text-muted">
            <?php echo $comment['CreatedUser']['UserProfile']['display_name']; ?>,
            <?php echo date('m/d/Y', strtotime($comment['Content']['created'])); ?>
        </div>
        <div><?php echo $comment['Content']['body']; ?></div>
    </div>
    <?php endforeach; ?>
</div>