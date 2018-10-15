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
 * UserAccounts Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\UserAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserAccount findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserAccountsTable extends Table
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

        $this->setTable('user_accounts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->boolean('user_is_active')
            ->requirePresence('user_is_active', 'create')
            ->notEmpty('user_is_active');

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('username')
            ->maxLength('username', 100)
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('user_avatar')
            ->requirePresence('user_avatar', 'create')
            ->notEmpty('user_avatar');

        $validator
            ->uuid('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        //custom fields validation
        $validator
            ->add('user_account_avatar_candidate', 'file', [
                'rule' => ['mimeType', ['image/jpeg','image/jpg','image/png','image/bitmap','image/gif']],
                'on' => function($context){

                return (!empty($context['user_account_avatar_candidate'])|| !empty($context['data']['user_account_avatar_candidate']) );
                }
            ])->add('user_account_avatar_candidate', 'fileSize',[
                'rule' => ['fileSize', '<', '3MB'],
                'on' => function($context){
                    return (!empty($context['user_account_avatar_candidate']) || !empty($context['data']['user_account_avatar_candidate']));

                }
            ]);

        return $validator;
    }

  public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){

        if(isset($data['action'])){
            switch($data['action']){
                case 'create':

                break;

                case 'edit-profile':

                    if(isset($data['profile_accounts'])){
                        $account_credentials = $data['profile_accounts'][0];
                        $hasher = new DefaultPasswordHasher();
                        if($hasher->check($account_credentials['account_password_old'],$data['old_password']))
                            $data['password'] = $account_credentials['account_password_new'];
                        else
                            throw new Exception\ForbiddenException(__('forbidden'));
                    }

                break;

                case 'edit-admin':
                
                break;
            }
        }
   }

    public function beforeSave($event, $entity, $options){
        if($entity->isNew())
        {
            if(isset($entity->user_account_avatar_candidate))
            {
                //save profile photo
                $target = Text::uuid().'.'.strtolower(pathinfo($entity->user_account_avatar_candidate['name'],PATHINFO_EXTENSION));
                if(move_uploaded_file($entity->user_account_avatar_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/avatar/'.$target))
                {
                    //assign right value to user_account_avatar
                    $entity->user_account_avatar = $target;
                }else
                  return false;
            }

        }else
        {
            if(isset($entity->user_account_avatar_candidate) && $entity->user_account_avatar_candidate!=='null')
            {
                  //replace photo
                $old_path_photo = WWW_ROOT.'img/assets/admins/avatar/'.$entity->user_avatar;
                  if(file_exists($old_path_photo))
                       unlink($old_path_photo);
                   $target = Text::uuid().'.'.strtolower(pathinfo($entity->user_account_avatar_candidate['name'],PATHINFO_EXTENSION));
                    if(move_uploaded_file($entity->user_account_avatar_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/avatar/'.$target)){
                        //assign right value to user_account_avatar
                        $entity->user_avatar = $target;
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }

    public function findAuth(Query $query, array $options){
         $query->select(['id','username','password'])
               ->autoFields(true)
               ->contain(['Roles.RoleContents'])
               ->Where(['user_is_active'=>1]);
        return $query;
    }
}
