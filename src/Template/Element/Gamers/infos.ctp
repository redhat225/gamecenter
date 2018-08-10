				<form ng-submit="null()" name="gamerInfoForm">
					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Nom Complet*
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="text" ng-maxlength="100" ng-minlength="5"  class="input is-uppercase has-text-weight-semibold has-text-gamecenter-pink" readonly ng-model="selected_crossing_gamer.gamer_fullname">
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
									<input type="email" readonly class="input has-text-weight-semibold has-text-gamecenter-pink"  ng-model="selected_crossing_gamer.gamer_details.email">
								</div>
							</div>
						</div>
					</div>


					<div class="field is-horizontal">
						<div class="field-label">
							<label for="" class="label has-text-gamecenter-blue">
								Anniversaire (jour-mois)
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="number" class="input has-text-gamecenter-pink has-text-weight-semibold" readonly ng-pattern="/^[0-9]{1,2}$/" ng-model="selected_crossing_gamer.gamer_day_birth">
								</div>
							</div>
						   <div class="field">
								<div class="control">
									<input type="number" class="input has-text-gamecenter-pink has-text-weight-semibold" readonly ng-pattern="/^[0-9]{1,2}$/" ng-model="selected_crossing_gamer.gamer_month_birth">
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
								    <input type="radio" class="has-text-gamecenter-pink has-text-weight-semibold" readonly disabled name="foobar" ng-model="selected_crossing_gamer.gamer_category" value="low">
								       <span class="has-text-gamecenter-pink has-text-weight-semibold">- 10 ans</span> 
								  </label>
								  <label class="radio">
								    <input type="radio" class="has-text-gamecenter-pink has-text-weight-semibold" readonly disabled name="foobar" ng-model="selected_crossing_gamer.gamer_category" value="mid">
								      <span class="has-text-gamecenter-pink has-text-weight-semibold">+ 10 ans</span> 
								  </label>

								  <label class="radio">
								    <input type="radio"  readonly disabled name="foobar" ng-model="selected_crossing_gamer.gamer_category" value="high">
								      <span class="has-text-gamecenter-pink has-text-weight-semibold">+ 25 ans</span> 
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
							    <a class="button is-gamecenter-pink">
							      +225
							    </a>
							  </p>
							  <p class="control">
							    <input class="input" type="text has-text-weight-semibold has-text-gamecenter-pink"  placeholder="08080808" ng-pattern="/^[0-9]{8}$/" ng-model="selected_crossing_gamer.gamer_details.contact">
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
									<input type="text" class="input is-uppercase has-text-gamecenter-pink has-text-weight-semibold" ng-maxlength="100"  ng-model="selected_crossing_gamer.gamer_details.home">
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
									<input type="text" ng-maxlength="100" class="input" ng-model="selected_crossing_gamer.gamer_details.social.facebook">
								</div>
							</div>
						</div>
					</div>
				</form>