<div>
	<h3 class="title has-text-gamecenter-pink">Modification Gamer</h3>
<!-- Forms registering -->
<div class="section is-pad-top-10" id="inscription">
	<div class="columns is-centered">
		<div class="column">
				<form ng-submit="update(gamer)" name="newGamerForm">
					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Nom Complet*
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="text" ng-maxlength="100" ng-minlength="5" required class="input is-uppercase" ng-model="gamer.gamer_fullname">
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Email*
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="email" class="input" required ng-model="gamer.gamer_details.email">
								</div>
							</div>
						</div>
					</div>


					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Jour de naissance
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="number" required class="input" ng-pattern="/^[0-9]{1,2}$/" ng-model="gamer.gamer_day_birth">
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Mois de naissance
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="number" required class="input" ng-pattern="/^[0-9]{1,2}$/" ng-model="gamer.gamer_month_birth">
								</div>
							</div>
						</div>
					</div>


					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Catégorie
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
								  <label class="radio">
								    <input type="radio" required name="foobar" ng-model="gamer.gamer_category" value="kid">
								      3-10 ans
								  </label>
								  <label class="radio">
								    <input type="radio" required name="foobar" ng-model="gamer.gamer_category" value="teenager">
								      11-20 ans
								  </label>

								  <label class="radio">
								    <input type="radio" required name="foobar" ng-model="gamer.gamer_category" value="adult">
								      + 21 ans
								  </label>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Contact
							</label>
						</div>
						<div class="field-body">
							<div class="field has-addons">
							  <p class="control">
							    <a class="button is-static">
							      +225
							    </a>
							  </p>
							  <p class="control">
							    <input class="input" type="text" required placeholder="08080808" ng-pattern="/^[0-9]{8}$/" ng-model="gamer.gamer_details.contact">
							  </p>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Lieu Habitation
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="text" class="input is-uppercase" ng-maxlength="100" required ng-model="gamer.gamer_details.home">
								</div>
							</div>
						</div>
					</div>


					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Compte Facebook
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="text" ng-maxlength="100" class="input" ng-model="gamer.gamer_details.social.facebook">
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
					   			<button class="button is-gamecenter-pink is-fullwidth" ng-disabled="newGamerForm.$invalid || is_loading" type="submit">Enregistrer</button>
					   		</div>
					   	</div>
					   	<div class="field">
					   		<div class="control">
					   			<button ng-disabled="is_loading" ui-sref="admins.gamers.view" class="button is-gamecenter-blue is-fullwidth" type="reset">Annuler</button>
					   		</div>
					   	</div>
					   </div>
					</div>
				</form>
		</div>
	</div>

</div>
</div>