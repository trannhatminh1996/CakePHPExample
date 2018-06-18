<?php
    echo $this->Form->create(null,['type'=>'post','id'=>'form']);
    foreach ($tags as $tag)
    {?>
        <input type="button" value="<?= h($tag->title)?>"/>
    <?php
    }
    ?>

    <?php
    echo $this->Form->submit(__('Find All'),['id'=>'submit_button']);
    echo $this->Form->end();

?>
<?php if ($bookmarks!=null):?>

<h2><?=h($bookmarkcount)?> Bookmarks Found:</h2>
<?php
    foreach ($bookmarks as $bookmark)
    {?>
        <h4><?= $this->Html->link($bookmark->title,$bookmark->url)  ?></h4>
        
<?php
    }
?>
<?php else:?>
    <h4>Not found any bookmarks:</h4>
<?php endif ?>

<script src="/js/jquery.js"></script>
<script src="/js/sources/findTags.js"></script>

