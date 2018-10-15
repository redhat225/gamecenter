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
						<input type="text" class="input" ng-model="filter_crossings">
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
				      <span ng-bind="pagination.current_page" ng-hide="is_loading"></span>&nbsp;sur&nbsp;<span ng-bind="pagination.all_pages" ng-hide="is_loading"></span>
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
		<!-- History table -->
		<table class="table is-fullwidth is-striped is-hoverable">
				<thead>
					<tr class="gamecenter-pink-b">
						<th class="has-text-white has-text-weight-semibold" >#</th>
						<th class="has-text-white has-text-weight-semibold" >ID</th>
						<th class="has-text-white has-text-weight-semibold" >CardID</th>
						<th class="has-text-white has-text-weight-semibold" >Gamer</th>
						<th class="has-text-white has-text-weight-semibold" >Date</th>
						<th class="has-text-white has-text-weight-semibold" >Operateur</th>
						<th class="has-text-white has-text-weight-semibold" >Montant</th>
						<th class="has-text-white has-text-weight-semibold" >valeur jeton</th>
						<th class="has-text-white has-text-weight-semibold" >Equivalence(jetons)</th>
						<th class="has-text-white has-text-weight-semibold" >Bonus(Jetons)</th>	
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat = "crossing in crossings | filter:filter_crossings" ng-class="analyze_crossing(crossing)">
						<td>{{$index+1}}</td>
						<td>{{crossing.transit_identity}}</td>
						<td>{{crossing.gamer_card.card_identity}}</td>
						<td>{{crossing.gamer_card.gamer.gamer_fullname}}</td>
						<td>{{crossing.created | date:'dd/MM/yyyy HH:mm'}}</td>
						<td>{{crossing.user_account.user.user_fullname}}</td>
						<td>{{crossing.transit_amount | currency:'F'}}</td>
						<td>{{crossing.transit_value | currency}}</td>
						<td>{{crossing.transit_coins}}</td>
						<td>{{crossing.transit_bonus}}</td>
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
