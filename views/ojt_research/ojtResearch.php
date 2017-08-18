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
                                      <input ng-model="addTaskUserId">
                                      <input class="form-control" ng-model="addTaskName" required>
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

      $scope.modal = function() {
          $scope.modalojtresearcherId = $scope.today[0].OJTResearcherId;
          $scope.modalniche = $scope.today[0].Niche;
          $scope.modalnumofcompanies = $scope.today[0].NumOfCompanies;
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