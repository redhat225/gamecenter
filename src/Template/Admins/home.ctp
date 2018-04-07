<!-- Navbar -->
<?= $this->element('navbar') ?>

<div class="columns is-mar-bot-0" style="position:relative; overflow: hidden;">
	<div id="side-menu" class="column is-2 is-pad-rgt-0 is-pad-top-0 is-mar-top-10 is-pad-bot-0 black-b" style="position:relative; overflow:hidden;">
		<?= $this->element('side-menu') ?>
	    <?= $this->element('about-me') ?>

	</div>
	<div id="wide-menu" class="column is-10 is-pad-top-50 is-mar-top-10 is-pad-lft-50" style="background-color: #fff; border-left:2px solid #ec008c;overflow-y: scroll;">
		<!-- Main Section -->
		<section ui-view ng-hide="preloader"></section>
        <div class="dropdown is-hoverable">
	

        <!-- Down image -->
        <div class="is-position-relative" ng-hide="preloader">    
			<figure class="is-position-absolute is-hidden-mobile" style="bottom:0px; left:-180px; z-index: -9999;">
					<img src="/img/assets/skeleton/loader_static_2.png" alt="">
			</figure>
        </div>
	</div>



<script>
	$('.trigger-resizer').on('click', function(){
		$('#side-menu').toggleClass('is-display-none');
		$('#wide-menu').toggleClass('is-10');
	});
</script>