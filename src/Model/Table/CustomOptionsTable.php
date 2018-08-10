<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomOptions Model
 *
 * @method \App\Model\Entity\CustomOption get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomOption newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CustomOption[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomOption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomOption[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomOption findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomOptionsTable extends Table
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

        $this->setTable('custom_options');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('option_details')
            ->allowEmpty('option_details');

        $validator
            ->integer('option_current_coin_value')
            ->requirePresence('option_current_coin_value', 'create')
            ->notEmpty('option_current_coin_value');

        return $validator;
    }
}
