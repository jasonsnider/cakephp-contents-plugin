<div class="row">
    <div class="col-md-12">
        <h2><?php echo $content['Content']['title']; ?></h2>
        <strong>By: </strong><?php echo $content['CreatedUser']['UserProfile']['display_name']; ?>
        <strong>On: </strong><?php echo date('m/d/y', strtotime($content['Content']['created'])); ?>
        
        <?php echo $content['Content']['body']; ?>
        <div>
            <?php 
            foreach($content['Tag'] as $tag):
                echo $this->Html->link(
                    $tag['name'], 
                    array(
                        'plugin'=>'contents',
                        'controller'=>'contents',
                        'action'=>'search',
                        'tags' => $tag['name']
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