<h2>Contents</h2>
<ul class="nav nav-pills">
    <li><?php echo $this->Html->link('Create', '/admin/contents/contents/create'); ?></li>
</ul>

<div class="row">
    <div class="col-md-12">
       <table class="table table-bordered table-condensed table-striped table-hover">
            <caption>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => 'Page {:page} of {:pages}, showing {:current} records out of
                             {:count} total, starting on record {:start}, ending on {:end}'
                ));
                ?>
            </caption>
            <tr>
                <th>Type</th>
                <th>Status</th>
                <th>Title</th>
            </tr>
            <?php foreach ($data as $content): ?>
                <tr>
                    <td><?php echo $content['Content']['content_type']; ?></td>
                    <td><?php echo $content['Content']['content_status']; ?></td>
                    <td>
                        <?php 
                            echo $this->Html->link(
                                $content['Content']['title'], 
                                "/admin/contents/contents/view/{$content['Content']['id']}"
                            );
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->element('pager'); ?>
    </div>
</div>