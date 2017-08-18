<?php
  include("../dashboard/dashboard.php");

  // $testJobTitle = 'OJT SEO';
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
      <h1>OJT SEO
        <small>UniversalTech</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      <div ng-controller="taskFieldsController" data-ng-init="init()">

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
                          <label>Commenting 10 per day</label>
                          <select ng-model="modalcomment">
                            <option ng-repeat="x in options">{{x}}</option>
                          </select><br>
                          <label>Site Audit</label>
                          <select ng-model="modalsite">
                            <option ng-repeat="x in options">{{x}}</option>
                          </select><br>
                          <label>Schema Markup</label>
                          <select ng-model="modalschema">
                            <option ng-repeat="x in options">{{x}}</option>
                          </select><br>
                          <label>Competitor Backlink Analysis</label>
                          <select ng-model="modalcompetitor">
                            <option ng-repeat="x in options">{{x}}</option>
                          </select><br>
                          <label>Relationship Link Research</label>
                          <select ng-model="modalrelationship">
                            <option ng-repeat="x in options">{{x}}</option>
                          </select>
                          <textarea ng-model="modalmisc" placeholder="Miscellaneous Ex: I did this today..." rows="15"id="comment_text" cols="20" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" style="border:solid 1px lightgrey; margin-left:5%;"></textarea>
                        </md-content>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" onclick="$('#optionModal').modal('hide');">Edit <span class="fa fa-edit"></span></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </md-content>
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
                        <h3>Comment</h3>
                        <h3 class="articleName">{{ today[0].Comment }}</h3>
                      </div>
                    </div>
                  </md-list-item>

                  <md-list-item class="md-3-line">
                    <div style="width:95%;">
                      <img src="../../includes/img/pageIcon.png" class="md-avatar" style="float:left"/>
                      <div class="md-list-item-text">
                        <br>
                        <h3>Site Audit</h3>
                        <h3 class="articleName">{{ today[0].SiteAudit }}</h3>
                      </div>
                    </div>
                  </md-list-item>

                  <md-list-item class="md-3-line">
                    <div style="width:95%;">
                      <img src="../../includes/img/responsiveDesign.png" class="md-avatar" style="float:left"/>
                      <div class="md-list-item-text">
                        <br>
                        <h3>Schema Markup</h3>
                        <h3 class="articleName">{{ today[0].SchemaMarkup }}</h3>
                      </div>
                    </div>
                  </md-list-item>

                  <md-list-item class="md-3-line">
                    <div style="width:95%;">
                      <img src="../../includes/img/articleIcon.png" class="md-avatar" style="float:left"/>
                      <div class="md-list-item-text">
                        <br>
                        <h3>Competitor Backlink Analysis</h3>
                        <h3 class="articleName">{{ today[0].CompetitorBacklinkAnalysis }}</h3>
                      </div>
                    </div>
                  </md-list-item>

                  <md-list-item class="md-3-line">
                    <div style="width:95%;">
                      <img src="../../includes/img/miscIcon.png" class="md-avatar" style="float:left"/>
                      <div class="md-list-item-text">
                        <br>
                        <h3>Relationship Link Research</h3>
                        <h3 class="articleName">{{ today[0].RelationshipLinkResearch }}</h3>
                      </div>
                    </div>
                  </md-list-item>

                  <md-card>
                    <span class="md-headline">Miscellaneous</span>
                    <md-card-content>
                        <p style="text-align:left;">{{today[0].Misc}}</p>
                    </md-card-content>
                  </md-card>
              </md-list>
            </md-content>

            <md-tab label="add tasks">
              <md-content class="md-padding">
                <form ng-submit="submitData()">
                  <div id="taskHolderOjt" class="container" style="max-width:100%;">
                      <div class="jumbotron"  ng-if="exists==false">
                          <p style="font-size:30px;">Tasks for today </p>
                          <md-content layout-padding>
                              <div>
                                    <br>
                                    <md-input-container>
                                        <label>Commenting 10 per day</label>
                                        <md-select ng-model="status.p1">
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
                                      <textarea ng-model="status.taskDesc" placeholder="Miscellaneous 
            Ex: I did this today..." rows="15"id="comment_text" cols="20" class="area ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" maxlength="2500" style="border:solid 1px lightgrey; margin-left:5%;"></textarea>
                                
                                </div>
                          </md-content>
                        <div class="footer" align="center">
                            <md-button id="submitBtn" type="submit" class=" md-raised md-primary" ng-model="submitBtn" style="width:60%; margin-right:10%">Submit</md-button>
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
          $http.get("../../queries/getMyDailyTrackerTodayOjtSeoTracker.php").then(function (response) {
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
          $http.post('../../insertFunctions/insertOJTSeo.php', {
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
        $scope.editData = function() {
          $http.post('../../editFunctions/editDailyTaskOJTSeo.php', {
            'id': $scope.modalojtseoId,
            'comment': $scope.modalcomment,
            'site': $scope.modalsite,
            'schema': $scope.modalschema,
            'competitor': $scope.modalcompetitor,
            'relationship': $scope.modalrelationship,
            'misc': $scope.modalmisc
          }).then(function(data, status){
                $scope.init();
                $scope.showEdit();
          })
        };
        $scope.modal = function() {
            $scope.modalojtseoId = $scope.today[0].OJTSeoId;
            $scope.modalcomment = $scope.today[0].Comment;
            $scope.modalsite = $scope.today[0].SiteAudit;
            $scope.modalschema = $scope.today[0].SchemaMarkup;
            $scope.modalcompetitor = $scope.today[0].CompetitorBacklinkAnalysis;
            $scope.modalrelationship = $scope.today[0].RelationshipLinkResearch;
            $scope.modalmisc = $scope.today[0].Misc;
        };
  });
</script>