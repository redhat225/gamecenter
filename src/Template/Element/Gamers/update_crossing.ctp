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
</style>

<div class="modal {{show_update_crossing_modal}}" id="show_update_crossing_modal">
  <div class="modal-background" ng-click="closeUpdateCrossModal()"></div>
  <div class="modal-card" style="width:70%;">
    <header class="modal-card-head is-none-radius gamecenter-blue-b">
		<a ui-sref="admins.dashboard" class="navbar-item">
			<img src="/img/assets/logo/gamecenter.png" alt="Orange Security Projects" style="max-height: 100%;max-width:120px;" >
		</a>
      <p class="modal-card-title has-text-white has-text-right">Modifier un passage</p>
      <button class="delete" type="button" ng-click="closeWorkflowModal()" aria-label="close"></button>
    </header>
    <section class="modal-card-body is-pad-top-0 is-pad-rgt-0 is-pad-lft-0">

    <!-- Form update crossing -->
	<form name="updateCrossingForm" ng-submit="updateCrossing(modified_crossing)">
				<!-- amount -->
				<div class="field is-horizontal is-pad-top-30 is-pad-bot-30">
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
				        <input class="input has-text-gamecenter-pink has-text-weight-semibold"  ng-model="modified_crossing.transit_amount" ng-change="update_convert_transit_amount()" ng-pattern="/^[0-9]{1,8}$/" type="number" required>
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
				        <input class="input is-static has-text-gamecenter-pink has-text-weight-semibold" ng-model="modified_crossing.transit_value_mock" readonly type="number" ng-pattern="/^[0-9]{1,3}$/" placeholder="equivalence en jetons">
				      </p>
				    </div>
				  </div>
				</div>
				<!-- Submit form -->
			    <div class="field is-horizontal is-pad-top-30">
					   <div class="field-label">
					   	  <label for="" class="label">&nbsp;</label>
					   </div>
					   <div class="field-body">
					   	<div class="field">
					   		<div class="control">
					   			<button class="button is-gamecenter-pink is-outlined" ng-disabled="is_loading || updateCrossingForm.$invalid" type="submit">Modifier</button>
					   		</div>
					   	</div>
					   </div>
				</div>
	</form>

	<!-- Page Loader -->
	<div class="pageloader is-left-to-right is-active is-gamecenter-blue" ng-show="is_loading" style="background:#110e39 url('/img/assets/image/minion_loading.png') no-repeat 30% 100%;">
        <a class="navbar-item" href="#">
			<img src="/img/assets/logo/gamecenter.png" alt="Orange Security Projects" style="max-height: 100%;max-width:200px;">
		</a>
		<span class="title">Enregistrement en cours</span>
	</div>

    </section>
    <footer class="modal-card-foot is-none-radius black-b">
      <button class="button is-gamecenter-pink is-outlined" ng-disabled="is_loading" type="button" ng-click="closeUpdateCrossModal()">Fermer</button>
    </footer>
  </div>	
</div>

