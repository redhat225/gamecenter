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
class CrossingsController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->loadModel('GamerTransits');
        $this->loadModel('GamerCards');
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
                $data = $this->request->data['crossing'];
                $data['action'] = 'create';
                // verify gamer is off or on
                $gamer = $this->Gamers->get($data['gamer_id']);
                if($gamer->gamer_is_active){
                    // Treatment
                    $account_uuid = $this->request->session()->read('Auth.User.id');
                    $data['creator'] = $account_uuid;
                    $transit = $this->GamerTransits->newEntity($data,['associated'=>['GamerTransitTraces']]);
                    if(!$transit->errors()){
                        if($this->GamerTransits->save($transit)){
                            if($this->updateCacheCrossing()){
                                $response = ['message'=>'ok'];
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']);
                            }else
                              throw new Exception\BadRequestException(__('create exception 3'));
                        }else
                          throw new Exception\BadRequestException(__('create exception 2'));

                    }else
                        throw new Exception\BadRequestException(__('create exception 1'));
                }else
                    throw new Exception\BadRequestException(__('gamer canceled exception 1'));
            }
        }
    }

    public function cancel(){
       if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data['crossing'];
                // verify gamer is off or on
                $gamer = $this->GamerCards->get($data['gamer_card_id'],['contain'=>['Gamers']]);
                if($gamer->gamer->gamer_is_active){
                        $data['action'] = 'cancel';
                        $account_uuid = $this->request->session()->read('Auth.User.id');
                        $data['creator'] = $account_uuid;
                        $transit = $this->GamerTransits->get($data['id']);
                        $data['action'] = 'cancel';
                        $data['old_transit_value'] = $transit['transit_amount'];
                        $data['old_transit_coins'] = $transit['transit_coins'];
                        $data['old_current_value'] = $transit['transit_value'];

                        $transit = $this->GamerTransits->patchEntity($transit,$data,['associated'=>['GamerTransitTraces'=>['fieldList'=>['trace_type','trace_info','created_by']]],'fieldList'=>['transit_amount','transit_coins','gamer_transit_traces']]);

                        $transit->dirty('gamer_transit_traces',true);
                        $transit->transit_is_active = false;
                        
                        if(!$transit->errors()){
                            if($this->GamerTransits->save($transit)){
                                    if($this->updateCacheCrossing()){
                                        $response = ['message'=>'ok'];
                                        $this->RequestHandler->renderAs($this, 'json');
                                        $this->set(compact('response'));
                                        $this->set('_serialize',['response']);
                                    }else
                                      throw new Exception\BadRequestException(__('cache update exception 3'));
                            }else
                              throw new Exception\BadRequestException(__('update exception 2'));

                        }else
                            throw new Exception\BadRequestException(__('update exception 1'));
                }else
                    throw new Exception\BadRequestException(__('gamer canceled exception 1'));
            }
        }
    }

    public function update(){
       if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data['crossing'];
                $gamer = $this->GamerCards->get($data['gamer_card_id_mock'],['contain'=>['Gamers']]);
                if($gamer->gamer_is_active){
                        $data['action'] = 'update';
                        $account_uuid = $this->request->session()->read('Auth.User.id');
                        $data['creator'] = $account_uuid;
                        $transit = $this->GamerTransits->get($data['id']);
                        $data['action'] = 'update';
                        $data['old_transit_value'] = $transit['transit_amount'];
                        $data['old_transit_coins'] = $transit['transit_coins'];
                        $data['old_current_value'] = $transit['transit_value'];

                        $transit = $this->GamerTransits->patchEntity($transit,$data,['associated'=>['GamerTransitTraces'=>['fieldList'=>['trace_type','trace_info','created_by']]],'fieldList'=>['transit_amount','transit_coins','gamer_transit_traces']]);

                        $transit->dirty('gamer_transit_traces',true);
                        
                        if(!$transit->errors()){
                            if($this->GamerTransits->save($transit)){
                                    if($this->updateCacheCrossing()){
                                        $response = ['message'=>'ok'];
                                        $this->RequestHandler->renderAs($this, 'json');
                                        $this->set(compact('response'));
                                        $this->set('_serialize',['response']);
                                    }else
                                      throw new Exception\BadRequestException(__('cache update exception 3'));
                            }else
                              throw new Exception\BadRequestException(__('update exception 2'));

                        }else
                            throw new Exception\BadRequestException(__('update exception 1'));
                }else
                   throw new Exception\BadRequestException(__('gamer canceled exception 1'));

            }
        }
    }

    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                 if(($crossings = Cache::read('crossings','crossings_all')) === false ){
                    if($this->updateCacheCrossing()){
                                $crossings = json_decode(Cache::read('crossings','crossings_all'));
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('crossings'));
                                $this->set('_serialize',['crossings']); 
                    }else
                    throw new Exception\BadRequestException(__('crossing all request cache exception'));
                }else{
                    // if($this->updateCacheCrossing()){
                    $crossings = json_decode(Cache::read('crossings','crossings_all'));
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('crossings'));
                    $this->set('_serialize',['crossings']); 
                    // }
                 }

            }
        }
    }

    public function get(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $page = $this->request->query['page'];
                if(($crossings = Cache::read('crossings','crossings_all')) === false ){
                    if($this->updateCacheCrossing()){
                                $crossings = json_decode(Cache::read('crossings','crossings_all'));
                                $crossings_count = (ceil((count($crossings))/50));
                                $crossings = $this->spliceCrossing($crossings,$page);
                                if($crossings!==false){
                                   $this->RequestHandler->renderAs($this, 'json');
                                   $this->set(compact('crossings','crossings_count'));
                                   $this->set('_serialize',['crossings','crossings_count']);
                                }else
                                    throw new Exception\BadRequestException(__('crossing get cache I error'));
                    }else
                    throw new Exception\BadRequestException(__('crossing get request cache exception'));
                }else{
                    $crossings = json_decode(Cache::read('crossings','crossings_all'));
                    $crossings_count = (ceil((count($crossings))/50));
                    $crossings = $this->spliceCrossing($crossings,$page);
                    if($crossings!==false){
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('crossings','crossings_count'));
                        $this->set('_serialize',['crossings','crossings_count']);
                    }else
                       throw new Exception\BadRequestException(__('crossing get cache II error'));
 
                }
            }
        }
    }

    private function spliceCrossing($crossings,$page){
        try{
            $static_max_row = 50;
            $max_val = $page*$static_max_row;
            $min_val = $max_val-$static_max_row;
            return array_splice($crossings,$min_val,$max_val);
        }catch(MainException $e){
            return false;
        }
    }

    private function updateCacheCrossing(){
                    try{
                           $crossings = $this->GamerTransits->find()
                                                  ->contain(['GamerCards.Gamers','UserAccounts.Users'])
                                                  ->order(['GamerTransits.created'=>'desc']);
                          if($crossings){
                            Cache::write('crossings',json_encode($crossings),'crossings_all');
                            return true;
                          }else{
                            Cache::write('crossings','','crossings_all');
                            return false;
                          }
                    }catch(MainException $e){
                        throw new Exception\BadRequestException(__('cache exception'));
                    }
    }

    public function refreshCache(){

    }

}
