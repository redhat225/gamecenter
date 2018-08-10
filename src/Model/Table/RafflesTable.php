<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
use Cake\Utility\Text;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\File;
use Cake\Network\Exception;
use Cake\ORM\TableRegistry;

/**
 * Raffles Model
 *
 * @property \App\Model\Table\GamersTable|\Cake\ORM\Association\BelongsTo $Gamers
 *
 * @method \App\Model\Entity\Raffle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Raffle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Raffle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Raffle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Raffle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Raffle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Raffle findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RafflesTable extends Table
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

        $this->setTable('raffles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Gamers', [
            'foreignKey' => 'gamer_id'
        ]);

        $this->belongsTo('UserAccounts', [
            'foreignKey' => 'created_by'
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
            ->uuid('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->scalar('raffle_details')
            ->requirePresence('raffle_details', 'create')
            ->notEmpty('raffle_details');

        $validator
            ->scalar('raffle_identity')
            ->maxLength('raffle_identity', 100)
            ->requirePresence('raffle_identity', 'create')
            ->notEmpty('raffle_identity');

        return $validator;
    }


   public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action']){
                case 'create':
                    $data['created_by'] = $data['creator'];
                    $Raffles = TableRegistry::get('Raffles');
                    $raffle_count = $Raffles->find()->count();
                    $format_date = new \DateTime('NOW');
                    $formatted_date = $format_date->format('mY');
                    $data['raffle_identity'] = 'T-'.$formatted_date.'-'.($raffle_count+1);
                break;
            }
        }
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
        $rules->add($rules->existsIn(['gamer_id'], 'Gamers'));

        return $rules;
    }
}
