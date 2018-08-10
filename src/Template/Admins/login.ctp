<style>
	.loginForm input:focus{
        border-color: #C1872A;
        box-shadow: 0 0 0 0.125em rgba(193, 135, 42, 0.25);
	}
</style>



<div class="columns is-centered is-mar-bot-0" style="background:black; overflow: hidden; position: relative;" ng-controller="LoginController as logincontroller">
	<div class="column is-4 is-pad-bot-200">
		<div class="section is-medium">
               <div class="has-text-left-mobile has-text-centered-widescreen">
					<figure class=>
						<img src="/img/assets/logo/gamecenter.png" width="55%" alt="">
					</figure>
               </div>
                     <div>
						<form ng-submit="logincontroller.login(logincontroller.credentials)" name="loginBlogForm" class="is-pad-top-40">
							<!-- Identifiant -->
							<div class="field">
							  <label class="label has-text-white">Identifiant</label>
							  <div class="loginForm control has-icons-right has-icons-left">
							    <input class="input" name='username' required ng-model="logincontroller.credentials.username" type="text" ng-minlength="2" ng-maxlength="20" placeholder="Identifiant">
								 	<span class="icon is-small is-left">
								 		<i class="fa fa-user-o" aria-hidden="true"></i>
								 	</span>
								    <span ng-if="loginBlogForm.username.$valid" class="icon is-small is-right">
								      <i class="fa fa-check has-text-success"></i>
								    </span>
							  </div>
							</div>
							<!-- Mot de passe -->
							<div class="field">
							  <label class="label has-text-white">Mot de Passe</label>
							  <div class="loginForm control has-icons-left has-icons-right">
							    <input class="input" name="password" required ng-minlength="8" ng-maxlength="20" ng-model="logincontroller.credentials.password" type="password" placeholder="Mot de passe">
							    <span class="icon is-small is-left">
							    	<i class="fa fa-lock" aria-hidden="true"></i>
							    </span>
							    <span ng-if="loginBlogForm.password.$valid" class="icon is-small is-right">
								      <i class="fa fa-check has-text-success"></i>
								</span>
							  </div>
							</div>
							
							<div class="field is-horizontal is-pad-top-40">
									<div class="field-body">
										<div class="field">
											<p class="control is-fullwidth">
						                          <button ng-disabled="loginBlogForm.$invalid || logincontroller.is_authenticating" class="button is-fullwidth is-gamecenter-pink {{logincontroller.isSubmitting}}" type="submit">
						                                <span class="has-text-weight-bold">Connexion</span>
						                          </button>
											</p>
										</div>
									</div>
							</div>
							<div class="field is-horizontal is-pad-top-5">
									<div class="field-body">
										<div class="field">
											<p class="control is-fullwidth">
		                   						<button class="button has-text-weight-bold is-white is-outlined is-fullwidth" ng-click="logincontroller.forgotpassword()">Mot de passe oublié</button>
											</p>
										</div>
									</div>
							</div>
						</form>
               </div>


		</div>
	</div>
</div>

