<section ui-view>
	  <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
	<div class="columns">
		<div class="column">
			<nav class="breadcrumb" aria-label="breadcrumbs">
			  <ul>
			    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
			    <li class="is-active"><a >Comptes Utilisateur</a></li>
			  </ul>
			</nav>
		</div>
		<div class="column">
				<div class="field has-addons is-expanded">
					<div class="control is-expanded">
						<input type="text" class="input" ng-model="filter_keys">
					</div>
					<div class="control">
						<a class="button is-intercoton-green is-static">
							<span class="icon">
								<i class="fa fa-search"></i>
							</span>
							<span>Rechercher</span>
						</a>
					</div>
				</div>



		</div>
		<div class="column">
				<button class="button is-oci" ui-sref="admins.accounts.create">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span>Créer un utilisateur</span>
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
							<th class="has-text-white">Photo</th>
							<th class="has-text-white">Nom Complet</th>
							<th class="has-text-white">Poste</th>
							<th class="has-text-white">Role</th>
							<th class="has-text-white">Création</th>
							<th class="has-text-white">Dernière Modification</th>
							<th class="has-text-white">Informations</th>
							<th class="has-text-white">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="">
							<td>
								<figure>
									<img width="100px" ng-src="/img/assets/admins/photo/{{user.user_photo}}" alt="">
								</figure>
							</td>
							<td>RIEHL Emmanuel</td>
							<td>Caissier</td>
							<td>Caissier</td>
							<td>15-01-2018 08H15</td>
							<td>15-01-2018 08H15</td>
							<td>
								<button class="button is-oci is-outlined" ng-click='openViewModal(user)'>
									<span class="icon">
										<i class="fas fa-info"></i>
									</span>
									<span>
										voir les infos
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
													 <a ui-sref="admins.accounts.edit({user_id:user.id})" class="dropdown-item">
											            	Modifier utilisateur
													 </a>
													 <a class="dropdown-item" ng-click="lock_user_account_trigger(user.user_accounts[0].id, user.user_accounts[0])" >
											            	Verrouiller utilisateur
													 </a>
													 </a>
													 <a ng-click="lock_user_account_trigger(user.user_accounts[0].id, user.user_accounts[0])" ng-if="user.user_accounts[0].user_account_is_active==false" class="dropdown-item">
											            	Déverrouiller utilisateur
													 </a>
													 <a ng-click="reinit_passsword(user.user_accounts[0].id)"  class="dropdown-item">
											            	Réinitialiser mot de passe
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
</section>
