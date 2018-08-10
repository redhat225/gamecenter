<!-- Home interface -->
<nav class="navbar is-pad-top-5 is-pad-bot-5 gamecenter-blue-b" style="border-bottom:2px solid #ec008c; background: black;">
	<div class="navbar-brand">
		<a ui-sref="admins.dashboard" class="navbar-item">
			<img src="/img/assets/logo/gamecenter.png" alt="Game Center" style="max-height: 100%;max-width:120px;" >
		</a>
		
		<a class="navbar-item trigger-resizer has-text-gamecenter-pink is-hidden-mobile">
			<span class="icon is-medium">
	       	  <i class="fas fa-bars is-ft-sz-25"></i>
	       </span>
		</a>


	    <button class="button navbar-burger">
	      <span></span>
	      <span></span>
	      <span></span>
	    </button>
	</div>
	<div class="navbar-menu">
		<div class="navbar-end">
			<a  class="navbar-item" href="/admins/logout" target="_self">
				<button class="button is-gamecenter-pink" ui-sref="admins.dashboard">
					<span class="icon">
						<i class="fab fa-dyalog"></i>
					</span>
					<span>
						Dashboard
					</span>
				</button>
			</a>	

			<div class="navbar-item is-pad-bot-0">
		        	<?= $this->element('Gamers/search_cards') ?>
     	            <?= $this->element('Gamers/add_crossing') ?>
     	            <?= $this->element('Gamers/update_crossing') ?>
     	            <?= $this->element('Gamers/award_crossing') ?>
     	            <?= $this->element('Trails/show_trail_card_modal') ?>
			</div>
			
					<a class="navbar-item" id="profile-section">
						<div class="navbar-item has-dropdown {{profile_dropdown_trigger}}" class="account-dropdown" ng-click="show_profile_menu()">
							<a class="navbar-link has-text-white gamecenter-blue-b">
								<span class="has-text-weight-semibold has-text-white">{{profile.username}}&nbsp;</span>
									<figure class="image is-32x32">
										  <img src="/img/assets/admins/avatar/{{profile.user_avatar}}" alt="" style="max-height:100%; border-radius:50%;">
									</figure>
							</a>

							<div class="navbar-dropdown gamecenter-blue-b">
								  <a class="navbar-item" ui-sref="admins.profiles.edit" ui-sref-active="is-active">
								   <span class="has-text-white">Mon profil</span> 
								  </a>
								   <a class="navbar-item" href="/admins/logout" target="_self">
								   <span class="has-text-white">Déconnexion</span> 
								  </a>
							</div>	
						</div>
					</a>
			<a  class="navbar-item" href="/admins/logout" target="_self">
				<button class="button is-black">
					<span class="icon">
						<i class="fa fa-power-off has-text-white"></i>
					</span>
					<span>
						Déconnexion
					</span>
				</button>
			</a>
		</div>
	</div>
</nav>

<script>
	$(document).ready(function(){
		$('.navbar-burger').bind('click', function(e){
			e.preventDefault();
			$(this).toggleClass('is-active');
		});

		$('.trigger-resizer').on('click')
	});
</script>