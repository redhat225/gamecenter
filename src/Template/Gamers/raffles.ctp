		<section ui-view>
			<form name="createRaffleForm" ng-submit="create(raffle)">
			<h3 class="subtitle">
				Tombola FidGame 
			</h3>
			<!-- Details Tombola -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Détails du Lot</label>
				</div>
				
				<div class="field-body">
					<div class="field">
						<div class="control is-pad-bot-20">
							<textarea required class="textarea" ng-model="raffle.raffle_details" placeholder="Détails du lot de la tombola"></textarea>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal is-mar-top-20 is-mar-bot-20">
				<div class="field-label">
					&nbsp;
				</div>
				<div class="field-body">
					<div class="field is-grouped">
						<div class="control">	
							<button ng-disabled="createRaffleForm.$invalid || is_loading" type="submit" class="button is-gamecenter-pink">
								Tirage au sort
							</button>
						</div>
						<div class="control">
							<button class="button is-black is-outlined" ui-sref="admins.dashboard">Annuler</button>
						</div>
					</div>
				</div>
			</div>
		</form>

				<!-- Tabular view -->
				<table class="table is-hoverable is-striped is-fullwidth">
					<thead>
						<tr class="gamecenter-pink-b">
							<th class="has-text-white">#</th>
							<th class="has-text-white">Id Tirage</th>
							<th class="has-text-white">Responsable Tirage</th>
							<th class="has-text-white">Date Tirage</th>
							<th class="has-text-white">Gagnant</th>
							<th class="has-text-white">ID Gamer</th>
							<th class="has-text-white">Détails tombola</th>
						</tr>
					</thead>
					<tbody ng-repeat="raffle in raffles">
						<tr class="">
							<td>{{$index+1}}</td>
							<td>{{raffle.raffle_identity}}</td>
							<td>{{raffle.user_account.user.user_fullname}}</td>
							<td>{{raffle.created |  date:'dd/MM/yyyy HH:mm:ss'}}</td>
							<td>{{raffle.gamer.gamer_fullname}}</td>
							<td>{{raffle.gamer.gamer_identity}}</td>
							<td class="has-text-centered">
								  <a href="#" class="is-primary is-tooltip-multiline tooltip" data-tooltip="{{raffle.raffle_details}}">
									    <span class="icon is-medium">
									      <i class="fas fa-info-circle has-text-gamecenter-pink"></i>
									    </span>
								  </a>
							</td>
						</tr>
					</tbody> 
				</table>

		<!-- raffl modal winner -->
		<?= $this->element('Raffles/winner') ?>
</section>
