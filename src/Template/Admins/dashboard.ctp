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
	<div class="level">
		<div class="level-left">
			<div class="level-item">
				<span class="icon">
					<i class="far fa-calendar-check"></i>
				</span>
				<span class="has-text-intercoton-green has-text-weight-semibold is-pad-lft-20">Aujourd'hui</span> 	
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
								<i class="fab fa-bitcoin"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Jetons Enregistrés</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">534</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.projects.create">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box  hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-gamepad"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Passages</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">40</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.cooperatives.create({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box  hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon">
								<i class="fas fa-gamepad"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Gamers</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">27</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.cooperatives.create({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="tile is-parent">
				<div class="tile is-child box  hero is-gamecenter-blue is-none-radius">
					<div class="media">
						<div class="media-left">
							<span class="icon medium">
								<i class="fas fa-boxes"></i>
							</span>
							 <span class=""></span>
						</div>
						<div class="media-content">
							<p class="is-size-5 has-text-weight-semibold has-text-intercoton-green">Collectés</p>
							<p class="is-size-3 has-text-weight-semibold has-text-intercoton-green">267 000 CFA</p>
						</div>
						<div class="media-right">
							<span class="icon button is-medium is-intercoton-green" ui-sref="admins.cooperatives.create({page_id:1})">
								<i class="fa fa-plus"></i>
							</span>
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



