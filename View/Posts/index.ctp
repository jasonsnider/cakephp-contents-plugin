<h2>Posts</h2>
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
            <tr><th>Content</th></tr>
            <?php foreach ($data as $content): ?>
                <tr>
                    <td>
                        <strong>
                        <?php 
                            echo $this->Html->link(
                                $content['Content']['title'], 
                                "/contents/posts/view/{$content['Content']['slug']}"
                            );
                        ?>
                        </strong>
                        <div><?php echo $this->Text->truncate($content['Content']['body'], '300'); ?></div>
                        <div>
                            <strong>By:</strong>
                            <?php echo $data[$i]['CreatedUser']['UserProfile']['display_name']; ?>
                            <strong>On:</strong>
                            <?php echo date('m/d/y', strtotime($data[$i]['Content']['created'])); ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php echo $this->element('pager'); ?>
    </div>
</div>