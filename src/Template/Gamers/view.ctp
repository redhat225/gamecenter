<section ui-view>
<style>
	.gamer-canceled{
		color: #fff !important;
		background: grey !important;
	}
</style>
	<div class="columns">
		<div class="column">
			<nav class="breadcrumb" aria-label="breadcrumbs">
			  <ul>
			    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
			    <li><a >Gamers</a></li>
			    <li class="is-active"><a >Vue Globale</a></li>
			  </ul>
			</nav>
		</div>
		<div class="column">
				<div class="field has-addons is-expanded">
					<div class="control is-expanded">
						<input type="text" class="input" ng-model="filter_keys">
					</div>
					<div class="control">
						<a class="button is-gamecenter-blue">
							<span class="icon">
								<i class="fa fa-search"></i>
							</span>
							<span>Rechercher</span>
						</a>
					</div>
				</div>
		</div>
		<div class="column">
				<button class="button is-gamecenter-pink" ui-sref="admins.gamers.create">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span>Ajouter un Gamer</span>
				</button>
		</div>
	</div>

	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30">
     		<div class="level-left">
     			<div class="span level-item">
     				&nbsp;
     			</div>
     		</div>
     		<div class="level-right">
				<div class="field has-addons level-item">
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="previous_page()" ng-disabled="is_loading">
				      <span class="icon is-small">
				        <i class="fa fa-chevron-left"></i>
				      </span>
				      <span class="has-text-weight-semibold">Précédent</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-static is-disabled">
				      <span ng-bind="pagination.current_page" ng-hide="is_loading">1</span> sur <span ng-bind="pagination.all_pages" ng-hide="is_loading">45</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="next_page()" ng-disabled="is_loading">
				      <span class="has-text-weight-semibold">Suivant</span>
				      <span class="icon is-small">
				        <i class="fa fa-chevron-right"></i>
				      </span>
				    </a>
				  </p>
				</div>
     		</div>
     	</div>
		<div>
				<!-- Tabular view -->
				<table class="table is-hoverable is-striped is-fullwidth">
					<thead>
						<tr class="gamecenter-pink-b">
							<th class="has-text-white">Nom</th>
							<th class="has-text-white">Code</th>
							<th class="has-text-white">Catégorie</th>
							<th class="has-text-white">Carte Active</th>
							<th class="has-text-white">Dernier Passage</th>
							<th class="has-text-white">Plus informations</th>
							<th class="has-text-white">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="gamer in $root.gamers_retrieve | filter:filter_keys" ng-class="analyze_gamer(gamer)">
							<td>{{gamer.gamer_fullname}}</td>
							<td>{{gamer.gamer_identity}}</td>
							<td class="has-text-centered">{{gamer.gamer_category}}</td>
							<td>{{gamer.gamer_cards[0].card_identity}}</td>
							<td ng-bind="get_last_crossing(gamer.gamer_cards[0])">&nbsp;</td>
							<td>
								<button class="button is-gamecenter-pink is-outlined" ng-click='set_crossing_gamer(gamer, $index)'>
									<span class="icon">
										<i class="fas fa-info"></i>
									</span>
									<span>
										+infos
									</span>
								</button>
							</td>
				  			<td>
							   <div class="dropdown is-hoverable is-right">
								   <div class="dropdown-trigger">
										   <button class="button">
											    <span class="icon is-small">
								   <i class="fas fa-cogs menu-icon"></i>
											    </span>
										   </button>
								   </div>
								   <div class="dropdown-menu" id="dropdown-menu" role="menu">
										   <div class="dropdown-content">
													  <h3 class="is-size-7 has-text-gamecenter-pink has-text-weight-bold">Gamer</h3>
													  <a ui-sref="admins.gamers.edit({gamer_id:gamer.id})" class="dropdown-item">
											            	Modifier Gamer
													 </a>
								 					 <a ng-if="gamer.gamer_is_active==true" ng-click="lock_gamer(gamer.id,gamer)" class="dropdown-item">
															Suspendre Compte
													 </a> 

													 <a ng-if="gamer.gamer_is_active==false" ng-click="unlock_gamer(gamer.id,gamer)" class="dropdown-item">
															Réactiver Compte
													 </a>

													 <a ng-click="suppress_curent_card(gamer)" class="dropdown-item">
															Supprimer Carte Courante
													 </a>
											    </div>
											  </div>
									    </div>
				  			</td>
						</tr>
					</tbody> 
				</table>
		</div>
	</div>
	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30">
     		<div class="level-left">
     			<div class="span level-item">
     				&nbsp;
     			</div>
     		</div>
     		<div class="level-right">
				<div class="field has-addons level-item">
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="previous_page()" ng-disabled="is_loading">
				      <span class="icon is-small">
				        <i class="fa fa-chevron-left"></i>
				      </span>
				      <span class="has-text-weight-semibold">Précédent</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-static is-disabled">
				      <span ng-bind="pagination.current_page" ng-hide="is_loading">1</span> sur <span ng-bind="pagination.all_pages" ng-hide="is_loading">45</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="next_page()" ng-disabled="is_loading">
				      <span class="has-text-weight-semibold">Suivant</span>
				      <span class="icon is-small">
				        <i class="fa fa-chevron-right"></i>
				      </span>
				    </a>
				  </p>
				</div>
     		</div>
     	</div>
     	  <?= $this->element('Gamers/add_crossing') ?>
     	  <?= $this->element('Gamers/update_crossing') ?>
     	  <?= $this->element('Gamers/award_crossing') ?>
</section>

