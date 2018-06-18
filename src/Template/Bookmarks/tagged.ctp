<h4>Find all bookmarks with tags: <?=$this->Text->toList($tags)?></h4>
<?php if ($bookmarks!=null):?>
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
