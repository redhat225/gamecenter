<div class="modal  {{show_winner_raffle_modal}}">
  <div class="modal-background" ng-click="close_winner_raffle()"></div>
  <div class="modal-content gamecenter-blue-b" style="overflow-x: hidden; overflow-y: hidden">
  	<div class="columns" >
  		<div class="column">
			<div class="card">
			  <div class="card-image">
			    <figure class="has-text-centered gamecenter-blue-b">
		     		 <img src="/img/assets/image/minion_gift.png" style="width:200px;" alt="">
			    </figure>
			  </div>
			</div>
  		</div>
  		<div class="column" style="background: white;">
		    <p class="is-mar-top-30">
		    	 <span class="has-text-gamecenter-blue has-text-weight-semibold ">Félicitations à {{raffle_winner.gamer_fullname}} porteur du numéro {{raffle_winner.gamer_identity}} remporte le lot associé à la tombola {{raffle_winner.raffle}}</span>
					<br>
				  <button class="button is-gamecenter-pink is-outlined is-mar-top-25"  aria-label="close" ng-click="close_winner_raffle()">
				  	Merci
				  </button>
		    </p>

  		</div>
  	</div>

  </div>
  <button class="modal-close is-large" aria-label="close" ng-click="close_winner_raffle()"></button>
</div>	