<section ui-view>
	<div class="columns">
		<div class="column">
			<nav class="breadcrumb" aria-label="breadcrumbs">
			  <ul>
			    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
			    <li><a >Gamers</a></li>
			    <li class="is-active"><a >Vue Globale</a></li>
			  </ul>
			</nav>
		</div>
		<div class="column">
				<div class="field has-addons is-expanded">
					<div class="control is-expanded">
						<input type="text" class="input" ng-model="filter_keys">
					</div>
					<div class="control">
						<a class="button is-gamecenter-blue">
							<span class="icon">
								<i class="fa fa-search"></i>
							</span>
							<span>Rechercher</span>
						</a>
					</div>
				</div>
		</div>
		<div class="column">
				<button class="button is-gamecenter-pink" ui-sref="admins.gamers.create">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span>Ajouter un Gamer</span>
				</button>
		</div>
	</div>

	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30">
     		<div class="level-left">
     			<div class="span level-item">
     				&nbsp;
     			</div>
     		</div>
     		<div class="level-right">
				<div class="field has-addons level-item">
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="previous_page()" ng-disabled="is_loading">
				      <span class="icon is-small">
				        <i class="fa fa-chevron-left"></i>
				      </span>
				      <span class="has-text-weight-semibold">Précédent</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-static is-disabled">
				      <span ng-bind="pagination.current_page" ng-hide="is_loading">1</span> sur <span ng-bind="pagination.all_pages" ng-hide="is_loading">45</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="next_page()" ng-disabled="is_loading">
				      <span class="has-text-weight-semibold">Suivant</span>
				      <span class="icon is-small">
				        <i class="fa fa-chevron-right"></i>
				      </span>
				    </a>
				  </p>
				</div>
     		</div>
     	</div>
		<div>
				<!-- Tabular view -->
				<table class="table is-hoverable is-striped is-fullwidth">
					<thead>
						<tr class="gamecenter-pink-b">
							<th class="has-text-white">Nom</th>
							<th class="has-text-white">Code</th>
							<th class="has-text-white">Nombres Passages Cumulés</th>
							<th class="has-text-white">Jetons Cumulés</th>
							<th class="has-text-white">Equivalence</th>
							<th class="has-text-white">Premier passage</th>
							<th class="has-text-white">Dernier Passage</th>
							<th class="has-text-white">Plus informations</th>
							<th class="has-text-white">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr  class="">
							<td>RIEHL Emmanuel</td>
							<td>GC-5855</td>
							<td class="has-text-centered">18</td>
							<td class="has-text-centered">100</td>
							<td class="has-text-centered">50 000 F CFA</td>
							<td>01-01-2018 18H45</td>
							<td>01-04-2018 18H45</td>
							<td>
								<button class="button is-gamecenter-pink is-outlined" ng-click='openViewModal(project)'>
									<span class="icon">
										<i class="fas fa-info"></i>
									</span>
									<span>
										+infos
									</span>
								</button>
							</td>
				  			<td>
							   <div class="dropdown is-hoverable is-right">
								   <div class="dropdown-trigger">
										   <button class="button">
											    <span class="icon is-small">
								   <i class="fas fa-cogs menu-icon"></i>
											    </span>
										   </button>
								   </div>
								   <div class="dropdown-menu" id="dropdown-menu" role="menu">
										   <div class="dropdown-content">
													  <h3 class="is-size-7 has-text-gamecenter-pink has-text-weight-bold">Gamer</h3>
													 <a target="_blank" href="/projects/preview/{{project.id}}.pdf" target="_blank" class="dropdown-item">
											            	Créer un passage
													 </a>
													  <a ui-sref="admins.projects.edit({project_id:project.id})" class="dropdown-item">
											            	Modifier Gamer
													 </a>
													   <a ng-click="showWorkflowModal()" class="dropdown-item">
															Supprimer Gamer
													 </a>
											    </div>
											  </div>
									    </div>
				  			</td>
						</tr>
						<tr  class="">
							<td>RIEHL Kim</td>
							<td>GC-5955</td>
							<td class="has-text-centered">8</td>
							<td class="has-text-centered">200</td>
							<td class="has-text-centered">100 000 F CFA</td>
							<td>03-01-2018 08H45</td>
							<td>05-04-2018 18H45</td>
							<td>
								<button class="button is-gamecenter-pink is-outlined" ng-click='openViewModal(project)'>
									<span class="icon">
										<i class="fas fa-info"></i>
									</span>
									<span>
										+infos
									</span>
								</button>
							</td>
				  			<td>
							   <div class="dropdown is-hoverable is-right">
								   <div class="dropdown-trigger">
										   <button class="button">
											    <span class="icon is-small">
								   <i class="fas fa-cogs menu-icon"></i>
											    </span>
										   </button>
								   </div>
								   <div class="dropdown-menu" id="dropdown-menu" role="menu">
										   <div class="dropdown-content">
													  <h3 class="is-size-7 has-text-gamecenter-pink has-text-weight-bold">Gamer</h3>
													 <a target="_blank" href="/projects/preview/{{project.id}}.pdf" target="_blank" class="dropdown-item">
											            	Créer un passage
													 </a>
													  <a ui-sref="admins.projects.edit({project_id:project.id})" class="dropdown-item">
											            	Modifier Gamer
													 </a>
													   <a ng-click="showWorkflowModal()" class="dropdown-item">
															Supprimer Gamer
													 </a>
											    </div>
											  </div>
									    </div>
				  			</td>
						</tr>
						<tr  class="">
							<td>RIEHL Karine</td>
							<td>GC-5450</td>
							<td class="has-text-centered">8</td>
							<td class="has-text-centered">80</td>
							<td class="has-text-centered">40 000 F CFA</td>
							<td>03-01-2018 08H45</td>
							<td>05-04-2018 18H45</td>
							<td>
								<button class="button is-gamecenter-pink is-outlined" ng-click='openViewModal()'>
									<span class="icon">
										<i class="fas fa-info"></i>
									</span>
									<span>
										+infos
									</span>
								</button>
							</td>
				  			<td>
							   <div class="dropdown is-hoverable is-right">
								   <div class="dropdown-trigger">
										   <button class="button">
											    <span class="icon is-small">
								   <i class="fas fa-cogs menu-icon"></i>
											    </span>
										   </button>
								   </div>
								   <div class="dropdown-menu" id="dropdown-menu" role="menu">
										   <div class="dropdown-content">
													  <h3 class="is-size-7 has-text-gamecenter-pink has-text-weight-bold">Gamer</h3>
													 <a target="_blank" href="/projects/preview/{{project.id}}.pdf" target="_blank" class="dropdown-item">
											            	Créer un passage
													 </a>
													  <a ui-sref="admins.projects.edit({project_id:project.id})" class="dropdown-item">
											            	Modifier Gamer
													 </a>
													   <a ng-click="showWorkflowModal()" class="dropdown-item">
															Supprimer Gamer
													 </a>
											    </div>
											  </div>
									    </div>
				  			</td>
						</tr>
					</tbody> 
				</table>
		</div>
	</div>
	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30">
     		<div class="level-left">
     			<div class="span level-item">
     				&nbsp;
     			</div>
     		</div>
     		<div class="level-right">
				<div class="field has-addons level-item">
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="previous_page()" ng-disabled="is_loading">
				      <span class="icon is-small">
				        <i class="fa fa-chevron-left"></i>
				      </span>
				      <span class="has-text-weight-semibold">Précédent</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-static is-disabled">
				      <span ng-bind="pagination.current_page" ng-hide="is_loading">1</span> sur <span ng-bind="pagination.all_pages" ng-hide="is_loading">45</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="next_page()" ng-disabled="is_loading">
				      <span class="has-text-weight-semibold">Suivant</span>
				      <span class="icon is-small">
				        <i class="fa fa-chevron-right"></i>
				      </span>
				    </a>
				  </p>
				</div>
     		</div>
     	</div>
     	<!-- Modal Box Info passages -->
     	<?= $this->element('RoadClient/modal_info_road') ?>
</section>