<!-- -----BASE CODE FOR THE TRACKERS----- -->
<!-- -----BASE CODE FOR THE TRACKERS----- -->
<!-- -----BASE CODE FOR THE TRACKERS----- -->

<?php
        include("dashboard.php");
?>
<head>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
	  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
      .addTaskBtn{
          background-color: #00d200;
          color:white;
      }
    </style>
</head>
<body ng-app="taskFieldsApp" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

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
                                    <input ng-model="modalwordpressId" value="{{modalmultimediaId}}" hidden>
                                      <md-input-container>
                                          <label>Featured Image</label>
                                          <input type="text" class="inp form-control" ng-model="modalfeaturedimgCnt" value="{{modalfixbugCnt}}">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Graphic Designing</label>
                                          <input type="text" class="inp form-control" ng-model="modalgraphicdesigningCnt" value="{{modalcreatepageCnt}}">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Banner</label>
                                          <input type="text" class="inp form-control" ng-model="modalbannerCnt" value="{{modalresponsivedesignCnt}}">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Miscellaneous</label>
                                          <input type="text" class="inp form-control" ng-model="modalmiscCnt" value="{{modalmiscCnt}}">
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
                                      <img src="includes/img/pageIcon.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>Featured Image</h3>
                                        <h3 class="articleName">{{ today[0].FeaturedImageCnt }}</h3>
                                        
                                      </div>
                                    </div>
                                  </md-list-item>

                                  <md-list-item class="md-3-line">
                                    <div style="width:95%;">
                                      <img src="includes/img/responsiveDesign.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>Graphic Designing</h3>
                                        <h3 class="articleName">{{ today[0].GraphicDesigningCnt }}</h3>
                                        
                                      </div>
                                    </div>
                                  </md-list-item>

                                  <md-list-item class="md-3-line">
                                    <div style="width:95%;">
                                      <img src="includes/img/articleIcon.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>Banner</h3>
                                        <h3 class="articleName">{{ today[0].BannerCnt }}</h3>
                                        
                                      </div>
                                    </div>
                                  </md-list-item>

                                  <md-list-item class="md-3-line">
                                    <div style="width:95%;">
                                      <img src="includes/img/miscIcon.png" class="md-avatar" style="float:left"/>
                                      <div class="md-list-item-text">
                                        <br>
                                        <h3>Miscellaneous</h3>
                                        <h3 class="articleName">{{ today[0].MiscCnt }}</h3>
                                        
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
                                                    <label>Featured Image</label>
                                                    <input style="font-size:20px" ng-model="obj.featuredimgCnt" type="number" min="0">
                                                </md-input-container>
                                                <md-input-container>
                                                    <label>Graphic Designing</label>
                                                    <input style="font-size:20px" ng-model="obj.graphicdesigningCnt" type="number" min="0">
                                                </md-input-container>
                                                <md-input-container>
                                                    <label>Banner</label>
                                                    <input style="font-size:20px" ng-model="obj.bannerCnt" type="number" min="0">
                                                </md-input-container>
                                                <md-input-container>
                                                    <label>Miscellaneous</label>
                                                    <input style="font-size:20px" ng-model="obj.miscCnt" type="number" min="0">
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
              <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Marketing Department Daily Tracker
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <span id="year"></span> <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

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
$(document).ready(function(){
    document.getElementById("year").innerHTML = new Date().getFullYear();
    $('#homeTab').removeClass('active');
    $('#trackerTab').addClass('active');
});
</script>

<script>
    var app = angular.module('taskFieldsApp', ['ngMaterial']);
    var x=0;
    app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
      $scope.obj = {
        $featuredimgCnt: 0,
        $graphicdesigningCnt: 0,
        $bannerCnt: 0,
        $miscCnt: 0
      };
       $scope.init = function () {
          $http.get("queries/getMyDailyTrackerTodayMultimediaTracker.php").then(function (response) {
            $scope.today = response.data.records;
            if($scope.today[0].MultimediaId==""){
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
          $http.post('insertFunctions/insertMultimediaTracker.php', {
              'featuredimgCnt': $scope.obj.featuredimgCnt, 
              'graphicdesigningCnt': $scope.obj.graphicdesigningCnt,
              'bannerCnt': $scope.obj.bannerCnt,
              'miscCnt': $scope.obj.miscCnt
              }).then(function(data, status){
                $scope.init();
                $scope.showAlert();
              })
        };

        $scope.editData = function() {
          $http.post('editFunctions/editDailyTaskMultimedia.php', {
            'id': $scope.modalmultimediaId,
            'featuredimgCnt': $scope.modalfeaturedimgCnt, 
            'graphicdesigningCnt': $scope.modalgraphicdesigningCnt,
            'bannerCnt': $scope.modalbannerCnt,
            'miscCnt': $scope.modalmiscCnt
          }).then(function(data, status){
                $scope.init();
                $scope.showEdit();
          })
        };

        $scope.modal = function() {
            $scope.modalmultimediaId = $scope.today[0].MultimediaId;
            $scope.modalfeaturedimgCnt = $scope.today[0].FeaturedImageCnt;
            $scope.modalgraphicdesigningCnt = $scope.today[0].GraphicDesigningCnt;
            $scope.modalbannerCnt = $scope.today[0].BannerCnt;
            $scope.modalmiscCnt = $scope.today[0].MiscCnt;
        };
  });
</script>