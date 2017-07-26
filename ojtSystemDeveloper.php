<!--THIS IS ALSO USED FOR TRACKIMO CUSTOMER SUPPORT AND SEO Specialist/Internet Marketing-->
<?php
        include("dashboard.php");
?>
<head>
    <style>
        label{
            font-size:15px;
        }
    </style>
</head>
<body ng-app="taskFieldsApp" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daily Tracker
        <small>Role in the Company (Im an OJT)</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->

  <!-- Main content -->
    <section class="content">
        <div ng-cloak ng-controller="taskFieldsController" data-ng-init="init()">
          <md-content>
            <md-tabs md-dynamic-height md-border-bottom>
              <md-tab label="daily tracker">
                <md-content class="md-padding">
                  <span class="md-display-2" >Daily Tracker </span>
                  <md-button class="md-warn md-raised" ng-if="exists==true" ng-click="modal()" data-target="#optionModal" data-toggle="modal">Edit <span class="fa fa-edit"></span></md-button>
                  <md-card>
                    <md-card-title>
                        <span class="md-subhead"> Create Website</span>
                    </md-card-title>
                    <md-card-content>
                        <div>{{today[0].CreateWebsite}}</div>
                    </md-card-content>
                  </md-card>

                  <md-card>
                    <md-card-title>
                        <span class="md-subhead"> Organize/Optimize</span>
                    </md-card-title>
                    <md-card-content>
                        <div>{{today[0].Organize}}</div>
                    </md-card-content>
                  </md-card>

                  <md-card>
                    <md-card-title>
                        <span class="md-subhead"> Miscellaneous</span>
                    </md-card-title>
                    <md-card-content>
                        <div>{{today[0].Misc}}</div>
                    </md-card-content>
                  </md-card>
                  <!--Edit Modal-->
                      <form ng-submit="editData()">
                          <div id="optionModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h2 id="modalHeaderEditDelete">Task</h2>
                                </div>
                                <div class="modal-body">
                                  <input ng-model="modalojtdevelopersystemId" hidden>
                                  <textarea ng-model="modalcreatewebsite" rows="5" value="obj.createWebsite" id="comment_text" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                                  <textarea ng-model="modalorganize" rows="5" value="obj.organize" id="comment_text" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                                  <textarea ng-model="modalmisc" rows="5" value="obj.misc" id="comment_text" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-warning" onclick="$('#optionModal').modal('hide');">Edit <span class="fa fa-edit"></span></button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </form>
                      <!--END of Edit <Modal--></Modal-->
                </md-content>         
              </md-tab>
                    <md-tab label="add tasks">
                        <md-content class="md-padding" ng-if="exists==false">
                            <form ng-submit="submitData()">
                                <div id="taskHolderOjt" class="container" style="max-width:100%;">
                                    <div class="jumbotron">
                                        <p style="font-size:30px;">Tasks for today</p>
                                        <div class="task-group">
                                        <label for="createWebsite">Create Website</label>
                                            <textarea id="createWebsite" placeholder="Task Description 

                        Ex: I did this today..." rows="5" ng-model="obj.createWebsite" id="comment_text" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                                        <label for="orgOpt">Organize/Optimize</label>   
                                            <textarea id="orgOpt" placeholder="Task Description 

                        Ex: I did this today..." rows="5" ng-model="obj.organize" id="comment_text" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                                        <label for="misc">Miscellaneous</label>    
                                            <textarea id="misc" placeholder="Task Description 

                        Ex: I did this today..." rows="5" ng-model="obj.misc" id="comment_text" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                                            
                                            <div class="footer" align="center">
                                                <md-button id="submitBtn" type="submit" class=" md-raised md-primary" ng-model="submitBtn" style="width:60%; margin-right:10%">Submit</md-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </md-content>
                        <div class="jumbotron" ng-if="exists==true" style="max-width:100%;">
                          <h2>You have already created a Task today</h2>
                        </div>
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
        $createWebsite: "",
        $organize: "",
        $misc: ""
      };
       $scope.init = function () {
          $http.get("queries/getMyDailyTrackerTodayOjtDeveloperSystemTracker.php").then(function (response) {
            $scope.today = response.data.records;
            if($scope.today[0].OJTDeveloperSystemId==""){
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
            .textContent('You have successfully ADDED a Task.')
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
            .textContent('You have successfully EDITED your Task.')
            .ariaLabel('Alert Dialog Demo')
            .ok('Got it!')
            .targetEvent(ev)
          );
        }

        $scope.submitData = function() {
          $http.post('insertFunctions/insertOjtDeveloperSystem.php', {
              'createWebsite': $scope.obj.createWebsite,
              'organize': $scope.obj.organize,
              'misc': $scope.obj.misc
              }).then(function(data, status){
                $scope.init();
                $scope.showAlert();
              })
        };

        $scope.editData = function() {
          $http.post('editFunctions/editDailyTaskOJTSystemDeveloper.php', {
            'id': $scope.modalojtdevelopersystemId,
            'createWebsite': $scope.modalcreatewebsite,
            'organize': $scope.modalorganize,
            'misc': $scope.modalmisc
          }).then(function(data, status){
                $scope.init();
                $scope.showEdit();
          })
        };

        $scope.modal = function() {
            $scope.modalojtdevelopersystemId = $scope.today[0].OJTDeveloperSystemId;
            $scope.modalcreatewebsite = $scope.today[0].CreateWebsite;
            $scope.modalorganize = $scope.today[0].Organize;
            $scope.modalmisc = $scope.today[0].Misc;
        };
  });
</script>