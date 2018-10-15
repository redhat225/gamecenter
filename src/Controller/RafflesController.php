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
class RafflesController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->loadModel('Gamers');
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
                try{
                    $data = $this->request->data;
                    $data['action'] = 'create';
                    $account_uuid = $this->request->session()->read('Auth.User.id');
                    $data['creator'] = $account_uuid;
                    $gamer = $this->Gamers->find()->Where(['Gamers.gamer_is_active'=>true])
                                  ->order('rand()')->firstOrFail();
                    if($gamer){
                        $data['gamer_id'] = $gamer->id;
                        $raffle = $this->Raffles->newEntity($data);
                        $gamer->raffle = $raffle->raffle_identity;
                        if($this->Raffles->save($raffle)){
                             $this->RequestHandler->renderAs($this,'json');
                             $this->set(compact('gamer'));
                             $this->set('_serialize',['gamer']); 
                        }
                    }else
                        throw new Exception\BadRequestException(__('Create Raffle Exception 2'));
                }catch(MainException $e){
                    throw new Exception\BadRequestException(__('Create Raffle Exception 1'));
                }

            }
        }
    }

    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $raffles = $this->Raffles->find()->contain(['Gamers','UserAccounts.Users'])->order(['Raffles.created'=>'desc']);
                if($raffles){
                    $this->RequestHandler->renderAs($this,'json');
                    $this->set(compact('raffles'));
                    $this->set('_serialize',['raffles']);
                }else
                    throw new Exception\BadRequestException(__('all exception raffles 1'));
            }
        }
    }

}
