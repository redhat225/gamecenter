<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Network\Exception;
use \Exception as MainException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Cache\Cache;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class AccountsController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('UserAccounts');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function index(){
    }

    public function view(){

    }

    public function create(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $data['action'] = 'create';
                $account_uuid = $this->request->session()->read('Auth.User.id');

                $data['creator'] = $account_uuid;
                $account = $this->Users->newEntity($data,['associated'=>'UserAccounts']);
                if($account->errors())
                    throw new Exception\BadRequestException(__('bad request 1'));
                else{
                    if($this->Users->save($account)){
                        if($this->updateCacheUsers()){
                            $this->RequestHandler->renderAs($this, 'json');
                            $response = ['message'=>'ok'];
                            $this->set(compact('response'));
                            $this->set('_serialize',['response']);
                        }
                    }else
                    throw new Exception\BadRequestException(__('bad request 2'));
                }
            }
        }
    }

    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                 if(($users = Cache::read('users','users_all')) === false ){
                    if($this->updateCacheUsers()){
                                $users = json_decode(Cache::read('users','users_all'));
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('users'));
                                $this->set('_serialize',['users']); 
                    }else
                    throw new Exception\BadRequestException(__('crossing all request cache exception'));
                }else{
                    // if($this->updateCacheUsers()){
                    $users = json_decode(Cache::read('users','users_all'));
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('users'));
                    $this->set('_serialize',['users']); 
                    // }
                 }

            }
        }
    }



    public function retrieve(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $page = $this->request->query['page'];
                if(($users = Cache::read('users','users_all')) === false ){
                    if($this->updateCacheUsers()){
                                $users = json_decode(Cache::read('users','users_all'));
                                $users_count = (ceil((count($users))/10));
                                $users = $this->spliceUsers($users,$page);
                                if($users!==false){
                                   $this->RequestHandler->renderAs($this, 'json');
                                   $this->set(compact('users','users_count'));
                                   $this->set('_serialize',['users','users_count']);
                                }else
                                    throw new Exception\BadRequestException(__('crossing get cache I error'));
                    }else
                    throw new Exception\BadRequestException(__('crossing get request cache exception'));
                }else{
                    $users = json_decode(Cache::read('users','users_all'));
                    $users_count = (ceil((count($users))/10));
                    $users = $this->spliceUsers($users,$page);
                    if($users!==false){
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('users','users_count'));
                        $this->set('_serialize',['users','users_count']);
                    }else
                       throw new Exception\BadRequestException(__('crossing get cache II error'));
                }
            }
        }
    }

    private function spliceUsers($users,$page){
        try{
            $static_max_row = 10;
            $max_val = $page*$static_max_row;
            $min_val = $max_val-$static_max_row;
            return array_splice($users,$min_val,$max_val);
        }catch(MainException $e){
            return false;
        }
    }

    private function updateCacheUsers(){
                    try{
                          $users = $this->Users->find()->contain(['UserAccounts.Roles'])
                                             ->Where(['user_email != '=>'riehlemm@gmail.com']);
                          if($users){
                            Cache::write('users',json_encode($users),'users_all');
                            return true;
                          }else{
                            Cache::write('users','','users_all');
                            return false;
                          }
                    }catch(MainException $e){
                        throw new Exception\BadRequestException(__('cache exception'));
                    }
    }




    public function lock(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $id = $this->request->data['id'];
                $user_account = $this->UserAccounts->get($id);
                if($user_account){
                        $user_account->user_is_active = false;
                        if($this->UserAccounts->save($user_account)){
                             if($this->updateCacheUsers()){
                                    $this->RequestHandler->renderAs($this, 'json');
                                    $response = ['message'=>'ok'];
                                    $this->set(compact('response'));
                                    $this->set('_serialize',['response']); 
                             }

                        }else{
                            throw new Exception\BadRequestException(__('lock request 2'));
                        }

                }else
                  throw new Exception\BadRequestException(__('lock request 1'));
            }

        }
    }

    public function unlock(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $id = $this->request->data['id'];
                $user_account = $this->UserAccounts->get($id);
                if($user_account){
                        $user_account->user_is_active = true;
                        if($this->UserAccounts->save($user_account)){
                            if($this->updateCacheUsers()){
                                $this->RequestHandler->renderAs($this, 'json');
                                $response = ['message'=>'ok'];
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']);
                            }
                        }else{
                            throw new Exception\BadRequestException(__('unlock request 2'));
                        }
                }else
                  throw new Exception\BadRequestException(__('unlock request 1'));
            }

        }
    }


 public function reset(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $id = $this->request->data['id'];
                $user_account = $this->UserAccounts->get($id);
                if($user_account){
                      try{
                        $user_account->password = 'Gamecenter@2018++';
                        if($this->UserAccounts->save($user_account)){
                            if($this->updateCacheUsers()){
                                $this->RequestHandler->renderAs($this, 'json');
                                $response = ['message'=>'ok'];
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']); 
                            }
                        }else{
                            throw new Exception\BadRequestException(__('unlock request 2'));
                        }
                      }catch(MainException $e){
                            throw new Exception\BadRequestException(__('reset request 2'));
                      }
                }else
                  throw new Exception\BadRequestException(__('unlock request 1'));
            }

        }
    }


 public function get(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $id = $this->request->data['id'];
                $user = $this->Users->get($id,['contain'=>['UserAccounts']]);
                if($user){
                            $this->RequestHandler->renderAs($this, 'json');
                            $this->set(compact('user'));
                            $this->set('_serialize',['user']); 
                }else
                  throw new Exception\BadRequestException(__('get user request 1'));
            }
            if($this->request->is('get')){

            }

        }
    }


 public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $this->request->data['profile']['action'] = 'edit-admin'; 
                $user = $this->Users->patchEntity($this->Users->get($this->request->data['profile']['id'],['contain'=>['UserAccounts']]),$this->request->data['profile'],[
                        'fieldList' => ['user_fullname','user_sexe','user_email','user_contact','user_job','user_accounts','user_photo_candidate'],
                        'associated' => ['UserAccounts'=>['fieldList'=>['username','role_id']]]
                ]);
                if(!$user->errors()){
                    if($this->Users->save($user)){
                            if($this->updateCacheUsers()){
                                $response =['message'=>'ok'];
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']); 
                            }
                    }else
                      throw new Exception\BadRequestException(__('bad edit request 2'));
                }else
                  throw new Exception\BadRequestException(__('bad edit request 1'));
            }

            if($this->request->is('get')){

            }

        }
    }

}
