angular.module('game',['game_controllers','game_services','game_directives','ui.router','ngFileUpload','angular-loading-bar','colorbox','chart.js','angular-fullcalendar'])
	.run(['$rootScope','$templateCache','$transitions', function($rootScope, $templateCache,$transitions){
		$transitions.onStart({to:'admins.**'},function(trans){
			$rootScope.preloader = true;
		});	
		$transitions.onSuccess({to:'admins.**'},function(trans){
			$rootScope.preloader = false;
			$templateCache.removeAll();
		});	
	}])
	.config(['$httpProvider','$stateProvider','$urlRouterProvider','$locationProvider', function($httpProvider, $stateProvider, $urlRouterProvider, $locationProvider){
		$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
		$httpProvider.defaults.headers.common['Authorization'] = 'bearer '+localStorage.getItem('token');

		// Activate Html5 Mode + hashPrefix
		$locationProvider.html5Mode(true);
		$locationProvider.hashPrefix('!');

		// Routing 
		$stateProvider.state('admins',{
			url:'/',
			templateUrl: '/admins/home',
			controller: 'AdminsController as adminscontroller',
			abstract:true
		}).state('admins.dashboard',{
			url:'dashboard',
			templateUrl:'/admins/dashboard',
			controller: 'DashController as dashctrl'
		}).state('admins.options',{
			url:'options',
			templateUrl:'/admins/options',
			controller: 'OptionsController as optionsctrl'
		}).state('admins.gamers',{
			url:'gamers',
			abstract:true,
			templateUrl:'/gamers'
		}).state('admins.gamers.view',{
			url:'/view?page',
			controller:'AdminsController as adminscontroller',
			templateUrl:'/gamers/view'
		}).state('admins.gamers.create',{
			url:'/create',
			controller:'GamersCreateController as gamerscreatectrl',
			templateUrl:'/gamers/create'
		}).state('admins.gamers.edit',{
			url:'/edit/:gamer_id',
			controller:'GamersEditController as gamerseditctrl',
			templateUrl:'/gamers/edit'
		}).state('admins.gamers.raffles',{
			url:'/raffles',
			controller:'GamerRafflesController as gamerrafflesctrl',
			templateUrl:'/gamers/raffles'
		}).state('admins.accounts',{
			url:'accounts',
			abstract:true,
			templateUrl:'/accounts'
		}).state('admins.accounts.view',{
			url:'/view?page',
			controller:'AccountsViewController as accountsviewctrl',
			templateUrl:'/accounts/view'
		}).state('admins.accounts.edit',{
			url:'/edit/:user_id',
			controller:'AccountsEditController as accountseditctrl',
			templateUrl:'/accounts/edit'
		}).state('admins.accounts.create',{
			url:'/create',
			controller:'AccountsCreateController as accountscreatectrl',
			templateUrl:'/accounts/create'
		}).state('admins.crossings',{
			url:'crossings',
			abstract:true,
			templateUrl:'/crossings'
		}).state('admins.crossings.view',{
			url:'/view?page',
			controller:'CrossingsViewController as crossingsviewctrl',
			templateUrl:'/crossings/view'
		}).state('admins.profiles',{
			url:'profiles',
			abstract:true,
			templateUrl:'/profiles'
		}).state('admins.profiles.edit',{
			url:'/edit',
			controller:'ProfilesEditController as profileseditctrl',
			templateUrl:'/profiles/edit'
		})
		$urlRouterProvider.otherwise('/dashboard');
	}])

