<?php
  include("../dashboard/dashboard.php");

  // $testJobTitle = 'Content Marketing Assistant';
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
      <h1>Content Marketing Assistant
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
                      <div id="optionModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <form ng-submit="editData()">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h2 id="modalHeaderEditDelete">Task</h2>
                                </div>
                                <div class="modal-body">
                                  <md-content layout-padding>
                                    <div> 
                                    <input ng-model="modalcontentmarketingassistantId" hidden>
                                      <md-input-container>
                                          <label>Curated</label>
                                          <input type="text" class="inp form-control" ng-model="modalcuratedCnt">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Drafted</label>
                                          <input type="text" class="inp form-control" ng-model="modaldraftedCnt">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Pictures</label>
                                          <input type="text" class="inp form-control" ng-model="modalpictureCnt">
                                  </md-input-container>
                                      <md-input-container>
                                          <label>Videos</label>
                                          <input type="text" class="inp form-control" ng-model="modalvideoCnt">
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
                          </form>
                        </div>
                      </div>
                      <!--END of Edit Modal-->
                  <md-content>
                    <md-list flex>
                        <div align="center">
                          <md-button ng-show="delBtn" type="submit" class=" md-raised" style="width:20%; background-color:darkred; color:white;">Delete <span class="fa fa-trash"></span></md-button>
                        </div>
                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/curatedIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Curated</h3>
                              <h3 class="articleName">{{ today[0].CuratedCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>
                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/draftedIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Drafted</h3>
                              <h3 class="articleName">{{ today[0].DraftedCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>

                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/pictureIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Pictures</h3>
                              <h3 class="articleName">{{ today[0].PictureCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>

                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/videoIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Videos</h3>
                              <h3 class="articleName">{{ today[0].VideoCnt }}</h3>
                              
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
                        <div class="jumbotron"  ng-if="exists==false">
                            <p style="font-size:30px;">Task Count for today </p>
                            <md-content layout-padding>
                                <div>
                                      <md-input-container>
                                          <label>Curated</label>
                                          <input style="font-size:20px" ng-model="obj.curatedCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Drafted</label>
                                          <input style="font-size:20px" ng-model="obj.draftedCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Pictures</label>
                                          <input style="font-size:20px" ng-model="obj.pictureCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Videos</label>
                                          <input style="font-size:20px" ng-model="obj.videoCnt" type="number" min="0">
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
      $('#homeTab').removeClass('active');
      $('#trackerTab').addClass('active');
  });

    var app = angular.module('taskFieldsApp', ['ngMaterial']);
    var x=0;
    app.config(['$qProvider', function ($qProvider) {
      $qProvider.errorOnUnhandledRejections(false);
    }]);
    app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
      $scope.obj = {
        $curatedCnt: 0,
        $draftedCnt: 0,
        $pictureCnt: 0,
        $videoCnt: 0,
        $miscCnt: 0
      };
       $scope.init = function () {
          $http.get("../../queries/getMyDailyTrackerTodayContentMarketingAsisstantTracker.php").then(function(response) {
            $scope.today = response.data.records;
            if($scope.today[0].ContentMarketingAssistantId==""){
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
          $http.post('../../insertFunctions/insertContentMarketingAssistant.php', {
              'curatedCnt': $scope.obj.curatedCnt,
              'draftedCnt': $scope.obj.draftedCnt,
              'pictureCnt': $scope.obj.pictureCnt,
              'videoCnt': $scope.obj.videoCnt,
              'miscCnt': $scope.obj.miscCnt
              }).then(function(data, status){
                $scope.init();
                $scope.showAlert();
              })
        };

        $scope.editData = function() {
          $http.post('../../editFunctions/editDailyTaskContentMarketingAssistant.php', {
            'id': $scope.modalcontentmarketingassistantId,
            'curatedCnt': $scope.modalcuratedCnt,
            'draftedCnt': $scope.modaldraftedCnt,
            'pictureCnt': $scope.modalpictureCnt,
            'videoCnt':  $scope.modalvideoCnt,
            'miscCnt': $scope.modalmiscCnt
          }).then(function(data, status){
                $scope.init();
                $scope.showEdit();
          })
        };

        $scope.modal = function() {
            $scope.modalcontentmarketingassistantId = $scope.today[0].ContentMarketingAssistantId;
            $scope.modalcuratedCnt = $scope.today[0].CuratedCnt;
            $scope.modaldraftedCnt = $scope.today[0].DraftedCnt;
            $scope.modalpictureCnt = $scope.today[0].PictureCnt;
            $scope.modalvideoCnt = $scope.today[0].VideoCnt;
            $scope.modalmiscCnt = $scope.today[0].MiscCnt;
        };
  });
</script>