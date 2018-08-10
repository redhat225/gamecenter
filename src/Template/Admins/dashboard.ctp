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
		<div class="level-right">
			<div class="level-item">
				<a href="" class="button is-gamecenter-pink is-outlined" ng-click="refreshStats()">
					<span class="icon">
								<i class="fas fa-sync-alt is-medium"></i>
					</span>
					&nbsp;
					Actualiser
				</a> 	
			</div>
		</div>
	</div>
		<!-- Today Stats Preview - Observator & system -->
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




	<div class="tile is-ancestor">
		<div class="tile is-parent">
			<div class="tile is-7 is-child box is-pad-full-0 is-none-radius">
				<div class="panel">
					<div class="panel-heading  gamecenter-blue-b is-pad-rgt-0 is-pad-rgt-0">
						<div>
							<span class="icon">
								<i class="fas fa-2x fa-chart-area has-text-white"></i>
							</span>
							<span class="has-text-white has-text-weight-semibold is-pad-lft-20 is-size-6">Statistiques des Jetons Collectés/mois</span> 
						</div>
					</div>
					<div class="panel-block">
						<canvas  id="line" class="chart chart-line" chart-data="data"
						chart-labels="labels" chart-colors="colors" chart-series="series" chart-options="options"
						chart-dataset-override="datasetOverride" chart-click="onClick">
						</canvas>
					</div>
				</div>

			</div>
			<div class="tile is-1 is-child">
				&nbsp;
			</div>
			<!-- Doughnout -->
			<div class="tile is-4 is-child box is-pad-full-0 is-none-radius">
				<div class="panel">
					<div class="panel-heading gamecenter-blue-b is-pad-rgt-0">
						<div>
							<span class="icon">
							<i class="fas fa-2x fa-thermometer-three-quarters has-text-white"></i>
							</span>
							<span class="has-text-white has-text-weight-semibold is-pad-lft-20 is-size-6">Etat Mois Avril</span> 	
						</div>
					</div>
					<div class="panel-block">
						<canvas chart-colors="colors" id="pie" width="100%" height="100%" class="chart chart-pie"
						  chart-data="data_pie" chart-labels="labels_pie" chart-options="options">
						</canvas>
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



