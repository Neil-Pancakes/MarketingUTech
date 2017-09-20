<?php
  include("../dashboard/dashboard.php");

  // $testJobTitle = 'OJT Researcher';
  // if($_SESSION['jobTitle'] != $testJobTitle && !isOfJobTitle($_SESSION['user_id'], $testJobTitle)) {
  //   header("Location:../home/home.php");
  // }
?>
<body ng-app="taskFieldsApp" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>OJT Researcher
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
                  <md-button class="md-warn md-raised" ng-if="exists==true" ng-click="modal()" data-target="#optionModal" data-toggle="modal">Edit <span class="fa fa-edit"></span></md-button>
                  <md-card>
                    <md-card-content>
                        <h2>{{today[0].Niche}}</h2>
                        <h4>{{today[0].NumOfCompanies}}</h4>
                    </md-card-content>
                  </md-card>
                  <md-list-item class="md-3-line" ng-repeat="x in todayAdditional track by $index">
                          <img src="../../includes/img/taskIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <h3>{{x.Name}}</h3>
                              <h3 class="articleName">{{ x.Task }}</h3>
                              
                            </div>
                        </md-list-item>
                  <!--Edit Modal-->
                      <div id="optionModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <form ng-submit="editData()">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h2 id="modalHeaderEditDelete">Task</h2>
                                </div>
                                <div class="modal-body">
                                  <input ng-model="modalojtresearcherId" hidden>
                                  <textarea ng-model="modalniche" rows="5" id="comment_text" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                                  <input class="form-control" ng-model="modalnumofcompanies" placeholder="Number of Companies (Status)">
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-warning" onclick="$('#optionModal').modal('hide');">Edit <span class="fa fa-edit"></span></button>
                                </div>
                              </div>
                          </form>
                        </div>
                      </div>
                      <!--END of Edit <Modal--></Modal-->
                </md-content>         
              </md-tab>
                    <md-tab label="add tasks">
                        <md-content class="md-padding" >
                            <form ng-submit="submitData()">
                                <div id="taskHolderOjt" class="container" style="max-width:100%;">
                                    <div class="jumbotron"ng-if="exists==false">
                                        <p style="font-size:30px;">Tasks for today</p>
                                        <div class="task-group">
                                          <label for="niche">Niche</label><br>
                                            <textarea id="niche" placeholder="Task Description 

                        Ex: I did this today..." rows="5" ng-model="obj.niche" id="comment_text" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                                          <br><br>
                                          <label for="NumOfCompanies">Number of Companies</label><br>
                                              <input class="form-control" id="NumOfCompanies" ng-model="obj.numOfCompanies" placeholder="Number of Companies (Status)" style="width:50%; float:left;">
                                            <br><br><br>
                                            <div align="center">
                                              <md-button id="submitBtn" type="submit" class=" md-raised md-primary" ng-model="submitBtn" style="width:60%; margin-right:10%">Submit</md-button>
                                            </div>
                                      </div>
                                    </div>
                                    <div class="jumbotron" ng-if="exists==true">
                                      <h2>You have already created a Task today</h2>
                                    </div>
                                </div>
                            </form>
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
                        <button class="btn btn-xs btn-primary" ng-click="viewTaskModal(x.Id)" data-toggle="modal" data-target="#viewTask">View</button>
                        <button class="btn btn-xs btn-success" ng-click="addTaskModal(x.Id)" data-toggle="modal" data-target="#addTask">Add Task</button>
                          
                        
                      </div>
                    </div>
                  </md-list-item>
                  
                  <div id="viewTask" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" style="background-color:#001a4d; color:white;">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h2 id="modalHeaderEditDelete">Additional Tasks</h2>
                        </div>
                        <div class="modal-body">
                        <md-list-item class="md-3-line" ng-repeat="x in teamAdditional" ng-click="modalAdditional(x.AdditionalTaskId, x.Name, x.Type, x.UserId)">
                          <div style="width:95%;" data-target="#editAdditionalModal" data-toggle="modal">
                            <img src="../../includes/img/taskIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                            <h3>{{x.Name}}</h3>
                            <h3 class="articleName" ng-if="x.Type == 'Text'">Text</h3>
                            <h3 class="articleName" ng-if="x.Type == 'Int'">Count</h3>
                            <h3 class="articleName" ng-if="x.Type == 'Binary'">Yes/No</h3>
                                  
                          </div>
                        </md-list-item>

                          </div>
                        </md-list-item>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" onclick="$('#viewTask').modal('hide');">Close <span class="fa fa-close"></span></button>
                        </div>
                      </div>
                  </div>
                </div>
                <!--Edit Additional Task Modal-->
                <div id="editAdditionalModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <form ng-submit="editAdditional()">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"><strong>Additional Task</strong></h4>
                        </div>
                        <div class="modal-body">
                          <input type="text" class="inp form-control" ng-model="modalAddTaskId" ng-hide="true" required>
                          <input type="text" class="inp form-control" ng-model="modalAddName" required>
                          <select class="form-control" ng-model="modalAddType" required>
                            <option value="Text">Text</option>
                            <option value="Int">Count</option>
                            <option value="Binary">Yes/No</option>
                          </select>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-warning" onclick="$('#editAdditionalModal').modal('hide');">Edit <span class="fa fa-edit"></span></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!--Edit Additional Task Modal-->

                  <div id="addTask" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                              <form ng-submit="addAdditional()">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color:#003300; color:white;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                    <button type="button" class="btn btn-danger" onclick="$('#addTask').modal('hide');">Close <span class="fa fa-close"></span></button>
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
                  <md-list-item class="md-3-line" ng-click="modalAddTracker(x.AdditionalTaskTrackerId, x.Name, x.Type, x.Task, x.Time, x.Date, x.AdditionalTaskId)" ng-repeat="x in additionalTasks track by $index" data-target="#insertAddTracker" data-toggle="modal">
                    
                    <img src="../../includes/img/taskIcon.png" class="md-avatar" style="float:left"/>
                    
                    <div class="md-list-item-text">
                    <h3><strong>{{x.Name}}</strong></h3>
                    <h3>{{x.Task}}</h3> 
                    </div>
                  </md-list-item>
                </md-list>
                  <div id="insertAddTracker" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <form ng-submit="editAdditionalTaskTracker()">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#003300; color:white;">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h2 id="modalHeaderEditDelete">Task</h2>
                            </div>
                            <div class="modal-body">
                              <input ng-model="modalAddTrackerId" ng-hide="true">
                              <textarea ng-if='mod.modalAddTrackerType=="Text"' ng-model="mod.modalAddTrackerTask" rows="5" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500"></textarea>
                              <input ng-if='mod.modalAddTrackerType=="Int"' ng-model="mod.modalAddTrackerTask" class="form-control" type="number">
                              <select ng-if='mod.modalAddTrackerType=="Binary"' ng-model="mod.modalAddTrackerTask" class="form-control">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                              </select>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-warning" onclick="$('#insertAddTracker').modal('hide');">Edit Status <span class="fa fa-edit"></span></button>
                              <button type="button" class="btn btn-danger" onclick="$('#insertAddTracker').modal('hide');">Close <span class="fa fa-close"></span></button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div ng-show="!addExists" align="center">
                      <h2>You don't have any additional Tasks</h2>
                    </div>
              </md-content>
            </md-tab>
          </md-tabs>
        </md-content>
      </div>  
      <!-- Your Page Content Here -->
      </section>
    <!-- /.content -->


    <!-- Main content -->
    <section class="content">

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar Start-->
  <?php include '../dashboard/control_sidebar.php'; ?>
  
</div>
<!-- ./wrapper -->
</body>

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
    $scope.obj = {
      $niche: "",
      $numOfCompanies: 0
    };
     $scope.init = function () {
        $http.get("../../queries/getMyDailyTrackerTodayOjtResearchTracker.php").then(function (response) {
          $scope.today = response.data.records;
          if($scope.today[0].OJTResearcherId==""){
            $scope.exists=false;
          }else{
            $scope.exists=true;
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
        $http.post('../../insertFunctions/insertOjtResearcher.php', {
            'niche': $scope.obj.niche,
            'numOfCompanies': $scope.obj.numOfCompanies
            }).then(function(data, status){
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
        $http.post('../../editFunctions/editDailyTaskOjtResearcher.php', {
          'id': $scope.modalojtresearcherId,
          'niche': $scope.modalniche,
          'numOfCompanies': $scope.modalnumofcompanies
        }).then(function(data, status){
              $scope.init();
              $scope.showEdit();
        })
      };

      $scope.addAdditional = function(){
          $http.post('../../insertFunctions/insertAdditionalTask.php', {
              'userId': $scope.addTaskUserId,
              'name': $scope.addTaskName,
              'type': $scope.addTaskType
            }).then(function(data, status){
              $scope.init();
              $scope.showAdditional();
            })
        };

        $scope.showAdditional = function(ev) {
          $mdDialog.show(
            $mdDialog.alert()
            .parent(angular.element(document.querySelector('#popupContainer')))
            .clickOutsideToClose(true)
            .title('Successful Insertion!')
            .textContent('You have assigned your team member a Task.')
            .ariaLabel('Alert Dialog Demo')
            .ok('Got it!')
            .targetEvent(ev)
          );
        }
      $scope.modal = function() {
          $scope.modalojtresearcherId = $scope.today[0].OJTResearcherId;
          $scope.modalniche = $scope.today[0].Niche;
          $scope.modalnumofcompanies = $scope.today[0].NumOfCompanies;
      };

      $scope.addTaskModal = function(id) {
            $scope.addTaskUserId = id;
            $scope.addTaskName = "";
            $scope.addTaskType = "";
      };

      $scope.viewTaskModal = function(userId){
          $http.get('../../queries/getAdditionalTasksTeam.php?id='+userId).then(function (response){
            $scope.teamAdditional = response.data.records;
          });
      };

      $scope.editAdditional = function() {
        $http.post('../../editFunctions/editAdditionalTask.php', {
          'id': $scope.modalAddTaskId,
          'name': $scope.modalAddName,
          'type': $scope.modalAddType
        }).then(function(data, status){
          $scope.init();
          $scope.viewTaskModal($scope.modalAddUserId);  
        })
      };

      $scope.modalAdditional = function(taskId, name, type, userId) {
        $scope.modalAddTaskId = taskId;
        $scope.modalAddName = name;
        $scope.modalAddType = type;
        $scope.modalAddUserId = userId;
      };

      $scope.mod = {
          $modalAddTrackerId: "",
          $modalAddTrackerName: "",
          $modalAddTrackerType: "",
          $modalAddTrackerTask: "",
          $modalAddTrackerTime: "",
          $modalAddTrackerDate: "",
          $modalAddTrackerTaskId: ""
        };

        $scope.modalAddTracker = function(trackerId, name, type, task, time, date, taskId) {
            $scope.mod.modalAddTrackerId = trackerId;
            $scope.mod.modalAddTrackerName = name;
            $scope.mod.modalAddTrackerType = type;
            $scope.mod.modalAddTrackerTask = task;
            $scope.mod.modalAddTrackerTime = time;
            $scope.mod.modalAddTrackerDate = date;
            $scope.mod.modalAddTrackerTaskId = taskId;
        };

        $scope.editAdditionalTaskTracker = function() {
          $http.post('../../editFunctions/editDailyTaskAdditionalTask.php', {
            'id': $scope.mod.modalAddTrackerId,
            'task': $scope.mod.modalAddTrackerTask
          }).then(function(data, status){
              $scope.init(); 
          })
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