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
use Cake\Cache\Cache;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class AdminsController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->Auth->allow(['login','logout','forgot','tour']);
        if($this->request->session()->read('Auth')){
            if($this->request->is('ajax')){

            }else
            {
                if($this->request->params['_matchedRoute']!=="/admins/logout"){

                     $this->request->params['action'] = 'index';
                     $this->request->params['controller'] = 'Admins';
                }
            }
        }else{
            if($this->request->is('get')){
                if(!$this->Cookie->check('WelcomeTour')){
                    $this->Cookie->configKey('WelcomeTour','expires','1 month');
                    $this->Cookie->write('WelcomeTour','yes Man!!!');
                    return $this->redirect(['controller'=>'Admins','action'=>'tour']);
                }
            }
        }
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function index(){

    }


    public function tour(){
        $this->viewBuilder()->layout('tour');
    }

    public function login(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $user = $this->Auth->identify($data);
                if($user){
                    $jwt_data = $user;
                    $user = $this->Auth->setUser($user);
                    //generate jwt
                    $signer = new Sha256();
                    $key = Security::salt();
                    $current_time = time();

                    $jwt = (new Builder())->setIssuer($this->request->env('SERVER_NAME'))->setAudience($this->request->env('SERVER_NAME'))->setIssuedAt(time())
                        ->setExpiration($current_time + 3600)
                        ->set('data',$jwt_data)
                        ->sign($signer, $key)
                        ->getToken();
                    $jwt_generated = $jwt->getPayload();
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('jwt_generated'));
                    $this->set('_serialize',['jwt_generated']);
                }else
                  throw new Exception\ForbiddenException(__('forbidden'));
            }
        }else
        {
            $this->viewBuilder()->layout('login');
        }
    }

    public function options(){
        
    }

    public function home(){

    }

    public function dashboard(){
    }

    public function logout(){
        return $this->redirect($this->Auth->logout());
    }

}
