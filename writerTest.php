<?php
        include("dashboard.php");
?>
<head>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
	  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Tracker</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      <div ng-controller="taskFieldsController">
        <form ng-submit="submitData()">
          <div id="taskHolderOjt" class="container">
              <div class="jumbotron">
                  <p style="font-size:30px;">Tasks for today <md-button id="addTaskBtn" class="btn md-raised" ng-click="addNewTask()" style=" background-color: #00d200; color:white;">Add Task <span class="fa fa-plus"></span></md-button></p>
                  <div class="task-group">
                  <fieldset data-ng-repeat = "field in articleSet.articles track by $index">
                        <div>
                              <div style="display:inline-block;" class="col-xs-7">
                                  <input type="text" class="inp form-control" placeholder="Article Name" name="articleList" ng-model="articleSet.articles[$index]" required>
                              </div>
                              <div style="display:inline-block;" class="col-xs-3">
                                  <input type="number" class="inp form-control" placeholder="Words Changed" name="wordCntList" ng-model="wordSet.words[$index]" min="1" required>
                              </div>
                              <div style="display:inline-block;" class="col-xs-2">
                                  <span>
                                      <button type="button" class="btn delTaskBtn btn-danger" ng-click="removeTask($index)"><span class="fa fa-remove"></span></button>
                                  </span>
                              </div>
                          </div>
                  </fieldset>
                  </div>
                  <div class="footer" align="center">
                      <md-button ng-show="show" id="submitBtn" type="submit" class=" md-raised md-primary" ng-model="submitBtn" style="width:20%; margin-top:3%;">Submit</md-button>
                  </div>
              </div>
          </div>
        </form>
      </div>
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Marketing Department Daily Tracker
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <span id="year"></span> <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

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
$(document).ready(function(){
    document.getElementById("year").innerHTML = new Date().getFullYear();
    $('#homeTab').removeClass('active');
    $('#trackerTab').addClass('active');
});
</script>

<script>
    var app = angular.module('taskFieldsApp', ['ngMaterial']);
    var x=0;
    app.controller('taskFieldsController', function($scope, $http) {
        $scope.articleSet = {articles: []};
        $scope.wordSet = {words: []};
        
        $scope.articleSet.articles = [];
        $scope.wordSet.words = [];
        $scope.addNewTask = function() {
          $scope.articleSet.articles.push('');
          $scope.wordSet.words.push('');
          x++;
          if(x>0){
            $scope.show = true;
          }
        };

        $scope.removeTask = function(z) {
            $scope.articleSet.articles.splice(z, 1);
            $scope.wordSet.words.splice(z, 1);
            if(x>0){
              x--;
            }
            if(x==0){
              $scope.show = false;
            }
        };

        $scope.submitData = function() {
            $http.post('insertWriterTracker.php', {
              'articleSet': $scope.articleSet.articles, 
              'wordSet': $scope.wordSet.words
              }).success(function(data, status){
                $scope.articleSet = {articles: []};
                $scope.wordSet = {words: []};
                
                $scope.articleSet.articles = [];
                $scope.wordSet.words = [];
                x=0;
                $scope.show = false;
              })
            /*$http({
                method: 'GET',
                url: 'http://localhost/Marketing/insertWriterTracker.php',
                data: {
                  'articleSet': $scope.articleSet.articles, 
                  'wordSet': $scope.wordSet.words
                }
            }).then(function(data){
               alert(JSON.stringify(data));
            });*/
        };
    });

</script>