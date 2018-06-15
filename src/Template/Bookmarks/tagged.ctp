<h4>Find all bookmarks with tags: </h4>
<?php
    foreach($tags as $tag)
    {
    ?>
        <h4><?= h($tag)?></h4>
<?php
    }
?>
<?php
    foreach ($bookmarks as $bookmark)
    {?>
        <h4><?= $this->Html->link($bookmark->title,$bookmark->url)  ?></h4>
<?php
    }
?>
