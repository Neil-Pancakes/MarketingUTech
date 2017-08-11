<?php
  include("dashboard_LOCAL_13708.php");
?>
<head>
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
    <section class="content">

      <!-- Your Page Content Here -->
      <div ng-controller="taskFieldsController">
        <form action="#" method="GET">
          <div id="taskHolderOjt" class="container">
              <div class="jumbotron">
                  <p style="font-size:30px;">Tasks for today </p>
                  <md-content layout-padding>
                       <div>
                            <br>
                            <md-input-container>
                                <label>Commenting 10 per day</label>
                                <md-select ng-model="status.p1" ng-selected="0">
                                    <md-option ng-repeat="x in options">{{x}}</md-option>
                                </md-select>
                            </md-input-container>
                            <md-input-container>
                                <label>Site Audit</label>
                                <md-select ng-model="status.p2">
                                    <md-option ng-repeat="x in options">{{x}}</md-option>
                                </md-select>
                            </md-input-container>
                            <md-input-container>
                                <label>Schema Markup</label>
                                <md-select ng-model="status.p3">
                                    <md-option ng-repeat="x in options">{{x}}</md-option>
                                </md-select>
                            </md-input-container>
                            <md-input-container>
                                <label>Competitor Backlink Analysis</label>
                                <md-select ng-model="status.p4">
                                    <md-option ng-repeat="x in options">{{x}}</md-option>
                                </md-select>
                            </md-input-container>
                            <md-input-container>
                                <label>Relationship Link Research</label>
                                <md-select ng-model="status.p5">
                                    <md-option ng-repeat="x in options">{{x}}</md-option>
                                </md-select>
                            </md-input-container>
                            <md-input-container>
                                <label>Miscellaneous</label>
                                <md-select ng-model="status.p6">
                                    <md-option ng-repeat="x in options">{{x}}</md-option>
                                </md-select>
                            </md-input-container>
                              <textarea ng-model="taskDescSet.taskDesc[$index]" placeholder="Miscellaneous 

    Ex: I did this today..." rows="15" name="taskDescList" id="comment_text" cols="20" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" style="border:solid 1px lightgrey; margin-left:5%;" ng-model="status.p7" required></textarea>
                        
                        </div>
                  </md-content>
                <div class="footer" align="center">
                    <md-button id="submitBtn" type="submit" class=" md-raised md-primary" ng-model="submitBtn" style="width:60%; margin-right:10%">Submit</md-button>
                </div>
              </div>
          </div>
        </form>
      </div>
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
    app.config(['$qProvider', function ($qProvider) {
      $qProvider.errorOnUnhandledRejections(false);
    }]);
    app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
      $scope.options = ["Yes", "No"];
      $scope.status = {
        $p1: "",
        $p2: "",
        $p3: "",
        $p4: "",
        $p5: "",
        $taskDesc: ""
      };
       $scope.init = function () {
          $http.get("queries/getMyDailyTrackerTodayOjtSeoTracker.php").then(function (response) {
            $scope.today = response.data.records;
            if($scope.today[0].OJTSeoId==""){
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
            .textContent('You have successfully ADDED Task.')
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
          $http.post('insertFunctions/insertOJTSeo.php', {
              'comment': $scope.status.p1,
              'siteAudit': $scope.status.p2,
              'schemaMarkup': $scope.status.p3,
              'competitor': $scope.status.p4,
              'relationship': $scope.status.p5,
              'misc': $scope.status.taskDesc
              }).then(function(data, status){
                $scope.init();
                $scope.showAlert();
              })
        };


</script>