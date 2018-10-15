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
class GamersController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->loadModel('Gamers');
        $this->loadModel('GamerCards');
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
                    $gamer = $this->request->data['gamer'];
                    $gamer['action'] = 'create';
                    $account_uuid = $this->request->session()->read('Auth.User.id');
                    $gamer['created_by'] = $account_uuid;

                    $gamer = $this->Gamers->newEntity($gamer,['associated'=>['GamerCards']]);
                    if(!$gamer->errors()){
                        if($this->Gamers->save($gamer)){
                            if($this->updateCache()){
                                $response = ['message' => 'ok'];
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']); 
                            }else
                              throw new Exception\BadRequestException(__('cache create exception'));
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

    public function suppressCurrentCard(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                try{
                    $gamer = $this->request->data['gamer'];
                    $gamer['action'] = 'suppress-current-card';
                    $account_uuid = $this->request->session()->read('Auth.User.id');
                    $gamer['created_by'] = $account_uuid;
                    unset($gamer['created']);
                    unset($gamer['modified']);
                    $gamer_card = $this->GamerCards->newEntity($gamer);
                    if(!$gamer_card->errors()){
                        if($this->GamerCards->save($gamer_card)){
                            if($this->updateCache()){
                                $response = ['message' => 'ok'];
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']); 
                            }else
                              throw new Exception\BadRequestException(__('cache create exception'));
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


    public function raffles(){

    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                try{

                    $id_gamer = $this->request->data['gamer']['id'];
                    $bulk_gamer = $this->request->data['gamer'];
                    $gamer = $this->Gamers->get($id_gamer);
                    $bulk_gamer['action'] = 'update-admin';
                    $gamer = $this->Gamers->patchEntity($gamer,$bulk_gamer,['fieldList'=>['gamer_fullname','gamer_day_birth','gamer_month_birth','gamer_category','gamer_details']]);

                    if(!$gamer->errors()){
                        if($this->Gamers->save($gamer)){
                            if($this->updateCache()){
                                $response = ['message' => 'ok'];
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']); 
                            }else
                             throw new Exception\BadRequestException(__('cache exception edit'));
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

    public function lock(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $id = $this->request->data['gamer_id'];
                $gamer = $this->Gamers->get($id);
                if($gamer){
                        $gamer->gamer_is_active = false;
                        if($this->Gamers->save($gamer)){
                            if($this->updateCache()){
                                $this->RequestHandler->renderAs($this, 'json');
                                $response = ['message'=>'ok'];
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']); 
                            }else{
                               throw new Exception\BadRequestException(__('cache lock exception'));
                            }

                        }else{
                            throw new Exception\BadRequestException(__('lock request 2'));
                        }

                }else
                  throw new Exception\BadRequestException(__('lock request 1'));
            }

        }
    }

    private function updateCache(){
                    try{
                        $gamers = $this->Gamers->find()->contain(['GamerCards'=>function($q){
                            return $q->order(['GamerCards.created'=>'desc']);
                        },'GamerCards.GamerTransits'=>function($q){
                            return $q->order(['GamerTransits.created'=>'asc']);
                        },'GamerCards.GamerTransits.GamerTransitTraces.UserAccounts.Users','GamerCards.GamerTransits.UserAccounts.Users']);
                          if($gamers){
                            Cache::write('gamers',json_encode($gamers),'gamers_all');
                            return true;
                          }else{
                            Cache::write('gamers','','gamers_all');
                            return false;
                          }
                    }catch(MainException $e){
                        throw new Exception\BadRequestException(__('cache exception'));
                    }
    }

    public function unlock(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $id = $this->request->data['gamer_id'];
                $gamer = $this->Gamers->get($id);
                if($gamer){
                        $gamer->gamer_is_active = true;
                        if($this->Gamers->save($gamer)){
                            if($this->updateCache()){
                                $this->RequestHandler->renderAs($this, 'json');
                                $response = ['message'=>'ok'];
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']); 
                            }else
                              throw new Exception\BadRequestException(__('cache unlock exception'));
                        }else{
                            throw new Exception\BadRequestException(__('lock request 2'));
                        }

                }else
                  throw new Exception\BadRequestException(__('lock request 1'));
            }

        }
    }

    public function get(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                try{
                    $id_gamer = $this->request->data['gamer'];
                    $gamer = $this->Gamers->get($id_gamer);
                    if($gamer){
                            $this->RequestHandler->renderAs($this, 'json');
                            $this->set(compact('gamer'));
                            $this->set('_serialize',['gamer']);
                    }else
                      throw new Exception\BadRequestException(__('bad request create 2'));
                }catch(MainException $e){
                  throw new Exception\BadRequestException(__('bad request create 1'));
                }
            }
        }
    }

    public function update(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                try{
                    $gamer = $this->request->data['gamer'];
                    $gamer_or = $this->Gamers->get($gamer['id']);
                    $gamer['action'] = 'update-admin';
                    $gamer_or = $this->Gamers->patchEntity($gamer_or,$gamer,['fieldList'=>['gamer_fullnamer','gamer_day_birth','gamer_month_birth','gamer_category','gamer_details']]);
                    if($this->Gamers->save($gamer_or)){
                        if($this->updateCache()){
                            $this->RequestHandler->renderAs($this, 'json');
                            $this->set(compact('gamer'));
                            $this->set('_serialize',['gamer']);
                        }else
                         throw new Exception\BadRequestException(__('cache exception update 3'));
                    }else
                      throw new Exception\BadRequestException(__('cache exception update 2'));
                }catch(MainException $e){
                  throw new Exception\BadRequestException(__('cache exception update 1'));
                }
            }
        }
    }



    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                // check in cache
                if(($gamers = Cache::read('gamers','gamers_all')) === false ){
                            if($this->updateCache()){
                                $gamers = json_decode(Cache::read('gamers','gamers_all'));
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('gamers'));
                                $this->set('_serialize',['gamers']); 
                            }else
                              throw new Exception\BadRequestException(__('cache exception all'));
                        }else{
                            // if($this->updateCache()){
                                $gamers = json_decode(Cache::read('gamers','gamers_all'));
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('gamers'));
                                $this->set('_serialize',['gamers']); 
                            // }
                }

            }
        }
    }

    public function refreshCache(){
                            if($this->updateCache()){
                                $gamers = json_decode(Cache::read('gamers','gamers_all'));
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('gamers'));
                                $this->set('_serialize',['gamers']);
                            }else
                             throw new Exception\BadRequestException(__('cache refresh 3 exception'));
    }

    public function retrieve(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $page = $this->request->query['page'];
                if(($gamers = Cache::read('gamers','gamers_all')) === false ){
                    if($this->updateCachegamers()){
                                $gamers = json_decode(Cache::read('gamers','gamers_all'));
                                $gamers_count = (ceil((count($gamers))/30));
                                $gamers = $this->spliceGamers($gamers,$page);
                                if($gamers!==false){
                                   $this->RequestHandler->renderAs($this, 'json');
                                   $this->set(compact('gamers','gamers_count'));
                                   $this->set('_serialize',['gamers','gamers_count']);
                                }else
                                    throw new Exception\BadRequestException(__('crossing get cache I error'));
                    }else
                    throw new Exception\BadRequestException(__('crossing get request cache exception'));
                }else{
                    $gamers = json_decode(Cache::read('gamers','gamers_all'));
                    $gamers_count = (ceil((count($gamers))/30));
                    $gamers = $this->spliceGamers($gamers,$page);
                    if($gamers!==false){
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('gamers','gamers_count'));
                        $this->set('_serialize',['gamers','gamers_count']);
                    }else
                       throw new Exception\BadRequestException(__('crossing get cache II error'));
                }
            }
        }
    }

    private function spliceGamers($gamers,$page){
        try{
            $static_max_row = 30;
            $max_val = $page*$static_max_row;
            $min_val = $max_val-$static_max_row;
            return array_splice($gamers,$min_val,$max_val);
        }catch(MainException $e){
            return false;
        }
    }



}
