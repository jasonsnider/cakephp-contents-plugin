<?php echo $this->element('sidebar'); ?>
<div class="view">
    <h2>Contents</h2>
    <div class="menu">
        <ul>
            <li><?php echo $this->Html->link('Create', '/admin/contents/contents/create'); ?></li>
        </ul>
    </div>
    <table>
        <caption>
            <?php
            echo $this->Paginator->counter(array(
                'format' => 'Page {:page} of {:pages}, showing {:current} records out of
                         {:count} total, starting on record {:start}, ending on {:end}'
            ));
            ?>
        </caption>
        <tr>
            <th><?php echo $this->Paginator->sort('content_type', 'Content Type'); ?></th>
            <th>Actions</th>
        </tr>
        <?php foreach ($data as $content): ?>
            <tr>
                <td>
                    <strong>
                    <?php 
                        echo $this->Html->link(
                            $content['Content']['title'], 
                            "/admin/contents/contents/view/{$content['Content']['id']}"
                        );
                    ?>
                    </strong>
                    <div><?php echo $this->Text->truncate($content['Content']['body'], '300'); ?></div>
                </td>
                <td class="actions">
                    <?php
                    echo $this->Html->link(
                            'view', "/admin/contents/contents/view/{$content['Content']['id']}"
                    );

                    echo $this->Html->link(
                            'edit', "/admin/contents/contents/edit/{$content['Content']['id']}"
                    );

                    echo $this->Html->link(
                            'delete', "/admin/contents/contents/delete/{$content['Content']['id']}"
                    );
                    ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->element('pager'); ?>
</div>