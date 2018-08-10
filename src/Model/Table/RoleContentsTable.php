<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoleContents Model
 *
 * @property |\Cake\ORM\Association\HasMany $RoleContentDynamics
 *
 * @method \App\Model\Entity\RoleContent get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoleContent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RoleContent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoleContent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoleContent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoleContent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoleContent findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RoleContentsTable extends Table
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

        $this->setTable('role_contents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('RoleContentDynamics', [
            'foreignKey' => 'role_content_id'
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('content_alias')
            ->maxLength('content_alias', 100)
            ->requirePresence('content_alias', 'create')
            ->notEmpty('content_alias');

        $validator
            ->scalar('content_action')
            ->maxLength('content_action', 100)
            ->requirePresence('content_action', 'create')
            ->notEmpty('content_action');

        $validator
            ->scalar('content_controller')
            ->maxLength('content_controller', 100)
            ->requirePresence('content_controller', 'create')
            ->notEmpty('content_controller');

        return $validator;
    }
}
