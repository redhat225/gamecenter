<style>

.menu-list a{
	color: white;
}
	.menu-list a.active{
		background: #ec008c;
		transition-duration: 300ms;

	}

	.menu-list a.is-active{
		background: #ec008c;
		transition-duration: 300ms;

	}

	.menu-item-wrapper.is-active .menu-item .menu-icon, .menu-item-wrapper.is-active .menu-item .menu-text{
			color: #ec008c !important;
		transition-duration: 300ms;

	}

	.menu-item-wrapper.is-active{
		background: #ec008c;
		transition-duration: 300ms;
	}

	.menu-list li a:hover{
		transition-duration: 300ms;
	}
</style>

<section class="is-small is-pad-bot-200 is-pad-top-0" style="min-height: 800px !important;">
	<div class="menu-wrapper">
		<aside class="menu is-mar-top-20">
		  <p class="menu-label has-text-gamecenter-pink">
		    Accueil
		  </p>
		  <ul class="menu-list">
		    <li class="is-mar-top-5"><a ui-sref="admins.dashboard" ui-sref-active="active"><span class="icon"><i class="fab fa-dyalog"></i></span> Dashboard</a></li>
		    <li class="is-mar-top-5"><a ui-sref="admins.crossings.view" ui-sref-active="active"><span class="icon"><i class="fab fa-patreon"></i></span>Passages</a></li>
		  </ul>
		  <p class="menu-label">
		    Administration
		  </p>
		  <ul class="menu-list">
		    <li>
		      <a class="menu-list-include-wrapper">Gérer Gamers</a>
		      <ul class="is-display-none">
		        <li><a ui-sref="admins.gamers.view">Vue globale</a></li>
		        <li><a ui-sref="admins.gamers.create">Ajouter</a></li>
		        <li><a ng-click="openModalViewUsers()">Modifier</a></li>
		      </ul>
		    </li>
		    <li>
		      <a class="menu-list-include-wrapper">Gérer Utilisateurs</a>
		      <ul class="is-display-none">
		        <li><a ui-sref="admins.accounts.view">Vue globale</a></li>
		        <li><a ui-sref="admins.accounts.create">Ajouter</a></li>
		        <li><a ng-click="openModalViewUsers()">Modifier</a></li>
		      </ul>
		    </li>
		    <li class="is-mar-top-5"><a class="remmanuel-info">A propos</a></li>
		  </ul>
		</aside>
	</div>
</section>


<script>
	$(document).ready(function(){
		$('.menu-list-include-wrapper').on('click', function(){
			$('.menu-list-include-wrapper').removeClass('active');
			$(this).toggleClass('is-active');
			if($(this).hasClass('is-active'))
			  $(this).next('ul').slideDown();
			else
			  $(this).next('ul').slideUp();

		});
	});
</script>


