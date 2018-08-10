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
		    <li class="is-mar-top-5"><a ui-sref="admins.dashboard" ui-sref-active="active"><span class="icon"><i class="fab fa-dyalog"></i></span>&nbsp;Dashboard</a></li>
		    <li>
		      <a class="menu-list-include-wrapper">
		      	<span class="icon">
		      		<i class="fas fa-retweet"></i>
		      	</span>
		       Passages
		   	  </a>
		      <ul class="is-display-none">
		        <li><a ui-sref="admins.crossings.view({page:1})" ui-sref-active='is-active'>Vue globale</a></li>
		      </ul>
		    </li>
		  </ul>
		  <p class="menu-label has-text-gamecenter-pink">
		    Administration
		  </p>
		  <ul class="menu-list">
		    <li>
		      <a class="menu-list-include-wrapper">
		        <span class="icon">
		        	<i class="fas fa-gamepad"></i>
		        </span> Gérer Gamers
		      </a>
		      <ul class="is-display-none">
		        <li><a ui-sref="admins.gamers.view({page:1})" ui-sref-active="is-active">Vue globale abonnés</a></li>
		        <li><a ui-sref="admins.gamers.create" ui-sref-active="is-active">Ajouter abonné</a></li>
		        <li><a ng-click="openModalViewGamers()">Modifier abonné</a></li>
		        <!-- Update Gamer -->
		        <?= $this->element('Gamers/modal_view_gamers') ?>
		        <li><a ui-sref="admins.gamers.raffles" ui-sref-active="is-active">
		         Tombola</a></li>
		      </ul>
		    </li>
		    <li>
		      <a class="menu-list-include-wrapper"><span class="icon">
		      	<i class="fas fa-users"></i>
		      </span> Gérer Utilisateurs</a>
		      <ul class="is-display-none">
		        <li><a ui-sref="admins.accounts.view({page:1})" ui-sref-active="is-active">Vue globale</a></li>
		        <li><a ui-sref="admins.accounts.create" ui-sref-active="is-active">Ajouter</a></li>
		        <!-- Update User -->
		        <?= $this->element('Admins/modal_view_users') ?>
		        <li><a ng-click="openModalViewUsers()">Modifier</a></li>
		      </ul>
		    </li>
		    <li class="is-mar-top-5"><a ui-sref="admins.options" class=""><span class="icon">
		    	<i class="fas fa-sliders-h"></i>
		    </span> Options</a></li>
		    <li class="is-mar-top-5"><a class="remmanuel-info"><span class="icon">
		    	<i class="fas fa-question-circle"></i>
		    </span>&nbsp;A propos</a></li>
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


