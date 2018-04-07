<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\UserAccountsTable|\Cake\ORM\Association\HasMany $UserAccounts
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('UserAccounts', [
            'foreignKey' => 'user_id'
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
            ->scalar('user_fullname')
            ->maxLength('user_fullname', 100)
            ->requirePresence('user_fullname', 'create')
            ->notEmpty('user_fullname');

        $validator
            ->scalar('user_sexe')
            ->maxLength('user_sexe', 1)
            ->requirePresence('user_sexe', 'create')
            ->notEmpty('user_sexe');

        $validator
            ->scalar('user_email')
            ->maxLength('user_email', 100)
            ->requirePresence('user_email', 'create')
            ->notEmpty('user_email')
            ->add('user_email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('user_photo')
            ->requirePresence('user_photo', 'create')
            ->notEmpty('user_photo');

        $validator
            ->scalar('user_contact')
            ->maxLength('user_contact', 8)
            ->requirePresence('user_contact', 'create')
            ->notEmpty('user_contact');

        $validator
            ->scalar('user_job')
            ->requirePresence('user_job', 'create')
            ->notEmpty('user_job');

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
        $rules->add($rules->isUnique(['user_email']));

        return $rules;
    }
}
