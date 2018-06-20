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

<?php if ($bookmarkcount>0):?>

<h4>SORT BY:</h4>
<select id="list">
    <option value="id">Id</option>
    <option value="title">Title</option>
    <option value="daycreated">Day Created</option>
    <option value="daymodified">Day Modified</option>
</select>

<input class= "sort" type="checkbox" value="id" checked disabled/>Id
<input class= "sort" type="checkbox" value="title"/>Title
<input class= "sort" type="checkbox" value= "daycreated"/> Day Created
<input class= "sort" type="checkbox" value= "daymodified"/> Day Modified

<div class="bookmarks index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Web</th>
                <th scope="col">By User</th>
                <th scope="col">Created</th>
                <th scope="col">Modified</th>
                <th scope="col">Tag Related</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookmarks as $bookmark): ?>
            <tr class="sorting" id="<?=$bookmark->id?>" title ="<?=$bookmark->title?>" daycreated="<?=$bookmark->created?>" daymodified="<?=$bookmark->modified?>">
                <td><?= $this->Number->format($bookmark->id) ?></td>
                <td><?= h($bookmark->title) ?></td>
                <td><?= $this->Html->link($bookmark->url,$bookmark->url)?></td>
                <td><?= $this->Html->link($bookmark->user->name,['controller'=>"Users",'action'=>'view',$bookmark->user->id])?></td>
                <td><?= h($bookmark->created) ?></td>
                <td><?= h($bookmark->modified) ?></td>
                <td><?php foreach ($bookmark->tags as $tag):?>
                    <?php
                        $len = count($bookmark->tags);
                        if ($len>0):
                    ?>
                    <?=$this->Html->link($tag->title,['controller'=> 'Tags','action'=>'view',$tag->id])?>
                    <?php
                        if ($len>1):
                    ?>
                        <?php if ($tag==$bookmark->tags[$len-2]):?>
                    and
                        <?php elseif ($tag==$bookmark->tags[$len-1]):?>
                    
                        <?php else: ?>
                    ,
                    <?php endif?>
                    <?php endif?>
                    <?php endif?>
                    <?php endforeach?>
                    </td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bookmark->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookmark->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookmark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmark->id)]) ?>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php elseif ($bookmarkcount==0):?>
    <h4>Not found any bookmarks:</h4>
<?php endif ?>

<script src="/js/jquery.js"></script>
<script src="/js/sources/findTags.js"></script>

