<?php
  include("../dashboard/dashboard.php");

  // $testJobTitle = 'OJT System Developer';
  // if($_SESSION['jobTitle'] != $testJobTitle && !isOfJobTitle($_SESSION['user_id'], $testJobTitle)) {
  //   header("Location:../home/home.php");
  // }
?>
  <head>
      <style>
          label{
              font-size:15px;
          }
      </style>
  </head>

  <!-- Body Start -->
  <body ng-app="taskFieldsApp">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>OJT System Developer
          <small>UniversalTech</small>
        </h1>
      </section>

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
                  <md-list-item class="md-3-line" ng-repeat="x in todayAdditional track by $index">
                    <img src="../../includes/img/taskIcon.png" class="md-avatar" style="float:left"/>
                      <div class="md-list-item-text">
                        <h3>{{x.Name}}</h3>
                        <h3 class="articleName">{{ x.Task }}</h3>
                        
                      </div>
                  </md-list-item>
                  <!--Edit Modal-->
                  <form ng-submit="editData()">
                      <div id="optionModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                    <!--END of Edit Modal-->
                  </md-content>         
                </md-tab>
                <md-tab label="add tasks">
                  <md-content class="md-padding">
                    <form ng-submit="submitData()">
                      <div id="taskHolderOjt" class="container" style="max-width:100%;">
                        <div class="jumbotron" ng-if="exists==false">
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
                  <form ng-submit="submitAdditionalTask()">
                    <md-list-item class="md-3-line" ng-repeat="x in additionalTasks track by $index">
                    <img src="../../includes/img/taskIcon.png" class="md-avatar" style="float:left"/>
                    <div class="md-list-item-text">
                    <h3>{{x.Name}}</h3>
                      
                        <input ng-model="additionalId[$index]" ng-init="additionalIdSet.additionalId[$index] = x.AdditionalTaskId" hidden>
                        <textarea ng-if='x.Type=="Text"' ng-model="additionalSet.additional[$index]" rows="5" cols="40" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" required></textarea>
                        <input ng-if='x.Type=="Int"' ng-model="additionalSet.additional[$index]" type="number" required>
                        <select ng-if='x.Type=="Binary"' ng-model="additionalSet.additional[$index]" required>
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
      </section>

      <?php include '../dashboard/control_sidebar.php'; ?>
    
    </body>
  <!-- ./wrapper -->
  
</div>
<!-- ./wrapper -->
<script>
      var app = angular.module('taskFieldsApp', ['ngMaterial']);
      var x=0;
      app.config(['$qProvider', function ($qProvider) {
        $qProvider.errorOnUnhandledRejections(false);
      }]);
      app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
        $scope.obj = {
          $createWebsite: "",
          $organize: "",
          $misc: ""
        };
         $scope.init = function () {
            $http.get("../../queries/getMyDailyTrackerTodayOjtDeveloperSystemTracker.php").then(function (response) {
              $scope.today = response.data.records;
              if($scope.today[0].OJTDeveloperSystemId==""){
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
            $http.post('../../insertFunctions/insertOjtDeveloperSystem.php', {
                'createWebsite': $scope.obj.createWebsite,
                'organize': $scope.obj.organize,
                'misc': $scope.obj.misc
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
            $http.post('../../editFunctions/editDailyTaskOJTSystemDeveloper.php', {
              'id': $scope.modalojtdevelopersystemId,
              'createWebsite': $scope.modalcreatewebsite,
              'organize': $scope.modalorganize,
              'misc': $scope.modalmisc
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
              $scope.modalojtdevelopersystemId = $scope.today[0].OJTDeveloperSystemId;
              $scope.modalcreatewebsite = $scope.today[0].CreateWebsite;
              $scope.modalorganize = $scope.today[0].Organize;
              $scope.modalmisc = $scope.today[0].Misc;
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
  });
</script> 
<script>
  document.getElementById("taskTracker").setAttribute("class", "active");
  
  $(document).ready(function(){
      $('#homeTab').removeClass('active');
      $('#trackerTab').addClass('active');
  });
</script> 