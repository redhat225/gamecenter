<section ui-view>
	<div class="columns">
		<div class="column">
			 <h3 class="title">Configurations</h3>
			 <form name="customOptions" ng-submit="edit_custom_options(custom_options)">
				 <div class="field is-horizontal">
				 	<div class="field-label">
					<label for="" class="label">Valeur (CFA) 1 jeton</label>
				 	</div>
				 	<div class="field-body">
				 		<div class="field has-addons">
				 			<p class="control">
				 			  <input type="text" class="has-text-gamecenter-pink has-text-weight-semibold is-size-5" ng-model="custom_options.option_current_coin_value">	
				 			</p>
				 			<p>
				 			    <a href="" class="button is-gamecenter-pink">
				 					<span class="has-text-weight-semibold">F CFA</span>
				 				</a>
				 			</p>
				 		</div>
				 	</div>
				 </div>
					<!-- Buttons controls -->
					<div class="field is-grouped is-pad-top-10">
						<div class="field-label">
							<label for="" class="label"></label>
						</div>
						<div class="field-body">
						  <p class="control is-mar-rgt-30">
						    <button type="submit" ng-disabled="customOptions.$invalid || is_loading" class="button is-gamecenter-pink" ng-class="{{is_loading}}">
						      Changer
						    </button>
						  </p>
						  <p class="control">
						    <button ui-sref="admins.dashboard" type="reset" class="button is-black">
						      Annuler
						    </button>
						  </p>
						</div>
					</div>
			 </form>

		</div>
	</div>
</section>