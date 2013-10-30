<div class="menu">
    <ul>
        <li><?php echo $this->Html->link('Index', '/admin/contents'); ?></li>
        <li><?php echo $this->Html->link('Create', '/admin/contents/create'); ?></li>
        <li><?php echo $this->Html->link('Edit', "/admin/contents/edit/{$id}"); ?></li>
        <li><?php echo $this->Html->link('Delete', "/admin/contents/delete/{$id}", null, 'Are you sure?'); ?></li>
    </ul>
</div>