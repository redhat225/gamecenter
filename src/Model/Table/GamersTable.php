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
 * Gamers Model
 *
 * @property \App\Model\Table\GamerCardsTable|\Cake\ORM\Association\HasMany $GamerCards
 * @property \App\Model\Table\RafflesTable|\Cake\ORM\Association\HasMany $Raffles
 *
 * @method \App\Model\Entity\Gamer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gamer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Gamer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gamer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gamer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gamer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gamer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GamersTable extends Table
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

        $this->setTable('gamers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('GamerCards', [
            'foreignKey' => 'gamer_id'
        ]);
        $this->hasMany('Raffles', [
            'foreignKey' => 'gamer_id'
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
            ->scalar('gamer_identity')
            ->maxLength('gamer_identity', 100)
            ->requirePresence('gamer_identity', 'create')
            ->notEmpty('gamer_identity')
            ->add('gamer_identity', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('gamer_fullname')
            ->maxLength('gamer_fullname', 100)
            ->requirePresence('gamer_fullname', 'create')
            ->notEmpty('gamer_fullname');

        $validator
            ->integer('gamer_day_birth')
            ->requirePresence('gamer_day_birth', 'create')
            ->notEmpty('gamer_day_birth');

        $validator
            ->integer('gamer_month_birth')
            ->requirePresence('gamer_month_birth', 'create')
            ->notEmpty('gamer_month_birth');

        $validator
            ->scalar('gamer_category')
            ->maxLength('gamer_category', 100)
            ->requirePresence('gamer_category', 'create')
            ->notEmpty('gamer_category');

        $validator
            ->scalar('gamer_details')
            ->requirePresence('gamer_details', 'create')
            ->notEmpty('gamer_details');

        $validator
            ->boolean('gamer_is_active')
            ->requirePresence('gamer_is_active', 'create')
            ->notEmpty('gamer_is_active');

        $validator
            ->uuid('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }


   public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action']){
                case 'create':
                    $data['gamer_details'] = json_encode($data['gamer_details']);
                    $data['gamer_fullname'] = strtoupper($data['gamer_fullname']);
                    $Gamers = TableRegistry::get('Gamers');
                    $GamerCards = TableRegistry::get('GamerCards');

                    $gamer_count = $Gamers->find()->count();
                    $gamer_card_count = $GamerCards->find()->count();
                    $format_date = new \DateTime('NOW');
                    $formatted_date = $format_date->format('Y');
                    $data['gamer_identity'] = 'GC-'.$formatted_date.'-'.($gamer_count+1);
                    $data['gamer_is_active'] = true;

                    $gamer_cards = [
                        'card_identity' => 'GC-'.$format_date->format('mY').'-'.($gamer_card_count+1),
                        'created_by' => $data['created_by']
                    ];

                    $data['gamer_cards'] = [
                        $gamer_cards
                    ];
                break;

                case 'update-admin':
                    $data['gamer_details'] = json_encode($data['gamer_details']);
                    $data['gamer_fullname'] = strtoupper($data['gamer_fullname']);
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
        $rules->add($rules->isUnique(['gamer_identity']));

        return $rules;
    }
}
