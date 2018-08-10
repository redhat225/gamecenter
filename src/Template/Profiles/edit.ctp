<section ui-view>
		<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li class="is-active"><a >Mon Profil</a></li>
					  </ul>
					</nav>
				</div>
		</div>




	<div class="edit-form-profiles box is-none-radius">
		<form name="editFormprofiles" ng-submit="update(profile)">
			<h3 class="subtitle">
				Informations personnelles 
			</h3>
			<!-- Photo -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Photo</label>
				</div>
				
				<div class="field-body">
					<!-- Current profile_photo -->
					<div class="field">
						<div class="control is-pad-bot-20">
							<figure class="image is-128x128">
								<img ng-src="/img/assets/admins/photo/{{profile.user.user_photo}}" alt="profile_photo">
							</figure>
						</div>
					</div>
				</div>
			
			</div>
			<!-- Nom complet -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Nom Complet</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input readonly ng-model="profile.user.user_fullname" ng-pattern='/^[^@&()"!_$*€£`+=\/;?#]+$/' name="profile_fullname" type="text" class="input is-uppercase is-border-none">
							<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
							</span>
														<span class="icon is-small is-right" ng-if="editFormprofiles.profile_fullname.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Sexe -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="profile_sexe" class="label">Sexe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<div class="wrapper">
								<span ng-if="profile.user.user_sexe == 'H'" class="has-text-weight-semibold">Homme</span>
								<span ng-if="profile.user.user_sexe == 'F'" class="has-text-weight-semibold">Femme</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Job -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="profile_contact" class="label">Intitulé du Poste</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input  readonly type="text" ng-model="profile.user.user_job" class="input is-border-none" name="profile_job">
							<span class="icon is-small is-left">
								<i class="fas fa-briefcase"></i>
							</span>
							<span class="icon is-small is-right" ng-if="editFormprofiles.profile_job.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Contact -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="profile_contact" class="label">Contact</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input readonly ng-pattern="/^[0-9]{8}$/" type="text" ng-model="profile.user.user_contact" class="input is-border-none" name="profile_contact">
							<span class="icon is-small is-left">
								<i class="fas fa-phone"></i>
							</span>
							<span class="icon is-small is-right" ng-if="editFormprofiles.profile_contact.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Email pro-->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="pro_email" class="label">Email</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input type="email" readonly ng-model="profile.user.user_email" class="input is-border-none" name="pro_email">
						<span class="icon is-small is-left">
								<i class="far fa-envelope"></i>
							</span>
							<span class="icon is-small is-right" ng-if="editFormprofiles.pro_email.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>
					</div>
				</div>
			</div>


			<h3 class="subtitle">
				Compte 
			</h3>
			<!-- Avatar -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="">
						Avatar
					</label>
				</div>
				<div class="field-body">
					<!-- Current profilesedit_photo -->
					<div class="field" ng-if="!profileseditctrl.is_changing_image">
						<div class="control is-pad-bot-65">
							<figure class="image is-128x128">
								<img ng-src="/img/assets/admins/avatar/{{profile.user_avatar}}" alt="profile.">
							</figure>
						</div>
	
						<button type="button" class="button is-warning has-text-weight-semibold" ng-click="profileseditctrl.is_changing_image = true">Changer</button>
					</div>
					<!-- Change profilesedit photo -->
					<div class="field" ng-if="profileseditctrl.is_changing_image">
						<!-- Preview new Photo -->
						<div class="preview is-pad-bot-60">
							<figure class="image is-128x128">
							   <img ngf-thumbnail="profile.user_account_avatar_candidate || '/img/assets/forms/image_upload_drag_area.png'">	
							</figure>
						</div>
						<!-- Choose photo -->
						<div class="button" ngf-select ng-model="profile.user_account_avatar_candidate" name="user_account_avatar_candidate" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="3MB">
							Choisir photo
						</div>
						<!-- Cancel choice -->
						<button class="button is-danger" type="button" ng-click="delete_user_account_avatar_candidate()">Annuler la modification</button>
					</div>
				</div>
			</div>
			<!-- Nom Utilisateur -->
			<div class="field is-horizontal">
					<div class="field-label">
						<label for="account_username" class="label">Nom Utilisateur</label>
					</div>
					<div class="field-body">
						<div class="field">
							<div class="control has-icons-left has-icons-right">
								<input required ng-pattern='/^[^@&()"!_$*€£`+=\/;?#]+$/' type="text" ng-model="profile.username" class="input" name="account_username">
								<span class="icon is-small is-left">
									<i class="fas fa-user-circle"></i>
								</span>
							</div>
						</div>
					</div>
			</div>
			<!-- Rôle -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="role_id" class="label">
						Privilèges
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<div>
								<span class="has-text-weight-semibold">{{profile.role.role_denomination}}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- old password -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Ancien mot de passe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input ng-required="profile.profile_accounts[0].account_password_old" ng-model="profile.profile_accounts[0].account_password_old" ng-pattern='/(?=.*[A-Z]+.*)(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[!@#$&*]+.*)/' ng-minlength="8" ng-maxlength="20" name="account_password_old" type="password" class="input is-uppercase">
							<span class="icon is-left is-small">
								<i class="fa fa-lock"></i>
							</span>
							<span class="icon is-right is-small" ng-if="editFormprofiles.account_password_old.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
							<p class="help" ng-if="editFormprofiles.account_password_old.$invalid">
								Le mot de passe doit contenir au moins une lettre minuscule, majuscule, carctère spécial et un nombre, enfin il doit mesurer au minimum 8 caractères.
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- New password -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Nouveau mot de passe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input ng-required="profile.profile_accounts[0].account_password_old" ng-model="profile.profile_accounts[0].account_password_new" name="account_password_new"  ng-minlength="8" ng-maxlength="20" type="password" ng-pattern='/(?=.*[A-Z]+.*)(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[!@#$&*]+.*)/' class="input is-uppercase">
							<span class="icon is-left is-small">
								<i class="fa fa-lock"></i>
							</span>
							<span class="icon is-right is-small" ng-if="editFormprofiles.account_password_new.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
							<p class="help" ng-if="editFormprofiles.account_password_new.$invalid">
								Le mot de passe doit contenir au moins une lettre minuscule, majuscule, carctère spécial et un nombre, enfin il doit mesurer au minimum 8 caractères.
							</p>
					   </div>
				</div>
			</div>
		</div>
			<!-- Submitting -->
			<div class="field is-horizontal is-mar-top-50">
				<div class="field-label">
					&nbsp;
				</div>
				<div class="field-body">
					<div class="field is-grouped">
						<div class="control">	
							<button ng-disabled="editFormprofiles.$invalid || isloading" type="submit" class="button is-gamecenter-pink">
								Modifier
							</button>
						</div>
						<div class="control">
							<button class="button is-black is-outlined" ui-sref="admins.dashboard">Annuler</button>
						</div>
					</div>
				</div>

			</div>
		</form>
	</div>
</section>
