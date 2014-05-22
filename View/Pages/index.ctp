<?php foreach ($data as $content): ?>
<div class="well well-sm well-result">
    <strong>
    <?php 
        echo $this->Html->link(
            $content['Page']['title'], 
            array(
                'plugin'=>'contents',
                'controller'=>'pages',
                'action'=>'view',
                $content['Page']['slug']
            )
        );
    ?>
    </strong>
</div>
<?php endforeach; ?>

<?php echo $this->element('pager'); ?>
