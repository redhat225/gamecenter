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
use Cake\Datasource\EntityInterface;
use Cake\Network\Exception;
use Cake\ORM\TableRegistry;
use \Exception as MainException;
/**
 * GamerTransits Model
 *
 * @property \App\Model\Table\UserAccountsTable|\Cake\ORM\Association\BelongsTo $UserAccounts
 * @property \App\Model\Table\GamerCardsTable|\Cake\ORM\Association\BelongsTo $GamerCards
 * @property \App\Model\Table\GamerTransitTracesTable|\Cake\ORM\Association\HasMany $GamerTransitTraces
 *
 * @method \App\Model\Entity\GamerTransit get($primaryKey, $options = [])
 * @method \App\Model\Entity\GamerTransit newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GamerTransit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GamerTransit|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GamerTransit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GamerTransit[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GamerTransit findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GamerTransitsTable extends Table
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

        $this->setTable('gamer_transits');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('UserAccounts', [
            'foreignKey' => 'user_account_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('GamerCards', [
            'foreignKey' => 'gamer_card_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('GamerTransitTraces', [
            'foreignKey' => 'gamer_transit_id'
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
            ->scalar('transit_identity')
            ->maxLength('transit_identity', 100)
            ->requirePresence('transit_identity', 'create')
            ->notEmpty('transit_identity')
            ->add('transit_identity', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('transit_amount')
            ->requirePresence('transit_amount', 'create')
            ->notEmpty('transit_amount');

      $validator
            ->boolean('transit_is_active')
            ->requirePresence('transit_is_active', 'create')
            ->notEmpty('transit_is_active');

        $validator
            ->integer('transit_value')
            ->requirePresence('transit_value', 'create')
            ->notEmpty('transit_value');

        $validator
            ->integer('transit_coins')
            ->requirePresence('transit_coins', 'create')
            ->notEmpty('transit_coins');

        $validator
            ->integer('transit_bonus')
            ->allowEmpty('transit_bonus');

        return $validator;
    }


   public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action']){
                case 'create':
                    // get coin value
                    $OptionsTable = TableRegistry::get('CustomOptions');
                    $option = $OptionsTable->find()->first();
                    $data['transit_value'] = $option->option_current_coin_value;
                    $data['transit_coins'] =intval(ceil($data['transit_amount']/ $data['transit_value']));
                    $date = new \DateTime('NOW');
                    $data['transit_is_active'] = true;
                    $TransitTable = TableRegistry::get('GamerTransits');
                    $transit_count = $TransitTable->find()->count();
                    $data['transit_identity'] = 'P-'.$date->format('mY').'-'.($transit_count+1);
                    // get last cardId for current gamer
                    $GamerCardTable = TableRegistry::get('GamerCards');
                    $last_card_id = $GamerCardTable->find()->where(['gamer_id'=>$data['gamer_id']])->order(['created'=>'desc'])->select(['id'])->first();
                    // count transits
                    $transits = $TransitTable->find()->where(['gamer_card_id'=>$last_card_id->id,'transit_is_active'=>true])->count();

                    $data['user_account_id'] = $data['creator'];
                    $data['gamer_card_id'] = $last_card_id->id;
                    // trace types ['create','update','delete']
                    $traces = [
                        'trace_type' => 'create',
                        'trace_info' => "Ajout d'un passage de ".$data['transit_amount'].' FCFA  équivalent à '.($data['transit_coins']).' jeton(s)',
                        'created_by' => $data['creator']
                    ];

                    $data['gamer_transit_traces'] = [
                        $traces
                    ];

                    $data['transit_extra_info'] = [
                        'transit_sum' => $transits,
                        'gamer_id' => $data['gamer_id'],
                        'created_by' => $data['creator'],
                    ];

                    switch($transits){
                        case 11:
                            throw new Exception\ForbiddenException(__('max transits reached'));
                        break;

                        case 10:
                            // bonus
                            $query_transits = $TransitTable->find();
                            $result_transit_query = $query_transits->select(['total_amount'=>$query_transits->func()->sum('transit_amount')])->where(['gamer_card_id'=>$last_card_id->id,'transit_is_active'=>true])->toArray()[0];

                            if($result_transit_query->total_amount!=null){
                                 if($result_transit_query->total_amount >= 10000){
                                       $bonus = intval(ceil((0.15*($result_transit_query->total_amount+$data['transit_amount']))/$option->option_current_coin_value));
                                    $data['transit_bonus'] = $bonus;
                                 }else{
                                     $data['transit_bonus'] = null;
                                 }
                            }
                            else{
                             $data['transit_bonus'] = null;
                            }

                            $data['deleted'] = true;
                        break;

                        default:

                        break;
                    }
                break;

                case 'update':
                    // make calculations on new value
                    try{
                        $data['transit_coins'] = intval(ceil($data['transit_amount']/$data['old_current_value']));

                        $traces = [
                            'trace_type' => 'update',
                            'created_by' => $data['creator'],
                            'trace_info' => "Modification du passage de ".$data['old_transit_value']." F CFA équivalent à ".$data['old_transit_coins']." jeton(s) à ".$data['transit_amount']." F CFA équivalent à ".$data['transit_coins']." jeton(s)"
                        ];

                        $data['gamer_transit_traces'] = [
                            $traces
                        ];
                    }catch(MainException $e){
                        throw new Exception\ForbiddenException(__('forbidden exception 1'));
                    }
                break;

                case 'cancel':
                    // make calculations on new value
                    $data['transit_coins'] = intval(ceil($data['transit_amount']/$data['old_current_value']));
                    try{
                        $traces = [
                            'trace_type' => 'cancel',
                            'created_by' => $data['creator'],
                            'trace_info' => "Annulation du passage de ".$data['old_transit_value']." F CFA équivalent à ".$data['old_transit_coins']." jeton(s) à"
                        ];

                        $data['gamer_transit_traces'] = [
                            $traces
                        ];
                    }catch(MainException $e){
                        throw new Exception\ForbiddenException(__('forbidden exception 1'));
                    }
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
        $rules->add($rules->isUnique(['transit_identity']));
        $rules->add($rules->existsIn(['user_account_id'], 'UserAccounts'));
        $rules->add($rules->existsIn(['gamer_card_id'], 'GamerCards'));

        return $rules;
    }

    public function beforeSave(Event $event,EntityInterface $entity,ArrayObject $options){
        if($entity->isNew()){
            switch($entity->transit_extra_info['transit_sum']){
                case 10:
                    // register a new card
                    $CardsTable = TableRegistry::get('GamerCards');
                    $gamer_count = $CardsTable->find()->count();
                    $format_date = new \DateTime('NOW');
                    $formatted_date = $format_date->format('mY');
                    
                    $data = [
                        'gamer_id' => $entity->transit_extra_info['gamer_id'],
                        'created_by' => $entity->transit_extra_info['created_by'],
                        'card_identity' => 'GC-'.$formatted_date.'-'.($gamer_count+1)
                    ];

                    $card = $CardsTable->newEntity($data);

                    if($CardsTable->save($card))
                    {
                        return true;
                    }else{
                        debug($card->errors());
                        throw new Exception\ForbiddenException(__('new card creation failed'));
                    }

                break;

                default:

                break;
            }

        }
    }
}
