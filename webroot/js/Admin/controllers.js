angular.module('game_controllers',[])
		.controller('AdminsController',['$scope','GamerService','$filter','CrossingService','OptionService','AccountService','ProfileService','$rootScope','$state','$stateParams', function($scope,GamerService,$filter,CrossingService,OptionService,AccountService,ProfileService,$rootScope,$state,$stateParams){
			// Profile account
			$scope.profile = {};
			$scope.profile_dropdown_trigger = '';
			ProfileService.get().then(function(resp){
				$scope.profile = resp.data.profile;
			}, function(err){
				toastr.error("Une erreur est survenue lors du retrait des informaions");
			});

			$scope.show_profile_menu = function(){
				if($scope.profile_dropdown_trigger=='is-active')
				$scope.profile_dropdown_trigger = '';
				else
				$scope.profile_dropdown_trigger = 'is-active';
			};

			// get actual coin value
			$scope.custom_options = {};
			OptionService.get().then(function(resp){
				$scope.custom_options = resp.data.options;
			});

			// get gamers
			$rootScope.gamers = [];
			$rootScope.gamers_retrieve = [];
			

			GamerService.all().then(function(response){
		    	$rootScope.gamers = response.data.gamers;
		    	$rootScope.gamers.forEach(function(element, index){
		    		element.gamer_details = JSON.parse(element.gamer_details);
				});
		    }, function(err){
		    	toastr.error('Une erreur est survenue, veuillez réessayer');
		    });



			// gamer view filter
		    $scope.gamer_filter = '';
		    // Analyze crossing 
		    $scope.analyze_crossing = function(crossing){
		    	if(!crossing.transit_is_active)
		    		return 'crossing-canceled';
		    	else
		    		return '';
		    };

		    $scope.analyze_gamer = function(gamer){
		    	if(!gamer.gamer_is_active)
		    		return 'gamer-canceled';
		    	else
		    		return '';
		    };
		    // vars
				$scope.show_crossing_modal = '';
				$rootScope.crossing_tab = 'gamer_info';

				$scope.selected_crossing_gamer = {};
				$scope.selected_crossing_gamer_index = '';
				$scope.crossing = {};
				$scope.is_loading = false;

				$scope.closeWorkflowModal = function(){
					$scope.show_crossing_modal = '';
				    $scope.selected_crossing_gamer = {};
				    $scope.crossing = {};
					$scope.hide_bonus_zone = true;
					$rootScope.crossing_tab = 'gamer_info';
					angular.element('.gamer-info').triggerHandler('click');

				    $scope.selected_crossing_gamer_index = '';
				};

				$scope.set_crossing_gamer = function(gamer,index){
					$scope.show_crossing_modal = 'is-active';
				    $scope.selected_crossing_gamer = gamer;
				    $scope.selected_crossing_gamer_index = index;
				    $scope.refresh_stats_selected_crossing();
				    $scope.determine_award();
				};
				// Award crossing
				$scope.show_award_crossing_modal = '';
				$scope.hide_bonus_zone = true;

				// Determining award crossing
				$scope.determine_award = function(){
						var award_count = 0;
						$scope.selected_crossing_gamer.gamer_cards[0].gamer_transits.forEach(function(element, index){
							if(element.transit_is_active)
								award_count++;
						});
						if(award_count >= 10)
							$scope.open_award_crossing();
				};

				$scope.open_award_crossing = function(){
				   $scope.show_award_crossing_modal = 'is-active';
				};

				$scope.close_award_crossing = function(){
				   $scope.show_award_crossing_modal = '';					
				};
				// 

				$scope.convert_transit_amount = function(crossing){
					// make additional calculations if bonus
					var award_count = 0;
					$scope.selected_crossing_gamer.gamer_cards[0].gamer_transits.forEach(function(element,index){
						if(element.transit_is_active)
						award_count++;
					});
					crossing.transit_value_mock = Math.ceil(crossing.transit_amount/$scope.custom_options.option_current_coin_value);
					if(award_count>=10){   
						$scope.hide_bonus_zone = false;
						$scope.crossing.transit_total_mock = $scope.selected_crossing_gamer.total_current_amount+$scope.crossing.transit_amount;
						$scope.crossing.transit_bonus_mock = 0.15*($scope.selected_crossing_gamer.total_current_amount+$scope.crossing.transit_amount);
						$scope.crossing.transit_bonus_coins_mock = Math.ceil($scope.crossing.transit_bonus_mock/$scope.custom_options.option_current_coin_value);
					}
				};

				$scope.add_crossing = function(crossing){
					var r = confirm("êtes-vous sûre de vouloir enregistrer ce passage?");
					if(r == true){
						$scope.is_loading = true;
						crossing.gamer_id = $scope.selected_crossing_gamer.id;
						CrossingService.create(crossing).then(function(resp){
							toastr.success("Passage créé avec succès");
							$scope.crossing = {};
							return true;
						}).then(function(resp){
							$scope.refresh_cache();
						}, function(err){
							toastr.error("Une erreur est survenue, veuillez réessayer.");
						}).finally(function(){
							$scope.is_loading = false;
						})
					}
				};

				$scope.refresh_stats_selected_crossing = function(){
					if($scope.selected_crossing_gamer){
						var amount = 0;
						var amount_coin = 0;
						$scope.selected_crossing_gamer.gamer_cards[0].gamer_transits.forEach(function(element, index){
			    			// element.gamer_details = JSON.parse(element.gamer_details);
			    			if(element.transit_is_active){
			    				amount+=element.transit_amount;
			    				amount_coin+=element.transit_coins;	
			    			}

						});
						$scope.selected_crossing_gamer.total_current_amount = amount;
						$scope.selected_crossing_gamer.total_current_coin = amount_coin;
					}
				};

				$scope.set_full_history_amount = function(card){
					var set_full_history_amount = 0;
					if(card.gamer_transits.length>0){
						card.gamer_transits.forEach(function(element, index){
							if(element.transit_is_active)
							set_full_history_amount += element.transit_amount;
						});
					}

					return set_full_history_amount;
				};

				$scope.set_full_history_amount_coin = function(card){
					var set_full_history_amount = 0;
					if(card.gamer_transits.length>0){
						card.gamer_transits.forEach(function(element, index){
							if(element.transit_is_active)
							set_full_history_amount += element.transit_amount;
						});
					}

					return Math.ceil(set_full_history_amount/$scope.custom_options.option_current_coin_value);
				};

				// update crossing value
				$scope.show_update_crossing_modal = '';
				$scope.modified_crossing = {};

				$scope.update_value = function(crossing){
					$scope.show_update_crossing_modal = 'is-active';
					$scope.modified_crossing = {
						id:crossing.id,
						gamer_card_id_mock:crossing.gamer_card_id,
						transit_amount: crossing.transit_amount,
						transit_value_mock:  Math.ceil(crossing.transit_amount/$scope.custom_options.option_current_coin_value)
					};
				};
				// Cancel crossing
				$scope.cancel_crossing = function(crossing){
					var r = confirm("êtes-vous sûre de vouloir annuler ce passage?");
					if(r == true){
						$scope.is_loading = true;
						CrossingService.cancel(crossing).then(function(resp){
					    	toastr.success('Passage annulé avec succès');
							return true;
						}).then(function(resp){
							$scope.refresh_cache();
						}, function(err){
					    	toastr.error('Une erreur est survenue, veuillez réessayer');
						}).finally(function(){
							$scope.is_loading = false;
						});
					}
				};

				$scope.closeUpdateCrossModal = function(){
					$scope.show_update_crossing_modal = '';
					$scope.modified_crossing = {}
				};

				$scope.update_convert_transit_amount = function(){
					$scope.modified_crossing.transit_value_mock = Math.ceil($scope.modified_crossing.transit_amount/$scope.custom_options.option_current_coin_value);
					
				};

				$scope.updateCrossing = function(modified_crossing){
					var r = confirm("êtes-vous sûre de vouloir modifier ce passage?");
					if(r == true){
						$scope.is_loading = true;
						CrossingService.update(modified_crossing).then(function(resp){
					    	toastr.success('Changements réalisés avec succès');
							return true;
						}).then(function(resp){
							$scope.refresh_cache();
							$scope.closeUpdateCrossModal();
						}, function(err){
					    	toastr.error('Une erreur est survenue, veuillez réessayer');
						}).finally(function(){
							$scope.is_loading = false;
						});
					}
				};
				// trails
				$scope.show_trails_crossing_modal = '';


				$scope.show_trails_modal_trigger = function(card){
					$scope.current_card_trailers = [];
					card.archive_opened = true;
					// get traces
					card.gamer_transits.forEach(function(transit, index){
						transit.gamer_transit_traces.forEach(function(element, index){
							element.crossing_id = transit.transit_identity;
							$scope.current_card_trailers.push(element);
						});
					});	

					for(i=1;i<($scope.current_card_trailers.length);i++){
						var x = $scope.current_card_trailers[i];
						var j = i;
						while((j>0) && ((new Date($scope.current_card_trailers[j-1].created))> new Date(x.created))){
							$scope.current_card_trailers[j] = $scope.current_card_trailers[j-1];
							j--;
						}
						$scope.current_card_trailers[j] = x;
					}
				};

				$scope.closeShowTrailCrossModal = function(card){
					card.archive_opened = false;
				};




			$scope.lock_gamer = function(gamer_id,gamer){
				var r = confirm("êtes-vous sûre de vouloir verrouiller ce Gamer?");
				if(r == true){
					GamerService.lock(gamer_id).then(function(response){
							gamer.gamer_is_active = false;
							toastr.success('Compte Gamer verrouillé avec succès');
							$scope.refresh_cache();
					}, function(err){
							toastr.error('Une erreur est survenue, veuillez réessayer');
					});
				}

			};

			$scope.unlock_gamer = function(gamer_id,gamer){
				var r = confirm("êtes-vous sûre de vouloir déverrouiller ce Gamer?");
				if(r == true){
					GamerService.unlock(gamer_id).then(function(response){
							gamer.gamer_is_active = true;
							toastr.success('Compte Gamer déverrouillé avec succès');
							$scope.refresh_cache();
					}, function(err){
							toastr.error('Une erreur est survenue, veuillez réessayer');
					});
				}
			};

			$scope.suppress_curent_card = function(gamer_id){
				var r = confirm("êtes-vous sûre de vouloir supprimer la carte courante de ce gamer? celà génèrera une nouvelle carte.");
				if(r == true){
					GamerService.supress_current_card(gamer_id).then(function(response){
							toastr.success('Supression réalisée avec succès');
							$scope.refresh_cache();
					}, function(err){
							toastr.error('Une erreur est survenue, veuillez réessayer');
					});
				}
			}

			// get last crossing
			$scope.get_last_crossing = function(card){
				let length_transists = card.gamer_transits.length;
				let response = $filter('date')(card.gamer_transits[length_transists-1].created,'dd/MM/yyyy HH:mm');
				return response;
			};
			// refresh cache
			$scope.refresh_cache = function(){
							GamerService.RefreshCache().then(function(response){
								$rootScope.gamers = response.data.gamers;
						    	$rootScope.gamers.forEach(function(element, index){
						    		element.gamer_details = JSON.parse(element.gamer_details);
								});
						    	$rootScope.gamers_retrieve = $rootScope.gamers; 

								let index = $scope.selected_crossing_gamer_index;
								$scope.selected_crossing_gamer = $rootScope.gamers[index];

								$rootScope.crossing_tab = 'history';
								angular.element('.main-history').triggerHandler('click');
				    			$scope.refresh_stats_selected_crossing();
				    			return true;
							}, function(err){
								return err;
							})
			};

			// Update Gamer
			$scope.show_modal_view_gamer = '';
			$scope.openModalViewGamers = function(){
				$scope.show_modal_view_gamer = 'is-active';
			};

			$scope.closeModalViewGamers = function(){
				$scope.show_modal_view_gamer = '';
			};

			// update users
			AccountService.all().then(function(response){
				$scope.users = response.data.users;	
			}, function(err){
				toastr.error('Une erreur est survenue lors de la récupération des utilisateurs.');
			});

			$scope.show_modal_view_users = '';
			$scope.openModalViewUsers = function(){
				$scope.show_modal_view_users = 'is-active';
			};

			$scope.closeModalViewUsers = function(){
				$scope.show_modal_view_users = '';
			};

		    if($state.current.name == "admins.gamers.view"){
				$scope.is_loading = '';
				if(typeof($stateParams.page=='undefined')){
					var current_page = 1
				}else
					var current_page = $stateParams.page;

				$scope.pagination = {
					current_page: parseInt(current_page)
				};

				$scope.previous_page = function(){
					if($scope.pagination.current_page != 1){
						$scope.pagination.current_page--;
					    $scope.retrieve(($scope.pagination.current_page));
					}
					else
						toastr.warning("Fin de liste");
				}
				$scope.next_page = function(){
					if($scope.pagination.current_page != $scope.pagination.all_pages){
						$scope.pagination.current_page++;
					    $scope.retrieve(($scope.pagination.current_page));
					}
					else
						toastr.warning("Fin de liste");
				}

				$scope.retrieve = function(page){
					GamerService.retrieve(page).then(function(response){
				    	$rootScope.gamers_retrieve = response.data.gamers;
				    	$scope.pagination.all_pages = response.data.gamers_count;
				    	$rootScope.gamers_retrieve.forEach(function(element, index){
				    		element.gamer_details = JSON.parse(element.gamer_details);
						});
						console.log($rootScope.gamers_retrieve);
				    }, function(err){
				    	toastr.error('Une erreur est survenue, veuillez réessayer');
				    });	
				}

				$scope.retrieve($scope.pagination.current_page);
		    }

		}]).controller('DashController',['$scope','DashService', function($scope,DashService){
  			
			var self = this;
			$scope.is_loading = false;

			$scope.stats = {
				today:{
					crossing_today_bonus: 0,
					crossing_today_coins: 0,
					crossing_today_sum_amount: 0,
					crossing_today_count: 0
				},
				monthly:{
					gamer_registered:0,
					cu_cumulated:0,
					bonus_gave:0,
					coins_cumulated:0,
					gamer_registered_list:0,
				},
				general:{
					list_birthday_today:0,
					list_birthday_monthly:0,
				}
			};

				DashService.general().then(function(resp){
					$scope.stats.general.list_birthday_today = resp.data.general.general_birthday_today;
					$scope.stats.general.list_birthday_monthly = resp.data.general.general_birthday_monthly;

					$scope.stats.general.list_birthday_today.forEach(function(element, index){
						element.gamer_details = JSON.parse(element.gamer_details);
					});

					$scope.stats.general.list_birthday_monthly.forEach(function(element, index){
						element.gamer_details = JSON.parse(element.gamer_details);
					});
				}, function(err){

				}).finally(function(){
					$scope.is_loading = false;
				});




			$scope.refreshStats = function(){
			$scope.is_loading = true;
				DashService.today().then(function(resp){
					$scope.stats.today = resp.data.today;
					if($scope.stats.today.crossing_today_bonus == null)
						$scope.stats.today.crossing_today_bonus = 0;
					if($scope.stats.today.crossing_today_coins == null)
						$scope.stats.today.crossing_today_coins = 0;
					if($scope.stats.today.crossing_today_sum_amount == null)
						$scope.stats.today.crossing_today_sum_amount = 0;
				}, function(err){

				}).finally(function(){
					$scope.is_loading = false;
				});

				DashService.monthly().then(function(resp){
					$scope.stats.monthly = resp.data.monthly;
					if($scope.stats.monthly.gamer_registered == null)
						$scope.stats.monthly.gamer_registered = 0;
					if($scope.stats.monthly.cu_cumulated == null)
						$scope.stats.monthly.cu_cumulated = 0;
					if($scope.stats.monthly.bonus_gave == null)
						$scope.stats.monthly.bonus_gave = 0;
					if($scope.stats.monthly.coins_cumulated == null)
						$scope.stats.monthly.coins_cumulated = 0;

					if($scope.stats.monthly.gamer_registered_list){
						$scope.stats.monthly.gamer_registered_list.forEach(function(element, index){
									element.gamer_details = JSON.parse(element.gamer_details);
						});
					}

				}, function(err){}).finally(function(){
					$scope.is_loading = false;
				});


			};

			$scope.analyze_gamer = function(gamer){
		    	if(!gamer.gamer_is_active)
		    		return 'gamer-canceled';
		    	else
		    		return '';
		    };
// 
  			$scope.labels_radar =["SQLi", "DirTrav", "Xss", "Default Password", "Dns Poisoning", "Cookie Stealing", "Verbose System"];

			  $scope.data_radar = [
			    [65, 59, 90, 81, 56, 55, 40],
			    [28, 48, 40, 19, 96, 27, 100]
			  ];
			$scope.colors = ["#ec008c","#110e39","#caebd5","#fff70c","#626984","#3D0100","#8A0C09","#023D15","#573A0E","#97305B","#1FBDAC"];
			 //graph
			 $scope.labels = ["January", "February", "March", "April", "May", "June", "July",];
			  $scope.series = ['Series A', 'Series B'];
			  $scope.data = [
			    [65, 59, 80, 81, 56, 55, 40],
			    [28, 48, 40, 19, 86, 27, 90]
			  ];
			  $scope.onClick = function (points, evt) {
			  };
			  $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
			  $scope.options = {
			    scales: {
			      yAxes: [
			        {
			          id: 'y-axis-1',
			          type: 'linear',
			          display: true,
			          position: 'left'
			        },
			        {
			          id: 'y-axis-2',
			          type: 'linear',
			          display: true,
			          position: 'right'
			        }
			      ]
			    }
			   };

				  $scope.labels_pie = ["Collectés", "Partagés"];
				  $scope.data_pie = [200, 500];

			  //doughnout
			  $scope.labels_doughnout = [];
			  $scope.data_doughnout = [];		
	}]).controller('GamersViewController',['$rootScope','$scope','GamerService', function($rootScope,$scope,GamerService){
		    



	}]).controller('GamersCreateController', ['$scope','GamerService','$state', function($scope,GamerService,$state){
		var self = this;
		$scope.is_loading = false;
		$scope.create = function(gamer){
			var r = confirm('êtes-vous sûre de vouloir créer un nouveau gamer');
			if(r == true){
				GamerService.create(gamer).then(function(resp){
					$state.go('admins.gamers.view',{reload:true});
					toastr.success('Gamer ajouté avec succès.');
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				});
			}

		};

	}]).controller('GamersEditController', ['$scope','GamerService','$stateParams','$state', function($scope,GamerService,$stateParams,$state){
		var self = this;
		$scope.is_loading = false;
		$scope.gamer = {};
		GamerService.get($stateParams.gamer_id).then(function(response){
			$scope.gamer = response.data.gamer;
			$scope.gamer.gamer_details = JSON.parse($scope.gamer.gamer_details);
		}, function(err){
			toastr.error('Une erreur est survenue, veuillez réessayer');
		});

		$scope.update = function(gamer){
			var r = confirm('êtes-vous sûre de vouloir modifier ce gamer');
			if(r == true){
				GamerService.update(gamer).then(function(resp){
					$state.go('admins.gamers.view',{reload:true});
					toastr.success('Gamer modifié avec succès.');
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				});
			}
		};


	}]).controller('AccountsViewController', ['$scope','AccountService','$stateParams', function($scope,AccountService,$stateParams){
		$scope.users = [];
		$scope.filter_users = '';
		$scope.is_loading = '';

				if(typeof($stateParams.page=='undefined')){
					var current_page = 1
				}else
					var current_page = $stateParams.page;

				$scope.pagination = {
					current_page: parseInt(current_page)
				};

		$scope.previous_page = function(){
			if($scope.pagination.current_page != 1){
				$scope.pagination.current_page--;
			    $scope.retrieve(($scope.pagination.current_page));
			}
			else
				toastr.warning("Fin de liste");
		}
		$scope.next_page = function(){
			if($scope.pagination.current_page != $scope.pagination.all_pages){
				$scope.pagination.current_page++;
			    $scope.retrieve(($scope.pagination.current_page));
			}
			else
				toastr.warning("Fin de liste");
		}

		$scope.retrieve = function(page){
			$scope.is_loading = true;
			AccountService.retrieve(page).then(function(resp){
				$scope.users = resp.data.users;	
				$scope.pagination.all_pages = resp.data.users_count;
			}, function(err){
				toastr.error('Une erreur est survene, veuillez réessayer');
			}).finally(function(){
				$scope.is_loading = '';
			});
		};

		$scope.retrieve($scope.pagination.current_page);


		$scope.lock_user_account_trigger = function(id, user){
			var r = confirm("êtes-vous sûre de vouloir verrouiller ce Compte? L'utilisateur concerné ne pourrait plus y effectuer ses actions.")
			if(r == true){
				AccountService.lockdown(id).then(function(resp){
					toastr.success('Compte verrouillé avec succès');
					user.user_is_active = false;
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				})
			}
		};

		$scope.unlock_user_account_trigger = function(id, user){
			var r = confirm("êtes-vous sûre de vouloir déverrouiller ce Compte? L'utilisateur concerné aurait désormais le droit de s'y reconnecter.")
			if(r == true){
				AccountService.lockup(id).then(function(resp){
					toastr.success('Compte déverrouillé avec succès');
					user.user_is_active = true;
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				})
			}
		};

		$scope.reset_password = function(id){
			var r = confirm("êtes-vous sûre de vouloir réinitialiser le mot de passe? le mot de passe de réinitialisation est : Gamecenter@2018++");
			if(r == true){
				AccountService.reset(id).then(function(resp){
					toastr.success('Compte réinitialisé avec succès');
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				})
			}
		}
	}]).controller('AccountsCreateController', ['$scope','RoleService','AccountService','Upload','$state', function($scope,RoleService,AccountService,Upload,$state){
		var self = this;
		$scope.roles = [];
		RoleService.all().then(function(response){
			$scope.roles = response.data.roles;
		}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
		});

		$scope.upload = function(account){
			AccountService.create(account).then(function(resp){
				toastr.success('Utilisateur ajouté avec succès');
				$state.go('admins.accounts.view',{reload:true});
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});
		};

	}]).controller('AccountsEditController', ['$scope','$stateParams','RoleService','AccountService','Upload','$state', function($scope,$stateParams,RoleService,AccountService,Upload,$state){
			var self  = this;
			self.is_changing_image = false;
			self.is_changing_image_avatar = false;
			$scope.user = {};
			$scope.roles = {};
			// load account info
			AccountService.get($stateParams.user_id).then(function(resp){
				$scope.user = resp.data.user;
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});

			RoleService.all().then(function(resp){
				$scope.roles = resp.data.roles;
			});

			$scope.delete_user_photo_candidate = function(){
				self.is_changing_image = false;
				$scope.user.user_photo_candidate = null;
			};

			$scope.delete_user_avatar_candidate = function(){
				self.is_changing_image_avatar = false;
				$scope.user.user_accounts[0].user_account_avatar_candidate = null;
			};

			

			$scope.update = function(profile){
				var r = confirm('Etes-vous sûre de vouloir modifier les informations de utilisateur?');
				if(r == true){
				$scope.is_loading = 'is-loading';

					if($scope.user.user_photo_candidate == null)
						delete $scope.user.user_photo_candidate;
					$scope.isloading = true;
					Upload.upload({
						url:'/accounts/edit',
						data:{'profile':profile}
					}).then(function(resp){
						toastr.success('modifications réalisées avec succès');
						$state.go('admins.accounts.view',{reload:true});
					}, function(err){
						toastr.error('Une erreur est survenue, veuillez réessayer');
					}, function(evt){

					}).finally(function(){
						$scope.is_loading = '';				
					});
				}
			};
	}]).controller('CrossingsViewController', ['$scope','CrossingService','$stateParams', function($scope,CrossingService,$stateParams){
		var self = this;
		$scope.crossings =[];
		$scope.is_loading = '';

				if(typeof($stateParams.page=='undefined')){
					var current_page = 1
				}else
					var current_page = $stateParams.page;

				$scope.pagination = {
					current_page: parseInt(current_page)
				};

		$scope.previous_page = function(){
			if($scope.pagination.current_page != 1){
				$scope.pagination.current_page--;
			    $scope.get(($scope.pagination.current_page));
			}
			else
				toastr.warning("Fin de liste");
		}
		$scope.next_page = function(){
			if($scope.pagination.current_page != $scope.pagination.all_pages){
				$scope.pagination.current_page++;
			    $scope.get(($scope.pagination.current_page));
			}
			else
				toastr.warning("Fin de liste");
		}


		$scope.filter_crossings = '';

		$scope.get = function(page){
			$scope.is_loading = true;
			CrossingService.get(page).then(function(resp){
				$scope.crossings = resp.data.crossings;
				$scope.pagination.all_pages = resp.data.crossings_count;
			}, function(err){
				toastr.error('Une erreur est survene, veuillez réessayer');
			}).finally(function(){
				$scope.is_loading = '';
			});
		};

		$scope.get($scope.pagination.current_page);


	}]).controller('OptionsController', ['$scope','OptionService','$state', function($scope,OptionService,$state){
		$scope.custom_options = {};
		OptionService.all().then(function(response){
			$scope.custom_options = response.data.custom_options[0];
		}, function(err){
			toastr.error('Une erreur est survenue lors de la récupération des options');
		});

		$scope.is_loading = '';

		$scope.edit_custom_options = function(custom_options){
			var r = confirm("êtes-vous sûre de vouloir modifier les options?");
			if(r == true){
					$scope.is_loading = true;

				OptionService.edit(custom_options).then(function(response){
					toastr.success('Changements réalisés avec succès');
					$state.reload(true);
				}, function(err){
					toastr.error('Une erreur est survenue lors de la sauvgerde des changements.');
				}).finally(function(){
					$scope.is_loading = '';
				});
			}

		};
	}]).controller('ProfilesEditController',['$scope','Upload','ProfileService','RoleService','$state','$location', function($scope,Upload,ProfileService,RoleService,$state,$location){
			
			var self  = this;
			self.is_changing_image = false;		

			RoleService.all().then(function(resp){
				$scope.roles = resp.data.roles;
			});

			$scope.delete_user_account_avatar_candidate = function(){
				self.is_changing_image = false;
				$scope.profile.user_account_avatar_candidate = null;
			};
			$scope.profile = {};
			ProfileService.get().then(function(resp){
				$scope.profile = resp.data.profile;
			}, function(err){
				toastr.error('Une Erreur est survenue, veuillez réessayer');
			});

			$scope.update = function(profile){
				var r = confirm('Etes-vous sûre de vouloir modifier vos informations de compte?');
				if(r == true){
					if($scope.profile.user_account_avatar_candidate == null)
						delete $scope.profile.user_account_avatar_candidate;
					if (typeof($scope.profile.profile_accounts) !== 'undefined') {
						if(($scope.profile.profile_accounts[0].account_password_new == '') || ($scope.profile.profile_accounts[0].account_password_old == ''))
							delete $scope.profile.profile_accounts[0];
					}

					$scope.is_loading = true;
					Upload.upload({
						url:'/profiles/edit',
						data:{'profile':profile}
					}).then(function(resp){
						toastr.success('Modifications réussies');
						window.location.reload();
					}, function(err){

					}, function(evt){

					}).finally(function(){
						$scope.is_loading = false;
					});
				}
			};
		}]).controller('GamerRafflesController',['$scope','Upload','RaffleService','RoleService','$state', function($scope,Upload,RaffleService,RoleService,$state){
			var self = this;
			$scope.is_loading = false;
			$scope.raffle_winner = [];
			$scope.show_winner_raffle_modal = '';

			$scope.raffles = [];
			RaffleService.all().then(function(resp){
				$scope.raffles = resp.data.raffles;
				if($scope.raffles.length===0)
					toastr.warning("Aucune Information tombola disponible");
				else{

				}
			}, function(err){
				toastr.error("Une erreur est survenue, veuillez réessayer");
			});

			$scope.create = function(raffle){
						var r = confirm("êtes-vous sure de vouloir réaliser ce tirage");
						if(r == true){
							$scope.is_loading = true; 
							RaffleService.create(raffle).then(function(resp){
								toastr.success("Tombola réalisée avec succès");
								$scope.open_winner_raffle_modal(resp.data.gamer,raffle);
							}, function(err){
								toastr.error("Une erreur est survenue lors de l'enregistrement");
							}).finally(function(){
								$scope.is_loading = false;
							});
						}

			};

			$scope.open_winner_raffle_modal = function(gamer, raffle){
			  $scope.show_winner_raffle_modal = 'is-active';
			  $scope.raffle_winner = gamer;
			}

			$scope.close_winner_raffle = function(){
			  $scope.show_winner_raffle_modal = '';
								$state.reload();

			};
		}])


