<section >
	<div class="level">
		<div class="level-left">
			<div class="level-item">
				<span class="icon">
					<i class="fab fa-2x fa-dyalog"></i>
				</span>
				<span class="has-text-intercoton-green has-text-weight-semibold is-pad-lft-20">Dashboard</span> 	
			</div>
		</div>
	</div>

		<!-- Birthday - Observator & system -->
	<h1 class="subtitle has-text-weight-semibold">Dates Anniversaire</h1>
		<div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="tile is-child is-none-radius">
				<!-- Tabular view -->
				<h3 class="subtitle">Aujourd'hui</h3>
				<table class="table is-hoverable is-striped is-fullwidth">
					<thead>
						<tr class="gamecenter-pink-b">
							<th class="has-text-white">Nom</th>
							<th class="has-text-white">Catégorie</th>
							<th class="has-text-white">Contact</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="gamer in stats.general.list_birthday_today" ng-class="analyze_gamer(gamer)">
							<td>{{gamer.gamer_fullname}}</td>
							<td>{{gamer.gamer_category}}</td>
							<td class="has-text-centered">{{gamer.gamer_details.contact}}</td>
						</tr>
					</tbody> 
				</table>
				</div>
			</div>

		  <div class="tile is-parent">
				<div class="tile is-child is-none-radius">
				<h3 class="subtitle">Ce mois</h3>
				<table class="table is-hoverable is-striped is-fullwidth">
					<thead>
						<tr class="gamecenter-pink-b">
							<th class="has-text-white">Nom</th>
							<th class="has-text-white">Catégorie</th>
							<th class="has-text-white">Date(j-m)</th>
							<th class="has-text-white">Contact</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="gamer in stats.general.list_birthday_monthly" ng-class="analyze_gamer(gamer)">
							<td>{{gamer.gamer_fullname}}</td>
							<td>{{gamer.gamer_category}}</td>
							<td>{{gamer.cust_birth}}</td>
							<td class="has-text-centered">{{gamer.gamer_details.contact}}</td>
						</tr>
					</tbody> 
				</table>
				</div>
			</div>

         </div>
		</div>
	</div>

	<!-- Monthly Stats Preview - Observator & system -->
	<h1 class="subtitle has-text-weight-semibold">Statistiques du mois - <?= $current_month ?></h1>
				<div class="is-mar-bot-15">
									<a href="" class="button is-gamecenter-pink is-outlined" ng-click="refreshStats()">
					<span class="icon">
								<i class="fas fa-sync-alt is-medium"></i>
					</span>
					&nbsp;
					Charger les statistiques
				</a> 
				</div>

		<div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="tile is-child box hero is-gamecenter-pink is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-retweet is-medium"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Nbre Abonnés</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green" ng-bind="stats.monthly.gamer_registered">0</p>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-donate is-medium"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">CA Cumulé</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green" ng-bind="stats.monthly.cu_cumulated | currency:'F':0">0</p>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-coins is-medium"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Jetons Cumulés</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green" ng-bind="stats.monthly.coins_cumulated">0</p>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-gift is-medium"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Bonus Distribués</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green" ng-bind="stats.monthly.bonus_gave">0</p>
						</div>
					</div>
				</div>
			</div>
         </div>

				<!-- Tabular view -->
				<table class="table is-hoverable is-striped is-fullwidth">
					<thead>
						<tr class="gamecenter-pink-b">
							<th class="has-text-white">Nom</th>
							<th class="has-text-white">Code</th>
							<th class="has-text-white">Catégorie</th>
							<th class="has-text-white">Inscription</th>
							<th class="has-text-white">Dernier Passage</th>
							<th class="has-text-white">Contact</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="gamer in stats.monthly.gamer_registered_list" ng-class="analyze_gamer(gamer)">
							<td>{{gamer.gamer_fullname}}</td>
							<td>{{gamer.gamer_identity}}</td>
							<td>{{gamer.gamer_category}}</td>
							<td class="has-text-centered">{{gamer.created | date :'dd/MM/yyyy HH:mm:ss'}}</td>
							<td ng-bind="get_last_crossing(gamer.gamer_cards[0])">&nbsp;</td>
							<td class="has-text-centered">{{gamer.gamer_details.contact}}</td>


						</tr>
					</tbody> 
				</table>




	<!-- Today Stats Preview - Observator & system -->
	<h1 class="subtitle has-text-weight-semibold">Statistiques du jour</h1>
	<div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="tile is-child box hero is-gamecenter-pink is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-retweet is-medium"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Passages enregistrés</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green" ng-bind="stats.today.crossing_today_count">0</p>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-donate is-medium"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">CA Cumulé</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green" ng-bind="stats.today.crossing_today_sum_amount | currency:'F':0">0</p>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-coins is-medium"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Jetons Cumulés</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green" ng-bind="stats.today.crossing_today_coins">0</p>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-gift is-medium"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Bonus Distribués</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green" ng-bind="stats.today.crossing_today_bonus">0</p>
						</div>
					</div>
				</div>
			</div>
    </div>



	<!-- Page Loader -->
	<div class="pageloader is-left-to-right is-active is-gamecenter-blue" ng-show="is_loading" style="background:#110e39 url('/img/assets/image/minion_loading_stats.png') no-repeat 100% 100%;">
        <a class="navbar-item" href="#">
			<img src="/img/assets/logo/gamecenter.png" alt="Orange Security Projects" style="max-height: 100%;max-width:200px;">
		</a>
		<span class="title">Collecte des statistiques en cours</span>
	</div>



	<script type="text/javascript">
  $(document).ready(function() {
    $(".countup").flipTimer({
					date:"2018/02/10 10:00:00",
					timeZone:0,	//Time zone of New York
					past:true,
					borderRadius:0,
					bgColor:"#000",
					dividerColor:"#666",
					digitColor:"#f85800",
					textColor:"#f85800",
					boxShadow:false
    });
  });
</script>

</section>



