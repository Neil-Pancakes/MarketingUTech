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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Processor
        <small>UniversalTech</small>
      </h1>
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
                      <div id="optionModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <form ng-submit="editData()">
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
                          </form>
                        </div>
                      </div>
                      <!--END of Edit Modal-->
                      <md-list-item class="md-3-line" ng-repeat="x in todayAdditional track by $index">
                          <img src="../../includes/img/taskIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <h3>{{x.Name}}</h3>
                              <h3 class="articleName">{{ x.Task }}</h3>
                              
                            </div>
                        </md-list-item>
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
              <md-tab label="team member tasks">
                <md-content class="md-padding">
                  <md-list flex>
                    <md-list-item class="md-3-line" ng-repeat="x in team">
                      <div style="width:95%;">
                        <img src="../../includes/img/writerIcon.png" class="md-avatar" style="float:left"/>
                        <div class="md-list-item-text">
                        <h3 class="articleName">{{ x.Name }}</h3>
                          <button class="btn btn-xs btn-primary">View</button>
                          <button class="btn btn-xs btn-success" ng-click="addTaskModal(x.Id)" data-toggle="modal" data-target="#addTask">Add Task</button>
                            
                          
                        </div>
                      </div>
                    </md-list-item>
                    <div id="addTask" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                <form ng-submit="addAdditional()">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h2 id="modalHeaderEditDelete">Task</h2>
                                    </div>
                                    <div class="modal-body">
                                      <input ng-model="addTaskUserId" hidden>
                                      <input class="form-control" placeholder="Task Name" ng-model="addTaskName" required>
                                      <select class="form-control" ng-model="addTaskType" required>
                                        <option value="Text">Text</option>
                                        <option value="Int">Count</option>
                                        <option value="Binary">Yes/No</option>
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-success" onclick="$('#addTask').modal('hide');">Add Task <span class="fa fa-plus-circle"></span></button>
                                    </div>
                                  </div>
                                  </form>
                                </div>
                              </div>
                  </md-list>
                </md-content>
                <div ng-show="showTeam" align="center">
                  <h2>You don't have any Team Members</h2>
                </div>
              </md-tab>
              <md-tab label="additional tasks">
                <md-content class="md-padding">
                  <md-list flex>
                  <form ng-submit="submitAdditionalTask()">
                    <md-list-item class="md-3-line" ng-repeat="x in additionalTasks track by $index">
                    <img src="../../includes/img/taskIcon.png" class="md-avatar" style="float:left"/>
                    <div class="md-list-item-text">
                    <h3>{{x.Name}}</h3>
                      
                        <input ng-model="additionalId[$index]" ng-init="additionalIdSet.additionalId[$index] = x.AdditionalTaskId" hidden>
                        <textarea ng-if='x.Type=="Text"' ng-model="additionalSet.additional[$index]" rows="5" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500"></textarea>
                        <input ng-if='x.Type=="Int"' ng-model="additionalSet.additional[$index]" type="number">
                        <select ng-if='x.Type=="Binary"' ng-model="additionalSet.additional[$index]">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        
                     
                    </div>
                    
                    </md-list-item>
                    <div align="center">
                      <md-button ng-show="addExists" type="submit" class=" md-raised md-primary" style="width:20%; margin-top:3%;">Submit</md-button>
                    </div>
                    </form>
                  </md-list>
                </md-content>
                <div ng-show="!addExists" align="center">
                  <h2>You don't have any additional Tasks</h2>
                </div>
              </md-tab>

            </md-tabs>
          </md-content>
        </div>  

      <!-- Your Page Content Here -->
      </section>
    <!-- /.content -->
  </div>
  
  <!-- Control Sidebar Start-->
  <?php include '../dashboard/control_sidebar.php'; ?>
  
</div>
<!-- ./wrapper -->
<script>
  var app = angular.module('taskFieldsApp', ['ngMaterial']);
  var x=0;
  app.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
  }]);

  app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
    $scope.additionalSet = {additional: []};
    $scope.additionalIdSet = {additionalId: []};
    $scope.additional = [];
    $scope.additionalId = [];
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
        $http.get("../../queries/getTeam.php").then(function (response) {
            $scope.team = response.data.records;
            if($scope.team.length==0){
              $scope.showTeam = true;
            }
        });  
        $http.get("../../queries/getAdditionalTasks.php").then(function (response) {
            $scope.additionalTasks = response.data.records;
            if($scope.additionalTasks.length>0){
              $scope.addExists = true;
            }else{
              $scope.addExists = false;
            }
        });
        $http.get("../../queries/getMyDailyTrackerTodayAdditionalTaskTracker.php").then(function (response) {
            $scope.todayAdditional = response.data.records;
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

      $scope.submitAdditionalTask = function() {
          $http.post('../../insertFunctions/insertAdditionalTaskTracker.php', {
              'idSet': $scope.additionalIdSet.additionalId, 
              'taskSet': $scope.additionalSet.additional
              }).then(function(data, status){
                $scope.additionalSet = {additional: []};
                $scope.additionalSet.additional = [];
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

      $scope.addAdditional = function(){
          $http.post('../../insertFunctions/insertAdditionalTask.php', {
              'userId': $scope.addTaskUserId,
              'name': $scope.addTaskName,
              'type': $scope.addTaskType
            }).then(function(data, status){
                $scope.init();
            })
        };

      $scope.modal = function(task, status, id) {
          $scope.modalDataProcessorId = id;
          $scope.modalStatus = status;
          $scope.modalTask = task;
      };

      $scope.addTaskModal = function(id) {
            $scope.addTaskUserId = id;
            $scope.addTaskName = "";
            $scope.addTaskType = "";
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
<script>
  document.getElementById("taskTracker").setAttribute("class", "active");

  $(document).ready(function(){
      $('#homeTab').removeClass('active');
      $('#trackerTab').addClass('active');
  });
</script>