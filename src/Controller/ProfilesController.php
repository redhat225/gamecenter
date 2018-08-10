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
class ProfilesController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->loadModel('UserAccounts');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function index(){
    }

    public function view(){

    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                try{
                    $bulk_profile = $this->request->data['profile'];
                    $bulk_profile['action'] = 'edit-profile';
                    $profile = $this->UserAccounts->get($this->request->session()->read('Auth.User.id'));
                    $bulk_profile['old_password'] = $profile->password; 
                    $profile = $this->UserAccounts->patchEntity($profile,$bulk_profile,['fieldList'=>['username','user_avatar','password','user_account_avatar_candidate']]);
                    $profile->user_is_active = true;

                    if(!$profile->errors()){
                        if($this->UserAccounts->save($profile)){
                                $response = ['message' => 'ok'];
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']); 
                        }else{
                          throw new Exception\BadRequestException(__('bad request create 3'));
                        }
                    }else
                     throw new Exception\BadRequestException(__('bad request create 2'));
                }catch(MainException $e){
                  throw new Exception\BadRequestException(__('bad request create 1'));
                }
            }
        }
    }

    public function get(){
            if($this->request->is('get')){
                $account_uuid = $this->request->session()->read('Auth.User.id');
                $profile = $this->UserAccounts->get($account_uuid,['contain'=>['Users','Roles']]);
                $this->RequestHandler->renderAs($this, 'json');
                $this->set(compact('profile'));
                $this->set('_serialize',['profile']); 
            }
    }


}
