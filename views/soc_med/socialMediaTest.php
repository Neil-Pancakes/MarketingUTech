<?php
  include("../dashboard/dashboard.php");

  // $testJobTitle = 'Social Media Specialist';
  // if($_SESSION['jobTitle'] != $testJobTitle && !isOfJobTitle($_SESSION['user_id'], $testJobTitle)) {
  //   header("Location:../home/home.php");
  // }
?>
<body ng-app="taskFieldsApp" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Social Media Specialist
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
                      <md-button type="submit" class=" md-raised md-primary" style="width:20%; margin-top:3%;">Submit</md-button>
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

    </div>

  <!-- Control Sidebar Start-->
  <?php include '../dashboard/control_sidebar.php'; ?>
  
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
      $scope.additionalSet = {additional: []};
      $scope.additionalIdSet = {additionalId: []};
      $scope.additional = [];
      $scope.additionalId = [];
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
          $http.get("../../queries/getTeam.php").then(function (response) {
            $scope.team = response.data.records;
          });  
          $http.get("../../queries/getAdditionalTasks.php").then(function (response) {
            $scope.additionalTasks = response.data.records;
          });
          $http.get("../../queries/getMyDailyTrackerTodayAdditionalTaskTracker.php").then(function (response) {
            $scope.t 
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

        $scope.submitAdditionalTask = function() {
          alert($scope.additionalIdSet.additionalId);
            $http.post('../../insertFunctions/insertAdditionalTaskTracker.php', {
              'idSet': $scope.additionalIdSet.additionalId, 
              'taskSet': $scope.additionalSet.additional
              }).then(function(data, status){
                $scope.additionalSet = {additional: []};
                $scope.additionalIdSet = {additionalId: []};
                
                $scope.additionalSet.additional = [];
                $scope.additionalIdSet.additionalId = [];
                $scope.show = false;
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

        $scope.addAdditional = function(){
          alert($scope.addTaskName);
          $http.post('../../insertFunctions/insertAdditionalTask.php', {
              'userId': $scope.addTaskUserId,
              'name': $scope.addTaskName,
              'type': $scope.addTaskType
            }).then(function(data, status){
                $scope.init();
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

        $scope.addTaskModal = function(id) {
            $scope.addTaskUserId = id;
            $scope.addTaskName = "";
            $scope.addTaskType = "";
        };
  });
</script>