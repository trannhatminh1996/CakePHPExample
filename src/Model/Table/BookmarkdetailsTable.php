<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bookmarkdetails Model
 *
 * @property \App\Model\Table\BookmarksTable|\Cake\ORM\Association\BelongsTo $Bookmarks
 *
 * @method \App\Model\Entity\Bookmarkdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bookmarkdetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bookmarkdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bookmarkdetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bookmarkdetail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bookmarkdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bookmarkdetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bookmarkdetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BookmarkdetailsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('bookmarkdetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Bookmarks', [
            'foreignKey' => 'bookmark_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['bookmark_id'], 'Bookmarks'));

        return $rules;
    }
}
