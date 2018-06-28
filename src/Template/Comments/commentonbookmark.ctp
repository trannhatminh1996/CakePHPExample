
<?php
    function commentcount($focuscomment,$commentlist,$margin_left)
    {
        $a=[];
        foreach ($commentlist as $comment){
            if ($comment->parentcomment == $focuscomment->id)
            {
                array_push($a,$comment);
            }
        }
        foreach ($a as $b)
        {
            
?>
            <div class="<?=h($focuscomment->id)?>" style="overflow: hidden; display: none;">
            <h2 style="margin-left:<?=h($margin_left)?>px;" id="<?=h($b->id)?>" bookmark="<?=h($b->bookmark_id)?>"><?php echo nl2br($b->content);?></h2>
<?php
            commentcount($b,$commentlist,$margin_left+50);
?>
            </div>
<?php
        }
    }
?>
<span id="test"></span>

<?php foreach ($bookmarks as $bookmark):?>
    <div id= 'bookmark<?=$bookmark->id?>'>
    <p id="bookmark"><?= h($bookmark->title)?></p>
    <input type="button" class="post_button" bookmarkid="<?=h($bookmark->id)?>" value="Post Comment"/>
    <?php foreach  ($bookmark->comments as $comment):?>
        <?php if ($comment->parentcomment==0):?>
        <div class="0">
           <h2 style="margin-left:0px;" id="<?=h($comment->id)?>" bookmark="<?=h($comment->bookmark_id)?>"><?php echo nl2br($comment->content);?></h2>
            <?php commentcount($comment,$comments,50)?>
        </div>
        <?php endif ?>
    <?php endforeach?>
    </div>
<?php endforeach?>

<script src="/js/jquery.js"></script>
<script src="/js/sources/commentonbookmark.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/autosize.js"></script>
<script src="/js/autosize.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>

<link href="/css/style.css" rel="stylesheet"/>

