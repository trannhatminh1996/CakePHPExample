<?php foreach ($bookmarks as $bookmark):?>
    <h1><?=h($bookmark->id)?></h1>
    <h2><?=h($bookmark->title)?></h2>
    <h2><?=h($bookmark->url)?></h2>
    <br>
<?php endforeach?>