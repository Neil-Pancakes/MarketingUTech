<?php
  include("../dashboard/dashboard.php");

  // $testJobTitle = 'OJT Web Development';
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
      <h1>OJT Web Developer
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
                   <!--Edit Modal-->
                      <form ng-submit="editData()">
                          <div id="optionModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h2 id="modalHeaderEditDelete">Task</h2>
                                </div>
                                <div class="modal-body">
                                  <md-content layout-padding>
                                    <div> 
                                    <input ng-model="modalojtwebdevId" hidden>
                                      <md-input-container>
                                          <label>Fix Bugs</label>
                                          <input type="text" class="inp form-control" ng-model="modalfixbugCnt">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Responsive</label>
                                          <input type="text" class="inp form-control" ng-model="modalresponsiveCnt">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Backup</label>
                                          <input type="text" class="inp form-control" ng-model="modalbackupCnt">
                                  </md-input-container>
                                      <md-input-container>
                                          <label>Optimize</label>
                                          <input type="text" class="inp form-control" ng-model="modaloptimizeCnt">
                                  </md-input-container>
                                      <md-input-container>
                                          <label>Miscellaneous</label>
                                          <input type="text" class="inp form-control" ng-model="modalmiscCnt">
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
                            <img src="../../includes/img/bugFix.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Fix Bugs</h3>
                              <h3 class="articleName">{{ today[0].FixBugCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>
                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/pageIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Responsive</h3>
                              <h3 class="articleName">{{ today[0].ResponsiveCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>

                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/responsiveDesign.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Backup</h3>
                              <h3 class="articleName">{{ today[0].BackupCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>

                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/articleIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Optimize/Customize</h3>
                              <h3 class="articleName">{{ today[0].OptimizeCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>

                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/miscIcon.png" class="md-avatar" style="float:left"/>
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
                                          <label>Fix Bugs</label>
                                          <input style="font-size:20px" ng-model="obj.fixbugCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Responsive</label>
                                          <input style="font-size:20px" ng-model="obj.responsiveCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Backup</label>
                                          <input style="font-size:20px" ng-model="obj.backupCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Optimize/Customize</label>
                                          <input style="font-size:20px" ng-model="obj.optimizeCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Miscellaneous</label>
                                          <input style="font-size:20px" ng-model="obj.miscCnt" type="number" min="0">
                                      </md-input-container>
                                  </div>
                            </md-content>
                            <div class="footer" align="center">
                                <md-button id="submitBtn" type="submit" class=" md-raised md-primary">Submit</md-button>
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

  <!-- Control Sidebar Start-->
  <?php include '../dashboard/control_sidebar.php'; ?>
  
</div>
<!-- ./wrapper -->
<script>
  document.getElementById("taskTracker").setAttribute("class", "active");

  $(document).ready(function(){
      document.getElementById("year").innerHTML = new Date().getFullYear();
      $('#homeTab').removeClass('active');
      $('#trackerTab').addClass('active');
  });
  
    var app = angular.module('taskFieldsApp', ['ngMaterial']);
    var x=0;
    app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
      $scope.obj = {
        $fixbugCnt: 0,
        $responsiveCnt: 0,
        $backupCnt: 0,
        $optimizeCnt: 0,
        $miscCnt: 0
      };
       $scope.init = function () {
          $http.get("../../queries/getMyDailyTrackerTodayOjtWebdevTracker.php").then(function (response) {
            $scope.today = response.data.records;
            if($scope.today[0].OJTWebDevId==""){
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
          $http.post('../../insertFunctions/insertOJTWebDevTracker.php', {
              'fixbugCnt': $scope.obj.fixbugCnt, 
              'responsiveCnt': $scope.obj.responsiveCnt,
              'backupCnt': $scope.obj.backupCnt,
              'optimizeCnt': $scope.obj.optimizeCnt,
              'miscCnt': $scope.obj.miscCnt
              }).then(function(data, status){
                $scope.init();
                $scope.showAlert();
              })
        };
        $scope.editData = function() {
          $http.post('../../editFunctions/editDailyTaskOJTWebDev.php', {
            'id': $scope.modalojtwebdevId,
            'fixbugCnt': $scope.modalfixbugCnt,
            'responsiveCnt': $scope.modalresponsiveCnt,
            'backupCnt': $scope.modalbackupCnt,
            'optimizeCnt': $scope.modaloptimizeCnt,
            'miscCnt': $scope.modalmiscCnt
          }).then(function(data, status){
                $scope.init();
                $scope.showEdit();
          })
        };
        $scope.modal = function() {
            $scope.modalojtwebdevId = $scope.today[0].OJTWebDevId;
            $scope.modalfixbugCnt = $scope.today[0].FixBugCnt;
            $scope.modalresponsiveCnt = $scope.today[0].ResponsiveCnt;
            $scope.modalbackupCnt = $scope.today[0].BackupCnt;
            $scope.modaloptimizeCnt = $scope.today[0].OptimizeCnt;
            $scope.modalmiscCnt = $scope.today[0].MiscCnt;
        };
  });
</script>