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
class DashboardController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->loadModel('Gamers');
        $this->loadModel('GamerTransits');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function general(){
    }

    public function monthly(){

    }

    public function today(){
          try{
                $now = new \DateTime('NOW');
                $formatted_date = $now->format('dm');
                
                $crossing_today_count = $this->GamerTransits->find()->Where(['DATE_FORMAT(created,"%d%m")' => $formatted_date])->count();
                
                $crossing_today_stats = $this->GamerTransits->find()->select(['transit_total' => 'sum(transit_amount)','transit_jetons' => 'sum(transit_coins)','transit_jetons_bonus' => 'sum(transit_bonus)'])
                ->Where(['DATE_FORMAT(created,"%d%m")' => $formatted_date])->first()->toArray();

                $today = [
                    'crossing_today_count' => $crossing_today_count,
                    'crossing_today_sum_amount' => $crossing_today_stats['transit_total'],
                    'crossing_today_coins' => $crossing_today_stats['transit_jetons'],
                    'crossing_today_bonus' => $crossing_today_stats['transit_jetons_bonus'],
                ];

                $this->RequestHandler->renderAs($this,'json');
                $this->set(compact('today'));
                $this->set('_serialize',['today']);
          }catch(MainException $e){
            throw new Exception\BadRequestException(__('stats exception 1'));
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
