<?php
  include("../dashboard/dashboard.php");
?>
<body ng-app="taskFieldsApp" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content">
        <div ng-cloak ng-controller="taskFieldsController" data-ng-init="init()">
          <md-content>
            <md-tabs md-dynamic-height md-border-bottom>
              <md-tab label="daily tracker">
                <md-content class="md-padding">
                  <span class="md-display-2" >Daily Tracker </span>
                  <md-button class="md-warn md-raised" ng-if="exists==true" ng-click="modal()" data-target="#optionModal" data-toggle="modal">Edit <span class="fa fa-edit"></span></md-button>
                   <!--Edit Modal-->
                      <form ng-submit="editData()" >
                          <div id="optionModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h2 id="modalHeaderEditDelete">Task</h2>
                                </div>
                                <div class="modal-body">
                                  <md-content layout-padding>
                                    <div> 
                                      <input ng-model="modalsocialmediaId" hidden>
                                        <md-input-container>
                                            <label>FB Balay</label>
                                            <input type="text" class="inp form-control" ng-model="modalfacebookCnt">
                                        </md-input-container>
                                        <md-input-container>
                                            <label>Pinterest Balay</label>
                                            <input type="text" class="inp form-control" ng-model="modalpinterestCnt">
                                        </md-input-container>
                                        <md-input-container>
                                            <label>FB/Twitter/IG MB</label>
                                            <input type="text" class="inp form-control" ng-model="modalmbCnt">
                                        </md-input-container>
                                        <md-input-container>
                                            <label>FB/Twitter/IG Taft</label>
                                            <input type="text" class="inp form-control" ng-model="modaltaftCnt">
                                        </md-input-container>
                                        <md-input-container>
                                            <label>FB WA</label>
                                            <input type="text" class="inp form-control" ng-model="modalwaCnt">
                                        </md-input-container>
                                    </div>
                                </md-content>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-warning" onclick="$('#optionModal').modal('hide');">Edit <span class="fa fa-edit"></span></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          </form>
                          <!--END of Edit Modal-->
                            <md-content>
                              <md-list flex>
                                  <div align="center">
                                    <md-button ng-show="delBtn" type="submit" class=" md-raised" style="width:20%; background-color:darkred; color:white;">Delete <span class="fa fa-trash"></span></md-button>
                                  </div>
                                  <md-list-item class="md-3-line">
                                    <div style="width:95%;">
                                      <img src="../../includes/img/imageIcon.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>FB Balay</h3>
                                        <h3 class="articleName">{{ today[0].FacebookCnt }}</h3>
                                        
                                      </div>
                                    </div>
                                  </md-list-item>

                                  <md-list-item class="md-3-line">
                                    <div style="width:95%;">
                                      <img src="../../includes/img/designIcon.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>Pinterest Balay</h3>
                                        <h3 class="articleName">{{ today[0].PinterestCnt }}</h3>
                                        
                                      </div>
                                    </div>
                                  </md-list-item>

                                  <md-list-item class="md-3-line">
                                    <div style="width:95%;">
                                      <img src="../../includes/img/bannerIcon.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>FB/Twitter/IG MB</h3>
                                        <h3 class="articleName">{{ today[0].MBCnt }}</h3>
                                        
                                      </div>
                                    </div>
                                  </md-list-item>

                                  <md-list-item class="md-3-line">
                                    <div style="width:95%;">
                                      <img src="../../includes/img/miscIcon.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>FB/Twitter/IG Taft</h3>
                                        <h3 class="articleName">{{ today[0].TaftCnt }}</h3>
                                        
                                      </div>
                                    </div>
                                  </md-list-item>
                                  <md-list-item class="md-3-line">
                                    <div style="width:95%;">
                                      <img src="../../includes/img/miscIcon.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>FB WA</h3>
                                        <h3 class="articleName">{{ today[0].WACnt }}</h3>
                                        
                                      </div>
                                    </div>
                                  </md-list-item>
                            </md-content>
                          </md-content>
                        </md-tab>
                        <md-tab label="add tasks">
                          <md-content class="md-padding">
                            <form ng-submit="submitData()">
                              <div id="taskHolderOjt" class="container" style="max-width:100%;">
                                  <div class="jumbotron" ng-if="exists==false">
                                      <p style="font-size:30px;">Task Count for today </p>
                                      <md-content layout-padding>
                                          <div>
                                            <md-input-container>
                                              <label>FB Balay</label>
                                              <input style="font-size:20px" ng-model="obj.fbbalayCnt" type="number" min="0">
                                          </md-input-container>
                                          <md-input-container>
                                              <label>Pinterest Balay</label>
                                              <input style="font-size:20px" ng-model="obj.pinterestbalayCnt" type="number" min="0">
                                          </md-input-container>
                                          <md-input-container>
                                              <label>FB/Twitter/IG MB</label>
                                              <input style="font-size:20px" ng-model="obj.fbtwitterigMBCnt" type="number" min="0">
                                          </md-input-container>
                                          <md-input-container>
                                              <label>FB/Twitter/IG Taft</label>
                                              <input style="font-size:20px" ng-model="obj.fbtwitterigTaftCnt" type="number" min="0">
                                          </md-input-container>
                                          <md-input-container>
                                              <label>FB WA</label>
                                              <input style="font-size:20px" ng-model="obj.fbwaCnt" type="number" min="0">
                                          </md-input-container>
                                        </div>
                                      </md-content>
                                      <div class="footer" align="center">
                                          <md-button id="submitBtn" type="submit" class=" md-raised md-primary" ng-model="submitBtn">Submit</md-button>
                                      </div>
                                  </div>
                                  <div class="jumbotron" ng-if="exists==true">
                                    <h2>You have already created a Task Count today</h2>
                                  </div>
                              </div>
                            </form>
                          </md-content>
                        </md-tab>
                      </md-tabs>
                    </md-content>
                  </div>  

                <!-- Your Page Content Here -->
                </section>

    </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
  document.getElementById("taskTracker").setAttribute("class", "active");

  $(document).ready(function(){
      $('#homeTab').removeClass('active');
      $('#trackerTab').addClass('active');
  });

    var app = angular.module('taskFieldsApp', ['ngMaterial']);
    var x=0;
    app.config(['$qProvider', function ($qProvider) {
      $qProvider.errorOnUnhandledRejections(false);
    }]);
    app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
      $scope.obj = {
        $fbbalayCnt: 0,
        $pinterestbalayCnt: 0,
        $fbtwitterigMBCnt: 0,
        $fbtwitterigTaftCnt: 0,
        $fbwaCnt: 0
      };
       $scope.init = function () {
          $http.get("../../queries/getMyDailyTrackerTodaySocialMediaTracker.php").then(function (response) {
            $scope.today = response.data.records;
            if($scope.today[0].SocialMediaId==""){
              $scope.exists=false;
            }else{
              $scope.exists=true;
            }
          });  
        };
        
        $scope.showAlert = function(ev) {
          $mdDialog.show(
            $mdDialog.alert()
            .parent(angular.element(document.querySelector('#popupContainer')))
            .clickOutsideToClose(true)
            .title('Successful Insertion!')
            .textContent('You have successfully ADDED your Task Count.')
            .ariaLabel('Alert Dialog Demo')
            .ok('Got it!')
            .targetEvent(ev)
          );
        }
        
        $scope.showEdit = function(ev) {
          $mdDialog.show(
            $mdDialog.alert()
            .parent(angular.element(document.querySelector('#popupContainer')))
            .clickOutsideToClose(true)
            .title('Successful Edit!')
            .textContent('You have successfully EDITED your Task Count.')
            .ariaLabel('Alert Dialog Demo')
            .ok('Got it!')
            .targetEvent(ev)
          );
        }
        $scope.submitData = function() {
          $http.post('../../insertFunctions/insertSocialMediaTracker.php', {
              'facebookCnt': $scope.obj.fbbalayCnt, 
              'pinterestCnt': $scope.obj.pinterestbalayCnt,
              'MBCnt': $scope.obj.fbtwitterigMBCnt,
              'taftCnt': $scope.obj.fbtwitterigTaftCnt,
              'WACnt': $scope.obj.fbwaCnt
              }).then(function(data, status){
                $scope.init();
                $scope.showAlert();
              })
        };
        $scope.editData = function() {
          $http.post('../../editFunctions/editDailyTaskSocialMedia.php', {
            'id': $scope.modalsocialmediaId,
            'facebookCnt': $scope.modalfacebookCnt, 
            'pinterestCnt': $scope.modalpinterestCnt,
            'mbCnt': $scope.modalmbCnt,
            'taftCnt': $scope.modaltaftCnt,
            'waCnt': $scope.modalwaCnt
          }).then(function(data, status){
                $scope.init();
                $scope.showEdit();
          })
        };
        $scope.modal = function() {
            $scope.modalsocialmediaId = $scope.today[0].SocialMediaId;
            $scope.modalfacebookCnt = $scope.today[0].FacebookCnt;
            $scope.modalpinterestCnt = $scope.today[0].PinterestCnt;
            $scope.modalmbCnt = $scope.today[0].MBCnt;
            $scope.modaltaftCnt = $scope.today[0].TaftCnt;
            $scope.modalwaCnt = $scope.today[0].WACnt;
        };
  });
</script>