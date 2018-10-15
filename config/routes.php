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
    $routes->connect('/options',['controller'=>'Admins', 'action'=>'options']);

    // Spas for gamers
    $routes->connect('/gamers/view',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/gamers/edit/:gamer_id',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/gamers/create',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/gamers',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/gamers/raffles',['controller'=>'Admins', 'action'=>'index']);

    // Spas for accounts
    $routes->connect('/accounts/view',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/accounts/create',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/accounts/edit/:id',['controller'=>'Admins', 'action'=>'edit']);
    $routes->connect('/accounts/get/:id',['controller'=>'Admins', 'action'=>'get']);
    $routes->connect('/accounts',['controller'=>'Admins', 'action'=>'index']);
    // Spas for crossings
    $routes->connect('/crossings/view',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/crossings',['controller'=>'Admins', 'action'=>'index']);
    // spas for profiles
    $routes->connect('/profiles/edit',['controller'=>'Admins', 'action'=>'index']);

});

Router::scope('/gamers', function (RouteBuilder $routes) {
    $routes->connect('/view',['controller'=>'Gamers', 'action'=>'view']);
    $routes->connect('/',['controller'=>'Gamers', 'action'=>'index']);
    $routes->connect('/create',['controller'=>'Gamers', 'action'=>'create']);
    $routes->connect('/edit',['controller'=>'Gamers', 'action'=>'edit']);
    $routes->connect('/all',['controller'=>'Gamers', 'action'=>'all']);
    $routes->connect('/get',['controller'=>'Gamers', 'action'=>'get']);
    $routes->connect('/update',['controller'=>'Gamers', 'action'=>'update']);
    $routes->connect('/raffles',['controller'=>'Gamers', 'action'=>'raffles']);
    $routes->connect('/lock',['controller'=>'Gamers', 'action'=>'lock']);
    $routes->connect('/unlock',['controller'=>'Gamers', 'action'=>'unlock']);
    $routes->connect('/refresh-cache',['controller'=>'Gamers', 'action'=>'refreshCache']);
    $routes->connect('/retrieve',['controller'=>'Gamers', 'action'=>'retrieve']);
    $routes->connect('/suppress-current-card',['controller'=>'Gamers', 'action'=>'suppressCurrentCard']);
});

Router::scope('/roles', function (RouteBuilder $routes) {
    $routes->connect('/',['controller'=>'Roles', 'action'=>'index']);
    $routes->connect('/all',['controller'=>'Roles', 'action'=>'all']);
    $routes->connect('/create',['controller'=>'Roles', 'action'=>'create']);
});

Router::scope('/accounts', function (RouteBuilder $routes) {
    $routes->connect('/view',['controller'=>'Accounts', 'action'=>'view']);
    $routes->connect('/',['controller'=>'Accounts', 'action'=>'index']);
    $routes->connect('/create',['controller'=>'Accounts', 'action'=>'create']);
    $routes->connect('/edit',['controller'=>'Accounts', 'action'=>'edit']);
    $routes->connect('/all',['controller'=>'Accounts', 'action'=>'all']);
    $routes->connect('/lock',['controller'=>'Accounts', 'action'=>'lock']);
    $routes->connect('/unlock',['controller'=>'Accounts', 'action'=>'unlock']);
    $routes->connect('/reset',['controller'=>'Accounts', 'action'=>'reset']);
    $routes->connect('/get',['controller'=>'Accounts', 'action'=>'get']);
    $routes->connect('/retrieve',['controller'=>'Accounts', 'action'=>'retrieve']);
});

Router::scope('/options', function (RouteBuilder $routes) {
    $routes->connect('/',['controller'=>'Options', 'action'=>'index']);
    $routes->connect('/all',['controller'=>'Options', 'action'=>'all']);
    $routes->connect('/edit',['controller'=>'Options', 'action'=>'edit']);
    $routes->connect('/get',['controller'=>'Options', 'action'=>'get']);
});

Router::scope('/dashboard', function (RouteBuilder $routes) {
    $routes->connect('/',['controller'=>'Dashboard', 'action'=>'index']);
    $routes->connect('/general',['controller'=>'Dashboard', 'action'=>'general']);
    $routes->connect('/today',['controller'=>'Dashboard', 'action'=>'today']);
    $routes->connect('/monthly',['controller'=>'Dashboard', 'action'=>'monthly']);
});

Router::scope('/profiles', function (RouteBuilder $routes) {
    $routes->connect('/',['controller'=>'Profiles', 'action'=>'index']);
    $routes->connect('/edit',['controller'=>'Profiles', 'action'=>'edit']);
    $routes->connect('/get',['controller'=>'Profiles', 'action'=>'get']);
});

Router::scope('/raffles', function (RouteBuilder $routes) {
    $routes->connect('/',['controller'=>'Raffles', 'action'=>'index']);
    $routes->connect('/all',['controller'=>'Raffles', 'action'=>'all']);
    $routes->connect('/create',['controller'=>'Raffles', 'action'=>'create']);
});

Router::scope('/crossings', function (RouteBuilder $routes) {
    $routes->connect('/',['controller'=>'Crossings', 'action'=>'index']);
    $routes->connect('/view',['controller'=>'Crossings', 'action'=>'view']);
    $routes->connect('/create',['controller'=>'Crossings', 'action'=>'create']);
    $routes->connect('/update',['controller'=>'Crossings', 'action'=>'update']);
    $routes->connect('/all',['controller'=>'Crossings', 'action'=>'all']);
    $routes->connect('/get',['controller'=>'Crossings', 'action'=>'get']);
    $routes->connect('/cancel',['controller'=>'Crossings', 'action'=>'cancel']);
});
/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
