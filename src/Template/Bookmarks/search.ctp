<?php
    echo $this->Form->create(null,['type'=>'post'] );

    echo $this->Form->control('Title',['required' => true,'label' => 'Enter The Title','placeholder'=>'Your title here']);
    echo $this->Form->button('Find');
    echo $this->Form->end();
?>
<?php if ($bookmarktitle!=null):?>
<h2> <?php echo $number?> Bookmarks Found:</h2>
<?php foreach ($bookmarktitle as $bookmark):?>

<h4><?= $this->Html->link($bookmark->title,$bookmark->url)  ?></h4>
<h4><?= __('Related Tags') ?></h4>
        <?php if (!empty($bookmark->tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($bookmark->tags as $tags): ?>
            <tr>
                <td><?= h($tags->id) ?></td>
                <td><?= h($tags->title) ?></td>
                <td><?= h($tags->created) ?></td>
                <td><?= h($tags->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

<h4><?= __('Related Details') ?></h4>
        <?php if (!empty($bookmark->bookmarkdetails)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($bookmark->bookmarkdetails as $bookmarkdetails): ?>
            <tr>
                <td><?= h($bookmarkdetails->id) ?></td>
                <td><?= h($bookmarkdetails->title) ?></td>
                <td><?= h($bookmarkdetails->created) ?></td>
                <td><?= h($bookmarkdetails->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bookmarkdetails', 'action' => 'view', $bookmarkdetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bookmarkdetails', 'action' => 'edit', $bookmarkdetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bookmarkdetails', 'action' => 'delete', $bookmarkdetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmarkdetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
<?php endforeach?>
<?php endif ?>