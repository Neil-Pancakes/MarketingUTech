<?php
  require ("../../functions/php_globals.php");
  require ("../dashboard/dashboard.php");

  /*if (!isAdmin($_SESSION['user_id'])) {
    header("Location:../home/home.php");
  }

  if(!isset($_GET["id"])){
    header("Location:employeeList.php");
  }

  $qry = "SElECT * FROM users WHERE id = ".$_GET['id'];
  $result = mysqli_query($mysqli, $qry);

  if($result){
    if(mysqli_num_rows($result) != 1){
      header("Location:employeeList.php");
    }
  }

  $_SESSION["filter_id"] = $_GET["id"];*/
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-app="taskFieldsApp" ng-cloak ng-controller="taskFieldsController as ctrl" data-ng-init="init()">
      <form ng-submit="search()">
          <input type="text" name="user_id" value="<?php echo $_GET["id"]; ?>" hidden />
          <md-content layout-padding ng-cloak>
            <div layout-gt-xs="row">
              <div flex-gt-xs>
                <h4>Filter Date</h4>
                <md-datepicker ng-model="ctrl.startDate" md-placeholder="Start date"></md-datepicker>
                <md-datepicker ng-model="ctrl.endDate" md-placeholder="End date"></md-datepicker>
                <md-button class="md-accent md-raised md-hue-2">Search</md-button>
                
              </div>
            </div>
          </md-content>
        </form>
      
      <table id="timetable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Time Stamp</th>

                <?php

                //Writer
                
                if($_SESSION['jobTitle']=='Writer'){
                  echo'<th>Article</th>
                  <th>Word Count</th>';
                }
                
                //Editor
                if($_SESSION['jobTitle']=='Editor'){
                echo'<th>Article</th>
                <th>Writer</th>
                <th>Word Count</th>';
                }
                //Marketing, Trackimo Customer Support, SEO Specialist/Internet Marketing
                if($_SESSION['jobTitle']=='Marketing Specialist'
                || $_SESSION['jobTitle']=='Trackimo Customer Support'
                || $_SESSION['jobTITLE']=="SEO Specialist"){
                  
                echo'<th>Task Description</th>';
                }

                //Social Media Specialist
                if($_SESSION['jobTitle']=='Social Media Specialist'){
                  echo'<th>FB Balay</th>
                  <th>Pinterest Balay</th>
                  <th>FB/Twitter/IG MB</th>
                  <th>FB/Twitter/IG Taft</th>
                  <th>FB WA</th>';
                }
                
                //Multimedia Specialists
                if($_SESSION['jobTitle']=='Multimedia Specialist'){
                echo'<th>Featured Image</th>
	              <th>Graphic Designing</th>
                <th>Banner</th>
	              <th>Miscellaneous</th>';
                }

                //Data Processor
                if($_SESSION['jobTitle']=='Data Processor'){
                echo'
                <th>Status</th>
                <th>Task Description</th>';
                }
                //Wordpress Developer
                if($_SESSION['jobTitle']=='Wordpress Developer'){
                echo'<th>Fix bugs</th>
	              <th>Create pages</th>
	              <th>Responsive design</th>
	              <th>Modify pages/Files</th>
                <th>Miscellaneous</th>';
                }

                //Content Marketing Assistant
                if($_SESSION['jobTitle']=='Content Marketing Assistant'){
                echo'<th>Curated</th>
                <th>Drafted</th>
	              <th>Pictures</th>
	              <th>Videos</th>
                <th>Miscellaneous</th>';
                }

                //OJT Web Development
                if($_SESSION['jobTitle']=='OJT Web Development'){
                echo'<th>Fix bugs</th>
		            <th>Responsive</th>
		            <th>Backup</th>
		            <th>Optimize/Customize</th>
	              <th>Miscellaneous</th>';
                }

                //OJT SEO
                if($_SESSION['jobTitle']=='OJT SEO'){
                echo'<th>Commenting 10 per day</th>
		            <th>Site Audit</th>
		            <th>Schema Markup</th>
		            <th>Competitor Backlink Analysis</th>
		            <th>Relationship Link Research</th>
                <th>Miscellaneous</th>';
                }

                //OJT Developer for Automated Data System
                if($_SESSION['jobTitle']=='OJT System Developer'){
                echo'<th>Create Website</th>
		            <th>Organize/Optimize</th>
		            <th>Miscellaneous</th>';
                }
                
                //OJT Researcher
                if($_SESSION['jobTitle']=='Writer'){
                echo'<th>Niche</th>
                <th>Number of Companies</th>';
                }
?>


            </tr>
        </thead>
        <tbody id="timetable-tbody">
          
        </tbody>
      </table>
      <div style="margin-bottom:30%;"></div> <!--Used because of visual bug-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
        $scope.init = function () {
          $http.get("../../queries/getMyDailyTrackerTodayWriter.php").then(function (response) {
            
          });
        };

        $scope.search = function(id, start_date, end_date){
          
        }
    });
</script>
<script>
$(document).ready(function(){
  $('#timetable').DataTable();
});
</script>


