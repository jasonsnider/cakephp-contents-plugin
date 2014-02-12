<div class="row">
    <div class="col-md-12">
        <h2><?php echo $content['Content']['title']; ?></h2>

        <strong>By: </strong><?php echo $content['CreatedUser']['UserProfile']['display_name']; ?>
        <strong>On: </strong><?php echo date('m/d/y', strtotime($content['Content']['created'])); ?>

        <div><?php echo $content['Content']['body']; ?></div>
    </div>
</div>