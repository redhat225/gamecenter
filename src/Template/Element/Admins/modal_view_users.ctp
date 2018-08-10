<style>
	.actor_selected{
		background:#ffa50047 !important;
	}
</style>

<div class="modal {{show_modal_view_users}}" id="add_actor_modal">
  <div class="modal-background" ng-click="closeModalViewUsers()"></div>
  <div class="modal-card">
    <header class="modal-card-head is-none-radius gamecenter-blue-b">
		<a>
			<img src="/img/assets/logo/gamecenter.png" alt="Game Center" style="max-height: 100%;max-width:120px;" >
		</a>
      <p class="modal-card-title has-text-white has-text-right">Modifier un utilisateur</p>
      <button class="delete" type="button" ng-click="closeModalViewUsers()" aria-label="close"></button>
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
							<input type="text" ng-model="search_actors_side_menu" class="input">
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
					<tr class="actor_cadre" ng-repeat="u in users | filter:search_actors_side_menu">
						<td>
							<figure class="">
								<img width="100px" ng-src="/img/assets/admins/photo/{{u.user_photo}}">
							</figure>
						</td>
						<td>
							  <p>
						        <strong>{{u.user_fullname}}</strong>
						        <br>
								{{u.user_job}}
						      </p>
						</td>
						<td>
						      <p>
						      	 <button type="button" ng-click="closeModalViewUsers()" ui-sref="admins.accounts.edit({user_id:u.id})" class="button is-outlined is-gamecenter-pink is-outlined">
									<span class="icon">
										<i class="far fa-edit"></i>
									</span>
									<span>
										Modifier
									</span>
								</button>
						      </p>
						</td>
					</tr>
				</tbody>
			</table>

			</div>

    </section>
    <footer class="modal-card-foot is-none-radius black-b">
      <button class="button is-black" type="button" ng-click="closeModalViewUsers()">Fermer</button>
    </footer>
  </div>	
</div>

