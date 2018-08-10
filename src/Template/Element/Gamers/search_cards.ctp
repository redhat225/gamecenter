
            <div class="field has-addons has-addons-right">
                  <div class="dropdown is-hoverable" style="display: block !important;">
                    <div class="dropdown-trigger">
                       <div class="control is-expanded">
                          <input class="has-text-weigth-bold has-text-gamecenter-pink" ng-model="gamer_filter" class="is-uppercase" type="text" style="width: 140%;" aria-haspopup="true" aria-controls="dropdown-menu" placeholder="Rechercher un gamer">
                       </div>
                    </div>
                    <div class="dropdown-menu" id="dropdown-menu" role="menu" style="width: 140%; max-height: 300px;overflow-y: auto; overflow-x: hidden;">
                      <div class="dropdown-content gamecenter-blue-b" >
                        <a  href="#" ng-repeat="gamer in gamers | filter: gamer_filter" ng-click="set_crossing_gamer(gamer, $index)" class="dropdown-item search button is-outlined is-none-border is-gamecenter-pink">
                          <span class="has-text-weigth-semibold">{{gamer.gamer_cards[0].card_identity}} - {{gamer.gamer_fullname}}</span>
                        </a>
                      </div>
                    </div>
                  </div>
            </div>