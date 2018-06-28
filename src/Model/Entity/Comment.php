<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property string $content
 * @property int $bookmark_id
 * @property int $parentcomment
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $user_id
 *
 * @property \App\Model\Entity\Bookmark $bookmark
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\User $user
 */
class Comment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'content' => true,
        'bookmark_id' => true,
        'parentcomment' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'bookmark' => true,
        'comments' => true,
        'user' => true
    ];
}
