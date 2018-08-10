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

        $validator
            ->requirePresence('user_photo_candidate', 'create')
            ->add('user_photo_candidate', 'file', [
                'rule' => ['mimeType', ['image/jpeg','image/jpg','image/png','image/bitmap','image/gif']],
                'on' => function($context) {
                    return !empty($context['user_photo_candidate']);
                }
            ])
            ->add('user_photo_candidate', 'fileSize',[
                'rule' => ['fileSize', '<', '3MB'],
                'on' => function($context) {
                    return !empty($context['user_photo_candidate']);
                }
            ]);

        return $validator;
    }

   public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action']){
                case 'create':
                    $data['user_photo'] = Text::uuid();
                    $data['user_fullname'] = strtoupper($data['user_fullname']);
                    // create account
                    $account = $data['account'];
                    $account['user_is_active'] = true;
                    $account['created_by'] = $data['creator'];
                    $account['user_avatar'] = 'default_avatar.jpg';
                    $account['password'] = 'Gamecenter@2018+';
                        $data['user_accounts'] = [
                            $account
                        ];
                break;

                case 'edit-admin':
                
                if($data['user_accounts'][0]['user_is_active']=='true')
                    $data['user_accounts'][0]['user_is_active'] = true;
                else
                    $data['user_accounts'][0]['user_is_active'] = false;
                    
                break;
            }
        }
   }



    public function beforeSave($event, $entity, $options){
        if($entity->isNew())
        {
            //save profile photo
            $target = Text::uuid().'.'.strtolower(pathinfo($entity->user_photo_candidate['name'],PATHINFO_EXTENSION));
            if(move_uploaded_file($entity->user_photo_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/photo/'.$target))
            {
                //assign right value to user_photo
                $entity->user_photo = $target;
            }else
              return false;
        }else
        {
            if(isset($entity->user_photo_candidate) && $entity->user_photo_candidate!=='null')
            {
                  //replace photo
                $old_path_photo = WWW_ROOT.'img/assets/admins/photo/'.$entity->user_photo;
                  if(file_exists($old_path_photo))
                       unlink($old_path_photo);
                   $target = Text::uuid().'.'.strtolower(pathinfo($entity->user_photo_candidate['name'],PATHINFO_EXTENSION));
                    if(move_uploaded_file($entity->user_photo_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/photo/'.$target))
                    {
                        //assign right value to user_photo
                        $entity->user_photo = $target;
                    }else
                      return false;
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
        $rules->add($rules->isUnique(['user_email']));

        return $rules;
    }
}
