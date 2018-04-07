<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);
$routes->connect('/', ['controller' => 'Admins', 'action' => 'home']);
Router::scope('/admins', function (RouteBuilder $routes) {
    $routes->connect('/login',['controller'=>'Admins', 'action'=>'login']);
    $routes->connect('/tour',['controller'=>'Admins', 'action'=>'tour']);
    $routes->connect('/logout',['controller'=>'Admins', 'action'=>'logout']);
    $routes->connect('/home',['controller'=>'Admins', 'action'=>'home']);
    $routes->connect('/dashboard',['controller'=>'Admins', 'action'=>'dashboard']);

    // Spas for gamers
    $routes->connect('/gamers/view',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/gamers/create',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/gamers',['controller'=>'Admins', 'action'=>'index']);

    // Spas for accounts
    $routes->connect('/accounts/view',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/accounts/create',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/accounts',['controller'=>'Admins', 'action'=>'index']);
    // Spas for crossings
    $routes->connect('/crossings/view',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/crossings',['controller'=>'Admins', 'action'=>'index']);


});

Router::scope('/gamers', function (RouteBuilder $routes) {
    $routes->connect('/view',['controller'=>'Gamers', 'action'=>'view']);
    $routes->connect('/',['controller'=>'Gamers', 'action'=>'index']);
    $routes->connect('/create',['controller'=>'Gamers', 'action'=>'create']);
});

Router::scope('/accounts', function (RouteBuilder $routes) {
    $routes->connect('/view',['controller'=>'Accounts', 'action'=>'view']);
    $routes->connect('/',['controller'=>'Accounts', 'action'=>'index']);
    $routes->connect('/create',['controller'=>'Accounts', 'action'=>'create']);
});


Router::scope('/crossings', function (RouteBuilder $routes) {
    $routes->connect('/',['controller'=>'Crossings', 'action'=>'index']);
    $routes->connect('/view',['controller'=>'Crossings', 'action'=>'view']);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
