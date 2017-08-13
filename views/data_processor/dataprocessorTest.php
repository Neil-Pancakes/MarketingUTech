<?php
  include("../dashboard/dashboard.php");

  // $testJobTitle = 'Data Processor';
  // if($_SESSION['jobTitle'] != $testJobTitle && !isOfJobTitle($_SESSION['user_id'], $testJobTitle)) {
  //   header("Location:../home/home.php");
  // }
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
        <div ng-cloak ng-controller="taskFieldsController" data-ng-init="init()">
          <md-content>
            <md-tabs md-dynamic-height md-border-bottom>
              <md-tab label="daily tracker">
                <md-content class="md-padding">
                  <span class="md-display-2" >Daily Tracker </span>
                  
                  <md-content>
                    <md-list flex>
                      <md-checkbox aria-label="Select All" ng-checked="isChecked()" ng-click="toggleAll()">
                        <span ng-if="isChecked()">Un-</span>Select All
                      </md-checkbox>
                      <form ng-submit="delData()">
                        <div align="center">
                          <md-button ng-show="delBtn" type="submit" class=" md-raised" style="width:20%; background-color:darkred; color:white;">Delete <span class="fa fa-trash"></span></md-button>
                        </div>
                        <md-list-item class="md-3-line" ng-repeat="x in today" ng-click="modal(x.DailyTask, x.TaskStatus, x.DataProcessorId)">
                          <div style="width:95%;" data-target="#optionModal" data-toggle="modal">
                            <img src="../../includes/img/dataprocessor.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                            
                              <h3 class="articleName">{{ x.DailyTask }}</h3>
                              <h4 class="wordsChanged">{{ x.TaskStatus }}</h4>
                            </div>
                          </div>
                          <md-checkbox ng-model="deleteList[$index]" ng-checked="exists(x.DataProcessorId, selected)" ng-click="toggle(x.DataProcessorId, selected)" aria-label="checkbox">
                            
                          </md-checkbox>
                        </md-list-item>
                      </form>
                      <!--Edit Modal-->
                      <form ng-submit="editData()">
                          <div id="optionModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h2 id="modalHeaderEditDelete">Task</h2>
                                </div>
                                <div class="modal-body">
                                  <input type="text" class="inp form-control" ng-model="modalTask" required>
                                  <input type="text" class="inp form-control" ng-model="modalStatus" required>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-warning" onclick="$('#optionModal').modal('hide');">Edit <span class="fa fa-edit"></span></button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </form>
                      <!--END of Edit Modal-->
                      
                  </md-content>
                </md-content>
              </md-tab>
              <md-tab label="add tasks">
                <md-content class="md-padding">
                    <div>
                      <form ng-submit="submitData()">
                        <div id="taskHolderOjt" class="container" style="max-width:100%;">
                            <div class="jumbotron">
                                <p style="font-size:30px;">Tasks for today <md-button id="addTaskBtn" class="btn md-raised" ng-click="addNewTask()" style=" background-color: #00d200; color:white;">Add Task <span class="fa fa-plus"></span></md-button></p>
                                <div class="task-group">
                                <fieldset data-ng-repeat = "field in statusSet.status track by $index">
                                  <md-card>
                                      <md-card-title>
                                          <md-card-title-text>
                                              <span class="md-headline" style="30px">Task <md-button id="addTaskBtn" class="btn md-raised" ng-click="removeTask($index)" style=" background-color: #950000; color:white; float:right;">Delete Task <span class="fa fa-trash"></span></md-button></span>
                                              <!--<span class="md-subhead">Tell us a little about you.</span>-->
                                          </md-card-title-text>
                                          </md-card-title>
                                      <md-card-content>
                                          <md-input-container>
                                              <label style="color:grey; font-size:15px">Status</label>
                                              <input type="text" style="font-size:15px;" ng-model="statusSet.status[$index]" required>
                                          </md-input-container>
                                          <textarea ng-model="taskDescSet.taskDesc[$index]" placeholder="Task Description 
                  Ex: I did this today..." rows="5" name="taskDescList" id="comment_text" cols="20" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" style="border:solid 1px lightgrey; margin-left:5%; width:80%;" required></textarea>
                                      </md-card-content>

                                  </md-card>
                                </fieldset>
                                </div>
                                <div class="footer" align="center">
                                      <md-button ng-show="show" id="submitBtn" type="submit" class=" md-raised md-primary" ng-model="submitBtn" style="width:60%; margin-right:10%">Submit</md-button>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
                </md-content>
              </md-tab>
            </md-tabs>
          </md-content>
        </div>  

      <!-- Your Page Content Here -->
      </section>
    <!-- /.content -->
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
      $scope.data = {};
      $scope.items= [];
      $scope.selected = [];
      $scope.init = function () {
        $scope.items.splice(0, $scope.items.length);
        $http.get("../../queries/getMyDailyTrackerTodayDataProcessorTracker.php").then(function (response) {
          $scope.today = response.data.records;
          $scope.deleteList = [];
          for($x=0; $x<$scope.today.length; $x++){
            $scope.deleteList[$x] = false;
            $scope.items.push($scope.today[$x].DataProcessorId);
          }
        });  
      };
      
      $scope.taskDescSet = {taskDesc: []};
      $scope.statusSet = {status: []};
      $scope.taskDescSet.taskDesc = [];
      $scope.statusSet.status = [];
 
      $scope.addNewTask = function() {
        $scope.taskDescSet.taskDesc.push('');
        $scope.statusSet.status.push('');
        x++;
        if(x>0){
          $scope.show = true;
        }
      };

      $scope.removeTask = function(z) {
          $scope.taskDescSet.taskDesc.splice(z, 1);
          $scope.statusSet.status.splice(z, 1);
          if(x>0){
            x--;
          }
          if(x==0){
            $scope.show = false;
          }
      };

      $scope.showAlert = function(ev) {
        $mdDialog.show(
          $mdDialog.alert()
          .parent(angular.element(document.querySelector('#popupContainer')))
          .clickOutsideToClose(true)
          .title('Successful Insertion!')
          .textContent('You have successfully ADDED Tasks.')
          .ariaLabel('Alert Dialog Demo')
          .ok('Got it!')
          .targetEvent(ev)
        );
      }

      $scope.showDelete = function(ev) {
        $mdDialog.show(
          $mdDialog.alert()
          .parent(angular.element(document.querySelector('#popupContainer')))
          .clickOutsideToClose(true)
          .title('Successful Deletion!')
          .textContent('You have successfully DELETED a Task.')
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
          .textContent('You have successfully EDITED a Task.')
          .ariaLabel('Alert Dialog Demo')
          .ok('Got it!')
          .targetEvent(ev)
        );
      }

      $scope.submitData = function() {
          $http.post('../../insertFunctions/insertDataProcessorTracker.php', {
            'taskSet': $scope.taskDescSet.taskDesc, 
            'statusSet': $scope.statusSet.status
            }).then(function(data, status){
              $scope.taskDescSet = {taskSet: []};
              $scope.statusSet = {status: []};
              
              $scope.taskDescSet.taskDesc = [];
              $scope.statusSet.status = [];
              x=0;
              $scope.show = false;
              $scope.init();
              $scope.showAlert();
            })
      };

      $scope.editData = function() {
        $http.post('../../editFunctions/editDailyTaskDataProcessor.php', {
          'id': $scope.modalDataProcessorId,
          'status': $scope.modalStatus,
          'task': $scope.modalTask
        }).then(function(data, status){
              $scope.init();
              $scope.showEdit();
        })
      };

      $scope.delData = function() {
        for($x=$scope.selected.length; $x>-1; $x--){
          $http.post('../../deleteFunctions/delDailyTaskDataProcessor.php', {
            'id': $scope.selected[$x],
          }).then(function(data, status){
              $scope.init();
          })
          $scope.selected.splice($x, 1);
          $ndx = $scope.items.indexOf($scope.selected);
          $scope.items.splice($ndx, 1);
        }
        $scope.showDelete();
        if($scope.selected.length==0){
          $scope.delBtn = false;
        }
        if($scope.selected.length == $scope.items.length){
          $scope.isChecked();
        }
      };

      $scope.modal = function(task, status, id) {
          $scope.modalDataProcessorId = id;
          $scope.modalStatus = status;
          $scope.modalTask = task;
      };

      $scope.toggle = function (item, list) {
        var idx = list.indexOf(item);
        if (idx > -1) {
          list.splice(idx, 1);
        }
        else {
          list.push(item);
        }
        if(list.length>0){
          $scope.delBtn = true;
        }else{
          $scope.delBtn = false;
        }
        if(list.length==$scope.items.length){
          $scope.isChecked();
        }
      };

      $scope.exists = function (item, list) {
        return list.indexOf(item) > -1;
      };

      $scope.isChecked = function() {
        return $scope.selected.length === $scope.items.length;
      };

      $scope.toggleAll = function() {
        if ($scope.selected.length === $scope.items.length) {
          for($x=0; $x<$scope.selected.length; $x++){
            $scope.deleteList[$x] = false;
          }
          $scope.selected = [];
          $scope.delBtn = false;
        } else if ($scope.selected.length === 0 || $scope.selected.length > 0) {
          $scope.selected = $scope.items.slice(0);
          for($x=0; $x<$scope.selected.length; $x++){
            $scope.deleteList[$x] = true;
          }
          $scope.delBtn = true;
        }
      };

    });
</script>