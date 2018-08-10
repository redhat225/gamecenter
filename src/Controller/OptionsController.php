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
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class OptionsController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->loadModel('CustomOptions');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function index(){
    }

    public function view(){

    }
    
    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $custom_options = $this->CustomOptions->find();
                $this->RequestHandler->renderAs($this,'json');
                $this->set(compact('custom_options'));
                $this->set('_serialize',['custom_options']);
            }
        }
    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data['options'];
                $custom_options  = $this->CustomOptions->get($data['id']);
                $custom_options  = $this->CustomOptions->patchEntity($custom_options,$data,['fieldList'=>['option_current_coin_value','option_details']]);
                if($this->CustomOptions->save($custom_options)){
                    $response = ['message'=>'ok'];
                    $this->RequestHandler->renderAs($this,'json');
                    $this->set(compact('response'));
                    $this->set('_serialize',['response']);
                }else
                  throw new Exception\BadRequestException(__('edit exception'));

            }
        }
    }

    public function get(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $options = $this->CustomOptions->find()->first();
                $this->RequestHandler->renderAs($this,'json');
                $this->set(compact('options'));
                $this->set('_serialize',['options']);
            }
        }   
    }

}
