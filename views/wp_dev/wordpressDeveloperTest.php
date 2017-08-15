<?php
  include("../dashboard/dashboard.php");

  // $testJobTitle = 'Wordpress Developer';
  // if($_SESSION['jobTitle'] != $testJobTitle && !isOfJobTitle($_SESSION['user_id'], $testJobTitle)) {
  //   header("Location:../home/home.php");
  // }
?>
<body ng-app="taskFieldsApp" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Wordpress Developer
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
                                    <input ng-model="modalwordpressId" value="{{modalwordpressId}}" hidden>
                                      <md-input-container>
                                          <label>Fix Bugs</label>
                                          <input type="text" class="inp form-control" ng-model="modalfixbugCnt" value="{{modalfixbugCnt}}">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Create Pages</label>
                                          <input type="text" class="inp form-control" ng-model="modalcreatepageCnt" value="{{modalcreatepageCnt}}">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Responsive Design</label>
                                          <input type="text" class="inp form-control" ng-model="modalresponsivedesignCnt" value="{{modalresponsivedesignCnt}}">
                                  </md-input-container>
                                      <md-input-container>
                                          <label>Modify Pages/Files</label>
                                          <input type="text" class="inp form-control" ng-model="modalmodifypageCnt" value="{{modalmodifypageCnt}}">
                                  </md-input-container>
                                      <md-input-container>
                                          <label>Miscellaneous</label>
                                          <input type="text" class="inp form-control" ng-model="modalmiscCnt" value="{{modalmiscCnt}}">
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
                              <h3>Create Pages</h3>
                              <h3 class="articleName">{{ today[0].CreatePagesCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>

                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/responsiveDesign.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Responsive Design</h3>
                              <h3 class="articleName">{{ today[0].ResponsiveDesignCnt }}</h3>
                              
                            </div>
                          </div>
                        </md-list-item>

                        <md-list-item class="md-3-line">
                          <div style="width:95%;">
                            <img src="../../includes/img/articleIcon.png" class="md-avatar" style="float:left"/>
                            <div class="md-list-item-text">
                              <br>
                              <h3>Modify Pages</h3>
                              <h3 class="articleName">{{ today[0].ModifyPagesCnt }}</h3>
                              
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
                                          <label>Create Pages</label>
                                          <input style="font-size:20px" ng-model="obj.createpageCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Responsive Design</label>
                                          <input style="font-size:20px" ng-model="obj.responsivedesignCnt" type="number" min="0">
                                      </md-input-container>
                                      <md-input-container>
                                          <label>Modify Pages/Files</label>
                                          <input style="font-size:20px" ng-model="obj.modifypageCnt" type="number" min="0">
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
</body>

<script>

  var app = angular.module('taskFieldsApp', ['ngMaterial']);
  var x=0;
  app.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
  }]);
  app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
    
    $scope.obj = {
      $fixbugCnt: 0,
      $createpageCnt: 0,
      $responsivedesignCnt: 0,
      $modifypageCnt: 0,
      $miscCnt: 0
    };
     $scope.init = function () {
        $http.get("../../queries/getMyDailyTrackerTodayWordpress.php").then(function (response) {
          $scope.today = response.data.records;
          if($scope.today[0].WordpressId==""){
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
        $http.post('../../insertFunctions/insertWordpressTracker.php', {
            'fixbugCnt': $scope.obj.fixbugCnt, 
            'createpageCnt': $scope.obj.createpageCnt,
            'responsivedesignCnt': $scope.obj.responsivedesignCnt,
            'modifypageCnt': $scope.obj.modifypageCnt,
            'miscCnt': $scope.obj.miscCnt
            }).then(function(data, status){
              $scope.init();
              $scope.showAlert();
            })
      };

      $scope.editData = function() {
        $http.post('../../editFunctions/editDailyTaskWordpress.php', {
          'id': $scope.modalwordpressId,
          'fixbugCnt': $scope.modalfixbugCnt,
          'createpageCnt': $scope.modalcreatepageCnt,
          'responsivedesignCnt': $scope.modalresponsivedesignCnt,
          'modifypageCnt': $scope.modalmodifypageCnt,
          'miscCnt': $scope.modalmiscCnt
        }).then(function(data, status){
              $scope.init();
              $scope.showEdit();
        })
      };

      $scope.modal = function() {
          $scope.modalwordpressId = $scope.today[0].WordpressId;
          $scope.modalfixbugCnt = $scope.today[0].FixBugCnt;
          $scope.modalcreatepageCnt = $scope.today[0].CreatePagesCnt;
          $scope.modalresponsivedesignCnt = $scope.today[0].ResponsiveDesignCnt;
          $scope.modalmodifypageCnt = $scope.today[0].ModifyPagesCnt;
          $scope.modalmiscCnt = $scope.today[0].MiscCnt;
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