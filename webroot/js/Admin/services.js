angular.module('game_services',[])
.factory('RoleService',['$http','$q', function($http, $q){
		return{
			all: function(){
				return $http.get('/roles/all').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			}
		}
}]).factory('GamerService',['$http','$q', function($http,$q){
	return{
		create: function(gamer){
			return $http.post('/gamers/create',{gamer:gamer}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			})
		},
		all:function(){
			return $http.get('/gamers/all').then(function(resp){	
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		get:function(gamer_id){
			return $http.post('/gamers/get',{gamer:gamer_id}).then(function(resp){	
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		update: function(gamer){
			return $http.post('/gamers/edit',{gamer:gamer}).then(function(response){
				return response;
			}, function(err){
				return $q.reject(err);
			})
		},
		retrieve: function(page){
			return $http.get('/gamers/retrieve',{params:{'page':page}}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});		
		},
		lock: function(gamer_id){
			return $http.post('/gamers/lock',{gamer_id:gamer_id}).then(function(response){
				return response;
			}, function(err){
				return $q.reject(err);
			})
		},
		unlock: function(gamer_id){
			return $http.post('/gamers/unlock',{gamer_id:gamer_id}).then(function(response){
				return response;
			}, function(err){
				return $q.reject(err);
			})
		},
		cache: function(gamer_id){
			return $http.post('/gamers/cache').then(function(response){
				return response;
			}, function(err){
				return $q.reject(err);
			})
		},
		RefreshCache: function(){
			return $http.post('/gamers/refresh-cache').then(function(response){
				return response;
			}, function(err){
				return $q.reject(err);
			})
		},
		supress_current_card:function(gamer){
			return $http.post('/gamers/suppress-current-card',{gamer:gamer}).then(function(response){
				return response;
			}, function(err){
				return $q.reject(err);
			})
		}
	}
}])
.factory('AccountService',['$http','$q','Upload', function($http, $q, Upload){
	return{
		create: function(account){
			return Upload.upload({
				url:'/accounts/create',
				data:account
			}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		all: function(){
			return $http.get('/accounts/all').then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			})
		},
		get: function(id){
			return $http.post('/accounts/get',{'id':id}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		retrieve: function(page){
			return $http.get('/accounts/retrieve',{params:{'page':page}}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});		
		},
		lockdown: function(id){
			return $http.post('/accounts/lock',{'id':id}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		lockup: function(id){
			return $http.post('/accounts/unlock',{'id':id}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		reset: function(id){
			return $http.post('/accounts/reset',{'id':id}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		}
	}
}]).factory('CrossingService',['$http','$q','Upload', function($http, $q, Upload){
	return{
		create: function(crossing){
			return $http.post('/crossings/create',{crossing:crossing}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		update: function(crossing){
			return $http.post('/crossings/update',{crossing:crossing}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		all: function(){
			return $http.get('/crossings/all').then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});		
		},
		get: function(page){
			return $http.get('/crossings/get',{params:{'page':page}}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});		
		},
		cancel: function(crossing){
			return $http.post('/crossings/cancel',{crossing:crossing}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		}
	}
}]).factory('OptionService',['$http','$q','Upload', function($http, $q, Upload){
	return{
		all: function(){
			return $http.get('/options/all').then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		edit: function(options){
			return $http.post('/options/edit',{'options':options}).then(function(resp){
				return resp;
			}, function(err){
				return $q.reject(err);
			});
		},
		get: function(){
			return $http.get('/options/get').then(function(resp){
				return resp;
			},function(err){
				return $q.reject(err);
			})
		}

	}
}]).factory('ProfileService',['$http','$q', function($http, $q){
		return{
			get: function(){
				return $http.get('/profiles/get').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			}
		}
}]).factory('RaffleService',['$http','$q', function($http, $q){
		return{
			all: function(){
				return $http.get('/raffles/all').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			create: function(raffle){
				return $http.post('/raffles/create',raffle).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});	
			}
		}
}]).factory('DashService',['$http','$q', function($http, $q){
		return{
			general: function(){
				return $http.get('/dashboard/general').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			today: function(){
				return $http.get('/dashboard/today').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			monthly: function(){
				return $http.get('/dashboard/monthly').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});	
			}
		}
}])
