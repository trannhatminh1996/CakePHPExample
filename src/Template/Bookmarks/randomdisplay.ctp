
<?php foreach ($bookmarks as $bookmark):?>
    <h1 class="bookmarkid"><?=h($bookmark->id)?></h1>
    <h2 class="bookmarktitle"><?=h($bookmark->title)?></h2>
    <h2 class="bookmarkurl"><?=h($bookmark->url)?></h2>
    <br>
<?php endforeach?>