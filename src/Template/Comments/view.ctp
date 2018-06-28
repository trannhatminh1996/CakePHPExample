<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Comment'), ['action' => 'edit', $comment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Comment'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookmarks'), ['controller' => 'Bookmarks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bookmark'), ['controller' => 'Bookmarks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="comments view large-9 medium-8 columns content">
    <h3><?= h($comment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Bookmark') ?></th>
            <td><?= $comment->has('bookmark') ? $this->Html->link($comment->bookmark->title, ['controller' => 'Bookmarks', 'action' => 'view', $comment->bookmark->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $comment->has('user') ? $this->Html->link($comment->user->name, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($comment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parentcomment') ?></th>
            <td><?= $this->Number->format($comment->parentcomment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($comment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($comment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($comment->content)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Comments') ?></h4>
        <?php if (!empty($comment->comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Bookmark Id') ?></th>
                <th scope="col"><?= __('Parentcomment') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($comment->comments as $comments): ?>
            <tr>
                <td><?= h($comments->id) ?></td>
                <td><?= h($comments->content) ?></td>
                <td><?= h($comments->bookmark_id) ?></td>
                <td><?= h($comments->parentcomment) ?></td>
                <td><?= h($comments->created) ?></td>
                <td><?= h($comments->modified) ?></td>
                <td><?= h($comments->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
