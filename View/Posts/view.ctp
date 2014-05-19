<div class="row">
    <div class="col-md-12">
        <h2><?php echo $content['Post']['title']; ?></h2>

        <strong>By: </strong><?php echo $content['CreatedUser']['UserProfile']['display_name']; ?>
        <strong>On: </strong><?php echo date('m/d/y', strtotime($content['Post']['created'])); ?>

        <div><?php echo $content['Post']['body']; ?></div>
        <div>
            <?php 
            foreach($content['Tag'] as $tag):
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