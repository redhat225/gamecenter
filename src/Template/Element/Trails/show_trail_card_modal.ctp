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

<div class="modal {{show_trails_crossing_modal}}" id="show_trail_crossing_modal">
  <div class="modal-background" ng-click="closeShowTrailCrossModal()"></div>
  <div class="modal-card" style="width:70%;">
    <header class="modal-card-head is-none-radius gamecenter-blue-b">
		<a ui-sref="admins.dashboard" class="navbar-item">
			<img src="/img/assets/logo/gamecenter.png" alt="Orange Security Projects" style="max-height: 100%;max-width:120px;" >
		</a>
      <p class="modal-card-title has-text-white has-text-right">Trails CarteID: {{current_card_trailed.card_identity}}</p>
      <button class="delete" type="button" ng-click="closeShowTrailCrossModal()" aria-label="close"></button>
    </header>

    <footer class="modal-card-foot is-none-radius black-b">
      <button class="button is-gamecenter-pink is-outlined" ng-disabled="is_loading" type="button" ng-click="closeShowTrailCrossModal()">Fermer</button>
    </footer>
  </div>	
</div>

