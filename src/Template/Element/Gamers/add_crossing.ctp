<style>
	.modal-hover-tabs li:not(.is-active){
		background: #110e39 !important;
		transition-duration: 300ms;
	}

	.modal-hover-tabs li:not(.is-active) a:hover{
		color: #ec008c !important;
		transition-duration: 300ms;		
		background: black !important;
	}

	.modal-hover-tabs li.is-active a{
		color: #fff !important;
		background: #ec008c !important;
	}

	.crossing-canceled{
		color:#fff !important;
		background: grey !important;
	}
</style>

<div class="modal {{show_crossing_modal}}" id="show_workflow_modal">
  <div class="modal-background" ng-click="closeWorkflowModal()"></div>
  <div class="modal-card" style="width:70%;">
    <header class="modal-card-head is-none-radius gamecenter-blue-b">
		<a>
			<img src="/img/assets/logo/gamecenter.png" alt="Game Center" style="max-height: 100%;max-width:120px;" >
		</a>
      <p class="modal-card-title has-text-white has-text-right">Gérer Gamer</p>
      <button class="delete" type="button" ng-click="closeWorkflowModal()" aria-label="close"></button>
    </header>
    <section class="modal-card-body is-pad-top-0 is-pad-rgt-0 is-pad-lft-0">
	<div class="tabs is-centered is-boxed if-fullwidth oci-orange-b">
	  <ul class="modal-hover-tabs is-none-border">
	    <li class="is-active gamer-info">
	      <a ng-click="$root.crossing_tab = 'gamer_info'">
	        <span class="icon is-small"><i class="fas fa-gamepad"></i></span>
	        <span>Informations Gamer</span>
	      </a>
	    </li>
	    <li class="">
	      <a ng-click="$root.crossing_tab = 'new'">
	        <span class="icon is-small"><i class="fas fa-plus"></i></span>
	        <span>Nouveau Passage</span>
	      </a>
	    </li>
	    <li class="main-history">
	      <a ng-click="$root.crossing_tab = 'history'" >
	        <span class="icon is-small"><i class="fas fa-list-ol"></i></span>
	        <span>Passages</span>
	      </a>
	    </li>
	    <li id="main-full-history">
	      <a ng-click="$root.crossing_tab = 'full_history'">
	        <span class="icon is-small"><i class="fas fa-history"></i></span>
	        <span>Historique</span>
	      </a>
	    </li>
	  </ul>
	</div>
	<!-- TAbs Switch Area -->
	<div ng-switch on="$root.crossing_tab" ng-hide="is_loading">
		<div ng-switch-when="gamer_info">
			  <?= $this->element('Gamers/infos') ?>
		</div>
		<div ng-switch-when="new">
			<!-- new Crossing -->
			<form name="addCrossing" ng-submit="add_crossing(crossing)">
				<!-- Cuurent coin value -->
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Valeur courante jeton</label>
				  </div>
				  <div class="field-body">
				    <div class="field has-addons">
				        <div class="control">
						    <span class="has-text-weight-semibold has-text-gamecenter-pink">{{custom_options.option_current_coin_value}} F CFA</span>  
					  </div>
				    </div>
				  </div>
				</div>
				<!-- amount -->
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Montant Achats</label>
				  </div>
				  <div class="field-body">
				    <div class="field has-addons">
				        <div class="control">
						    <a class="button is-gamecenter-pink">
						      F CFA
						    </a>
					  </div>
				      <p class="control has-icons-left">
				        <input class="input has-text-gamecenter-pink has-text-weight-semibold"  ng-model="crossing.transit_amount" ng-change="convert_transit_amount(crossing)" ng-pattern="/^[0-9]{1,8}$/" type="number" required>
				            <span class="icon is-small is-left">
						      <i class="fas fa-money-bill-wave-alt"></i>
						    </span>
				      </p>

				    </div>
				  </div>
				</div>
				<!-- Amount equivalent -->
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Equivalence (jetons)</label>
				  </div>
				  <div class="field-body">
				    <div class="field has-addons">
				      <div class="control">
						    <a class="button is-gamecenter-pink">
						      <i class="fas fa-coins has-text-white"></i>
						    </a>
					  </div>
				      <p class="control">
				        <input class="input is-static has-text-gamecenter-pink has-text-weight-semibold" ng-model="crossing.transit_value_mock" readonly type="number" ng-pattern="/^[0-9]{1,3}$/" placeholder="equivalence en jetons">
				      </p>
				    </div>
				  </div>
				</div>
				<!-- Bonus Zone -->
				<div ng-hide="hide_bonus_zone">
				<!-- Total cumulé -->
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label"> Total cumulé <span class="icon tooltip is-tooltip-top" data-tooltip="15% de bonus du total cumulés au 11e passage">
                             <i class="fas fa-info-circle"></i>
                           </span></label>
				  </div>


				  <div class="field-body">
				    <div class="field">
				      <p class="control has-icons-left">
				        <input class="input has-text-gamecenter-pink is-none-border has-text-weight-semibold" ng-model="crossing.transit_total_mock" readonly type="number">
					   	  <span class="icon is-small is-left">
						      <i class="fas fa-gift has-text-gamecenter-pink"></i>
						 </span>
				      </p>
				    </div>
				  </div>
				</div>


				<!-- Bonus -->
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label"> Montant Bonus (15% Total) <span class="icon tooltip is-tooltip-top" data-tooltip="15% de bonus du total cumulés au 11e passage">
                             <i class="fas fa-info-circle"></i>
                           </span></label>
				  </div>



				  <div class="field-body">
				    <div class="field">
				      <p class="control has-icons-left">
				        <input class="input has-text-gamecenter-pink is-none-border has-text-weight-semibold" ng-model="crossing.transit_bonus_mock" readonly type="number">
					   	  <span class="icon is-small is-left">
						      <i class="fas fa-gift has-text-gamecenter-pink"></i>
						 </span>
				      </p>
				    </div>
				  </div>
				</div>

				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Equivalence Bonus(jetons)</label>
				  </div>
				  <div class="field-body">
				    <div class="field">
				      <p class="control has-icons-left">
				        <input class="input has-text-gamecenter-pink  is-none-border has-text-weight-semibold" ng-model="crossing.transit_bonus_coins_mock" readonly type="number" value="40">
				      	 <span class="icon is-small is-left">
						      <i class="fas fa-coins has-text-gamecenter-pink"></i>
						 </span>
				      </p>
				    </div>
				  </div>
				</div>

				</div>


				<div class="field is-horizontal">
					   <div class="field-label">
					   	  <label for="" class="label">&nbsp;</label>
					   </div>
					   <div class="field-body">
					   	<div class="field">
					   		<div class="control">
					   			<button class="button is-gamecenter-pink" ng-disabled="is_loading || addCrossing.$invalid" type="submit">Enregistrer</button>
					   		</div>
					   	</div>
					   </div>
				</div>
			</form>
		</div>
		<div ng-switch-when="history">
			<h1 class="subtitle has-text-weight-semibold has-text-gamecenter-pink">Carte active: {{selected_crossing_gamer.gamer_cards[0].card_identity}}</h1>
			<!-- History table -->
			<table class="table is-fullwidth is-striped is-hoverable">
				<thead>
					<tr>
						<th>#</th>
						<th>ID</th>
						<th>Date</th>
						<th>Operateur</th>
						<th>Montant</th>
						<th>valeur jeton</th>
						<th>Equivalence(jetons)</th>
						<th>Bonus(Jetons)</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat = "crossing in selected_crossing_gamer.gamer_cards[0].gamer_transits" ng-class="analyze_crossing(crossing)">
						<td>{{$index+1}}</td>
						<td>{{crossing.transit_identity}}</td>
						<td>{{crossing.created | date:'dd/MM/yyyy HH:mm'}}</td>
						<td>{{crossing.user_account.user.user_fullname}}</td>
						<td>{{crossing.transit_amount | currency:'F'}}</td>
						<td>{{crossing.transit_value | currency}}</td>
						<td>{{crossing.transit_coins}}</td>
						<td>{{crossing.transit_bonus}}</td>
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
											    <div class="dropdown-content gamecenter-blue-b">
													 <a ng-click="update_value(crossing)" class="dropdown-item button is-none-border is-outlined is-gamecenter-pink">
											            	Modifier Valeur
													 </a>
													 <a ng-if="crossing.transit_is_active" ng-click="cancel_crossing(crossing)" class="dropdown-item button is-none-border is-outlined is-gamecenter-pink">
											            	Annuler Passage
													 </a>
											    </div>
											  </div>
							</div>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td class="has-text-weight-semibold">Montant total</td>
						<td class="has-text-weight-semibold has-text-gamecenter-pink">{{selected_crossing_gamer.total_current_amount | currency:'F'}}</td>
						<td class="has-text-weight-semibold">Total Jeton</td>
						<td class="has-text-weight-semibold has-text-gamecenter-pink">{{selected_crossing_gamer.total_current_coin}}</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div ng-switch-when="full_history">
			<div ng-repeat="card in selected_crossing_gamer.gamer_cards">
				<h1 class="subtitle has-text-weight-semibold has-text-gamecenter-pink">CarteID: {{card.card_identity}}</h1>
				<!-- History table -->
				<table class="table is-fullwidth is-striped is-hoverable">
					<thead>
						<tr>
							<th>#</th>
							<th>ID</th>
							<th>Date</th>
							<th>Operateur</th>
							<th>Montant</th>
							<th>valeur jeton</th>
							<th>Equivalence(jetons)</th>
							<th>Bonus(jetons)</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="crossing in card.gamer_transits" ng-class="analyze_crossing(crossing)">
							<td>{{$index+1}}</td>
							<td>{{crossing.transit_identity}}</td>
							<td>{{crossing.created | date:'dd/MM/yyyy HH:mm'}}</td>
							<td>{{crossing.user_account.user.user_fullname}}</td>
							<td>{{crossing.transit_amount | currency:'F'}}</td>
							<td>{{crossing.transit_value | currency}}</td>
							<td>{{crossing.transit_coins}}</td>
							<td>{{crossing.transit_bonus}}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td>
								  <a class="button is-small is-gamecenter-blue" ng-click="show_trails_modal_trigger(card)">
								    <span class="icon is-small">
								      <i class="fas fa-archive"></i>
								    </span>
								  </a>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td class="has-text-weight-semibold">Montant total</td>
							<td class="has-text-weight-semibold has-text-gamecenter-pink" ng-bind="set_full_history_amount(card)"></td>
							<td class="has-text-weight-semibold">Total Jeton</td>
							<td class="has-text-weight-semibold has-text-gamecenter-pink" ng-bind="set_full_history_amount_coin(card)">
						    </td> 
						</tr>
					</tfoot>
				</table>

				<!-- full logs table -->
				<table class="table is-fullwidth is-striped is-hoverable" ng-show="card.archive_opened">
					<thead>
						<tr>
							<th>#</th>
							<th>ID</th>
							<th>Date</th>
							<th>Operateur</th>
							<th>Détails</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="trailer in current_card_trailers">
							<td>{{$index}}</td>
							<td>{{trailer.crossing_id}}</td>
							<td>{{trailer.created |date:'dd/MM/yyyy HH:mm'}}</td>
							<td>{{trailer.user_account.user.user_fullname}}</td>
							<td>{{trailer.trace_info}}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td>
								<a class="button is-outlined is-gamecenter-pink" ng-click="closeShowTrailCrossModal(card)">
									Fermer	
								</a>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>

		</div>
	</div>
	<!-- Page Loader -->
	<div class="pageloader is-left-to-right is-active is-gamecenter-blue" ng-show="is_loading" style="background:#110e39 url('/img/assets/image/minion_loading.png') no-repeat 30% 100%;">
        <a class="navbar-item" href="#">
			<img src="/img/assets/logo/gamecenter.png" alt="Orange Security Projects" style="max-height: 100%;max-width:200px;">
		</a>
		<span class="title">Enregistrement en cours</span>
	</div>

    </section>
    <footer class="modal-card-foot is-none-radius black-b">
      <button class="button is-gamecenter-pink is-outlined" ng-disabled="is_loading" type="button" ng-click="closeWorkflowModal()">Fermer</button>
    </footer>
  </div>	
</div>

<script>
	$(document).ready(function(){
		$('.modal-hover-tabs li').on('click', function(){
			$('.modal-hover-tabs li').removeClass('is-active');
			$(this).addClass('is-active');
		});
	});
</script>

