<style>
	.modal-hover-tabs li:not(.is-active) a:hover{
		color: #ec008c !important;
		background: black !important;
		transition-duration: 300ms;
	}

	.modal-hover-tabs li.is-active a{
		color: #ec008c !important;
	}
</style>

<div class="modal {{showWorkflowModalTrigger}}" id="show_workflow_modal">
  <div class="modal-background" ng-click="closeWorkflowModal()"></div>
  <div class="modal-card" style="width:70%;">
    <header class="modal-card-head is-none-radius gamecenter-pink-b">
      <p class="modal-card-title has-text-white">Informations Gamers</p>
      <button class="delete" type="button" ng-click="closeWorkflowModal()" aria-label="close"></button>
    </header>
    <section class="modal-card-body is-pad-top-0 is-pad-rgt-0 is-pad-lft-0">
	<div class="tabs is-centered is-boxed if-fullwidth oci-orange-b">
	  <ul class="modal-hover-tabs">
	    <li class="is-active">
	      <a ng-click="workflow_tab = 'history'">
	        <span class="icon is-small"><i class="fas fa-history"></i></span>
	        <span>Passages</span>
	      </a>
	    </li>
	  </ul>
	</div>
	<!-- TAbs Switch Area -->
	<div ng-switch on="workflow_tab">
		<div ng-switch-when="history">
			<!-- History table -->
			<table class="table is-fullwidth is-striped is-hoverable">
				<thead>
					<tr>
						<th>Action</th>
						<th>Caissier</th>
						<th>Date</th>
						<th>Jetons</th>
						<th>Equivalence</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Enregistrement passage</td>
						<td>Jonas</td>
						<td>05-04-2018 10H15</td>
						<td>10</td>
						<td>5 000 F CFA</td>
					</tr>
					<tr>
						<td>Enregistrement passage</td>
						<td>Jonas</td>
						<td>05-04-2018 10H15</td>
						<td>10</td>
						<td>5 000 F CFA</td>
					</tr>					
					<tr>
						<td>Enregistrement passage</td>
						<td>Jonas</td>
						<td>05-04-2018 10H15</td>
						<td>10</td>
						<td>5 000 F CFA</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
    </section>
    <footer class="modal-card-foot is-none-radius">
      <button class="button is-black" type="button" ng-click="closeWorkflowModal()">Fermer</button>
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

