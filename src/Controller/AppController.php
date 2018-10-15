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

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Exception;
use \Exception as MainException;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('Auth', [
                'loginAction' => [
                    'controller' => 'Admins',
                    'action' => 'login'
                ],
                'authenticate' => [
                    'Form' => [
                        'fields' => ['username' => 'username', 'password' => 'password'],
                        'userModel' => 'UserAccounts',
                        'finder' => 'auth'
                    ]
                ],
                'authorize' => 'Controller'
        ]);
        /*          * see https://book.cakephp.org/3.0/en/controllers/components/security.html

         * Enable the following components for recommended CakePHP security settings.
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    public function isAuthorized($user = null){
        if($user){
            foreach ($user['role']['role_contents'] as $value) {
                if($this->request['_matchedRoute'] === $value['content_action']){
                    throw new Exception\ForbiddenException(__('forbidden'));
                }
            }
            return true;
        }


    } 
}
