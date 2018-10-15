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
 * GamerCards Model
 *
 * @property \App\Model\Table\GamersTable|\Cake\ORM\Association\BelongsTo $Gamers
 * @property \App\Model\Table\GamerTransitsTable|\Cake\ORM\Association\HasMany $GamerTransits
 *
 * @method \App\Model\Entity\GamerCard get($primaryKey, $options = [])
 * @method \App\Model\Entity\GamerCard newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GamerCard[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GamerCard|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GamerCard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GamerCard[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GamerCard findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GamerCardsTable extends Table
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

        $this->setTable('gamer_cards');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Gamers', [
            'foreignKey' => 'gamer_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('GamerTransits', [
            'foreignKey' => 'gamer_card_id'
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
            ->scalar('card_identity')
            ->maxLength('card_identity', 100)
            ->requirePresence('card_identity', 'create')
            ->notEmpty('card_identity')
            ->add('card_identity', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->uuid('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        return $validator;
    }

  public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action']){
                case 'suppress-current-card':
                    $GamerCards = TableRegistry::get('GamerCards');
                    $gamer_card_count = $GamerCards->find()->count();
                    $format_date = new \DateTime('NOW');
                    $formatted_date = $format_date->format('Y');
                    $data['gamer_id'] = $data['id'];
                    $data['card_identity'] = 'GC-'.$format_date->format('mY').'-'.($gamer_card_count+1);
                    $data['created_by'] = $data['created_by'];
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
        $rules->add($rules->isUnique(['card_identity']));
        $rules->add($rules->existsIn(['gamer_id'], 'Gamers'));

        return $rules;
    }
}
