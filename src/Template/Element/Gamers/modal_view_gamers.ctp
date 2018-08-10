<style>
	.actor_selected{
		background:#ffa50047 !important;
	}
</style>

<div class="modal {{show_modal_view_gamer}}" id="update_actor_modal">
  <div class="modal-background" ng-click="closeModalViewGamers()"></div>
  <div class="modal-card">
    <header class="modal-card-head is-none-radius gamecenter-blue-b">
		<a>
			<img src="/img/assets/logo/gamecenter.png" alt="Game Center" style="max-height: 100%;max-width:120px;" >
		</a>
      <p class="modal-card-title has-text-white has-text-right">Modifier un utilisateur</p>
      <button class="delete" type="button" ng-click="closeModalViewGamers()" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
    	<!-- Search Area -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">
						Recherche
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left">
							<input type="text" ng-model="search_gamers_side_menu" class="input">
							<span class="icon is-small is-left">
								<i class="fas fa-search"></i>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="actor_zone">
			<table class="table is-striped is-narrow is-hoverable is-fullwidth">
				<tbody>
					<tr class="actor_cadre" ng-repeat="gamer in gamers | filter:search_gamers_side_menu">
							<td>{{gamer.gamer_fullname}}</td>
							<td>{{gamer.gamer_identity}}</td>
							<td class="has-text-centered">{{gamer.gamer_category}}</td>
							<td>{{gamer.gamer_cards[0].card_identity}}</td>
							<td ng-bind="get_last_crossing(gamer.gamer_cards[0])">&nbsp;</td>
							<td>
								<button class="button is-gamecenter-pink is-outlined" ui-sref="admins.gamers.edit({gamer_id:gamer.id})" ng-click="closeModalViewGamers()">
									<span class="icon">
										<i class="fas fa-info"></i>
									</span>
									<span>
										Modifier
									</span>
								</button>
							</td>
					</tr>
				</tbody>
			</table>

			</div>

    </section>
    <footer class="modal-card-foot is-none-radius black-b">
      <button class="button is-gamecenter-pink is-outlined" type="button" ng-click="closeModalViewGamers()">Fermer</button>
    </footer>
  </div>	
</div>

