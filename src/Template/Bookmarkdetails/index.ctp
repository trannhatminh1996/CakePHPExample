<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmarkdetail[]|\Cake\Collection\CollectionInterface $bookmarkdetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bookmarkdetail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookmarks'), ['controller' => 'Bookmarks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bookmark'), ['controller' => 'Bookmarks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookmarkdetails index large-9 medium-8 columns content">
    <h3><?= __('Bookmarkdetails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bookmark_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookmarkdetails as $bookmarkdetail): ?>
            <tr>
                <td><?= $this->Number->format($bookmarkdetail->id) ?></td>
                <td><?= $bookmarkdetail->has('bookmark') ? $this->Html->link($bookmarkdetail->bookmark->title, ['controller' => 'Bookmarks', 'action' => 'view', $bookmarkdetail->bookmark->id]) : '' ?></td>
                <td><?= h($bookmarkdetail->created) ?></td>
                <td><?= h($bookmarkdetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bookmarkdetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookmarkdetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookmarkdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmarkdetail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
