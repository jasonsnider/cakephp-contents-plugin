<div class="row">
    <div class="col-md-12">
        <h2><?php echo $post['Post']['title']; ?></h2>

        <strong>By: </strong><?php echo $post['CreatedUser']['UserProfile']['display_name']; ?>
        <strong>On: </strong><?php echo date('m/d/y', strtotime($post['Post']['created'])); ?>

        <div><?php echo $post['Post']['body']; ?></div>
        <div>
            <?php 
            foreach($post['Tag'] as $tag):
                echo $this->Html->link(
                    $tag['name'], 
                    array(
                        'plugin'=>'tags',
                        'controller'=>'tags',
                        'action'=>'view',
                        $tag['name']
                    ), 
                    array(
                        'class'=>'label label-default'
                    )
                );
                echo '&nbsp;';
            endforeach; 
            ?>
        </div>
    </div>
</div>