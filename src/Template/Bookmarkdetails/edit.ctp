<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmarkdetail $bookmarkdetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bookmarkdetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bookmarkdetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bookmarkdetails'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bookmarks'), ['controller' => 'Bookmarks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bookmark'), ['controller' => 'Bookmarks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookmarkdetails form large-9 medium-8 columns content">
    <?= $this->Form->create($bookmarkdetail) ?>
    <fieldset>
        <legend><?= __('Edit Bookmarkdetail') ?></legend>
        <?php
            echo $this->Form->control('bookmark_id', ['options' => $bookmarks]);
            echo $this->Form->control('content');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
