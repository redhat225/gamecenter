<!-- Home interface -->
<nav class="navbar is-pad-top-5 is-pad-bot-5 gamecenter-blue-b" style="border-bottom:2px solid #ec008c; background: black;">
	<div class="navbar-brand">
		<a ui-sref="admins.dashboard" class="navbar-item">
			<img src="/img/assets/logo/gamecenter.png" alt="Orange Security Projects" style="max-height: 100%;max-width:120px;" >
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
			
			<a class="navbar-item" ui-sref="admins.sessions({page_id:1})">
				<span class="icon has-text-white">
					<i class="fa fa-sticky-note" aria-hidden="true"></i>
					<b class="is-mar-lft-5">{{$root.brief_stats.reports_count}}</b>
				</span>
			</a>
					<a class="navbar-item" ui-sref="admins.cooperatives({page_id:1})">
						<span class="icon has-text-white">
							<i class="far fa-calendar-alt"></i>
							<b class="is-mar-lft-5">{{$root.brief_stats.cooperatives_count}}</b>
						</span>
					</a>
					<a class="navbar-item" ui-sref="admins.zones({page_id:1})">
						<span class="icon has-text-white">
							<i class="fa fa-globe" aria-hidden="true"></i>
							<b class="is-mar-lft-5">{{$root.brief_stats.zones_count}}</b>
						</span>
					</a>
					<a class="navbar-item" ui-sref="admins.auditors({page_id:1})">
						<span class="icon has-text-white">
							<i class="fa fa-users" aria-hidden="true"></i>
							<b class="is-mar-lft-5">{{$root.brief_stats.auditor_accounts_count}}</b>
						</span>
					<div class="navbar-item has-dropdown is-hoverable" class="account-dropdown">
						<a class="navbar-link has-text-white" >
							<span class="has-text-weight-semibold has-text-white">missago&nbsp;</span>
								<figure class="image is-32x32">
									  <img src="/img/assets/admins/avatar/miss.png" alt="" style="max-height:100%; border-radius:50%;">
								</figure>
						</a>

						<div class="navbar-dropdown gamecenter-pink-b">
							  <a class="navbar-item" ui-sref="admins.profile.edit" ui-sref-active="is-active">
							   <span class="has-text-white">Mon profil</span> 
							  </a>
							   <a class="navbar-item" href="/admins/logout" target="_self">
							   <span class="has-text-white">Déconnexion</span> 
							  </a>
						</div>	
					</div>

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