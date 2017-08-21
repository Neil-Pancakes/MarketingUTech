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
        <div>
          <input type="text" ng-model="userId" ng-init="userId = '<?php echo $_GET['id'];?>'" hidden />
          <md-content layout-padding ng-cloak>
            <div layout-gt-xs="row">
              <div flex-gt-xs>
                <h4>Filter Date</h4>
                <md-datepicker ng-model="ctrl.startDate" md-placeholder="Start date" required></md-datepicker>
                <md-datepicker ng-model="ctrl.endDate" md-placeholder="End date" required></md-datepicker>
                <md-button class="md-accent md-raised md-hue-2" type="submit">Search</md-button>
              </div>
            </div>
          </md-content>
        </form>
      
      <table id="timetable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Time Stamp</th>
<?php
                $qry = "SElECT * FROM users WHERE id = ".$_GET['id'];
                $result = mysqli_query($mysqli, $qry);
                $row = mysqli_fetch_assoc($result);

                $_SESSION["jobTitle"] = $row["jobTitle"];
?>
                <input ng-model="userJob" ng-init="userJob = '<?php echo $_SESSION['jobTitle'];?>'" hidden>
                <!--Writer-->
                <th ng-show="Writer">Article</th>
                <th ng-show="Writer">Word Count</th>
                
                <!--Editor-->
                <th ng-show="Editor">Article</th>
                <th ng-show="Editor">Writer</th>
                <th ng-show="Editor">Word Count</th>
                
                <!--Marketing, Trackimo Customer Support, SEO Specialist/Internet Marketing-->
                <th ng-show="Marketing">Task Description</th>

                <!--Social Media Specialist-->
                <th ng-show="SocialMediaSpecialist">FB Balay</th>
                <th ng-show="SocialMediaSpecialist">Pinterest Balay</th>
                <th ng-show="SocialMediaSpecialist">FB/Twitter/IG MB</th>
                <th ng-show="SocialMediaSpecialist">FB/Twitter/IG Taft</th>
                <th ng-show="SocialMediaSpecialist">FB WA</th>
                
                <!--Multimedia Specialists-->
                <th ng-show="MultimediaSpecialist">Featured Image</th>
	              <th ng-show="MultimediaSpecialist">Graphic Designing</th>
                <th ng-show="MultimediaSpecialist">Banner</th>
	              <th ng-show="MultimediaSpecialist">Miscellaneous</th>

                <!--Data Processor-->
                <th ng-show="DataProcessor">Status</th>
                <th ng-show="DataProcessor">Task Description</th>
               
                <!--Wordpress Developer-->
                <th ng-show="WordpressDeveloper">Fix bugs</th>
	              <th ng-show="WordpressDeveloper">Create pages</th>
	              <th ng-show="WordpressDeveloper">Responsive design</th>
	              <th ng-show="WordpressDeveloper">Modify pages/Files</th>
                <th ng-show="WordpressDeveloper">Miscellaneous</th>

                <!--Content Marketing Assistant-->
                <th ng-show="ContentMarketingAssistant">Curated</th>
                <th ng-show="ContentMarketingAssistant">Drafted</th>
	              <th ng-show="ContentMarketingAssistant">Pictures</th>
	              <th ng-show="ContentMarketingAssistant">Videos</th>
                <th ng-show="ContentMarketingAssistant">Miscellaneous</th>

                <!--OJT Web Development-->
                <th ng-show="OJTWebDevelopment">Fix bugs</th>
		            <th ng-show="OJTWebDevelopment">Responsive</th>
		            <th ng-show="OJTWebDevelopment">Backup</th>
		            <th ng-show="OJTWebDevelopment">Optimize/Customize</th>
	              <th ng-show="OJTWebDevelopment">Miscellaneous</th>

                <!--OJT SEO-->
                <th ng-show="OJTSEO">Commenting 10 per day</th>
		            <th ng-show="OJTSEO">Site Audit</th>
		            <th ng-show="OJTSEO">Schema Markup</th>
		            <th ng-show="OJTSEO">Competitor Backlink Analysis</th>
		            <th ng-show="OJTSEO">Relationship Link Research</th>
                <th ng-show="OJTSEO">Miscellaneous</th>

                <!--OJT Developer for Automated Data System-->
                <th ng-show="OJTDeveloperforAutomatedDataSystem">Create Website</th>
		            <th ng-show="OJTDeveloperforAutomatedDataSystem">Organize/Optimize</th>
		            <th ng-show="OJTDeveloperforAutomatedDataSystem">Miscellaneous</th>
                
                <!--OJT Researcher-->
                <th ng-show="OJTResearcher">Niche</th>
                <th ng-show="OJTResearcher">Number of Companies</th>
            </tr>
        </thead>
        <tbody id="timetable-tbody">
          <tr ng-repeat="x in tracker">
            <td>{{x.Timestamp}}</td>

            <td ng-show="Writer">{{x.Article}}</td>
            <td ng-show="Writer">{{x.WordCnt}}</td>

            <td ng-show="Editor">{{x.Article}}</td>
            <td ng-show="Editor">{{x.Writer}}</td>
            <td ng-show="Editor">{{x.WordCnt}}</td>

            <td ng-show="Marketing">{{x.Task}}</td>

            <td ng-show="SocialMediaSpecialist">{{x.FBCnt}}</td>
            <td ng-show="SocialMediaSpecialist">{{x.PinterestCnt}}</td>
            <td ng-show="SocialMediaSpecialist">{{x.MBCnt}}</td>
            <td ng-show="SocialMediaSpecialist">{{x.TaftCnt</td>
            <td ng-show="SocialMediaSpecialist">{{x.WACnt}}</td>

            <td ng-show="MultimediaSpecialist">{{x.FeaturedCnt}}</td>
            <td ng-show="MultimediaSpecialist">{{x.GraphicCnt}}</td>
            <td ng-show="MultimediaSpecialist">{{x.BannerCnt}}</td>
            <td ng-show="MultimediaSpecialist">{{x.MiscCnt}}</td>

            <td ng-show="DataProcessor">{{x.Status}}</td>
            <td ng-show="DataProcessor">{{x.Task}}</td>
            
            <td ng-show="WordpressDeveloper">{{x.FixBugCnt}}</td>
            <td ng-show="WordpressDeveloper">{{x.CreatePageCnt}}</td>
            <td ng-show="WordpressDeveloper">{{x.ResponsiveCnt}}</td>
            <td ng-show="WordpressDeveloper">{{x.ModifyCnt}}</td>
            <td ng-show="WordpressDeveloper">{{x.MiscCnt}}</td>

            <td ng-show="ContentMarketingAssistant">{{x.CuratedCnt}}</td>
            <td ng-show="ContentMarketingAssistant">{{x.DraftedCnt}}</td>
            <td ng-show="ContentMarketingAssistant">{{x.PictureCnt}}</td>
            <td ng-show="ContentMarketingAssistant">{{x.VideoCnt}}</td>
            <td ng-show="ContentMarketingAssistant">{{x.MiscCnt}}</td>

            <td ng-show="OJTWebDevelopment">{{x.FixBugCnt}}</td>
            <td ng-show="OJTWebDevelopment">{{x.ResponsiveCnt}}</td>
            <td ng-show="OJTWebDevelopment">{{x.BackupCnt}}</td>
            <td ng-show="OJTWebDevelopment">{{x.OptimizeCnt}}</td>
            <td ng-show="OJTWebDevelopment">{{x.MiscCnt}}</td>
            
            <td ng-show="OJTSEO">{{x.Comment}}</td>
            <td ng-show="OJTSEO">{{x.SiteAudit}}</td>
            <td ng-show="OJTSEO">{{x.SchemaMarkup}}</td>
            <td ng-show="OJTSEO">{{x.CompetitorBacklinkAnalysis}}</td>
            <td ng-show="OJTSEO">{{x.RelationshipLinkResearch}}</td>
            <td ng-show="OJTSEO">{{x.Misc}}</td>
            
            <td ng-show="OJTDeveloperforAutomatedDataSystem">{{x.CreateWebsite}}</td>
            <td ng-show="OJTDeveloperforAutomatedDataSystem">{{x.Organize}}</td>
            <td ng-show="OJTDeveloperforAutomatedDataSystem">{{x.Misc}}</td>
            
            <td ng-show="OJTResearcher">{{x.Niche}}</td>
            <td ng-show="OJTResearcher">{{x.NumCompanies}}</td>
          </tr>
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
          $scope.Writer = false;
          $scope.Editor = false;
          $scope.Marketing = false;
          $scope.SocialMediaSpecialist = false;
          $scope.MultimediaSpecialist = false;
          $scope.DataProcessor = false;
          $scope.WordpressDeveloper = false;
          $scope.ContentMarketingAssistant = false;
          $scope.OJTWebDevelopment = false;
          $scope.OJTSEO = false;
          $scope.OJTDeveloperforAutomatedDataSystem = false;
          $scope.OJTResearcher = false;
        };

        $scope.search = function(){
          $scope.date1 = moment($scope.ctrl.startDate).format('YYYY-MM-DD');
          $scope.date2 = moment($scope.ctrl.endDate).format('YYYY-MM-DD');
          if($scope.userJob=="Writer"){
            $scope.Writer = true;
            
            $http.get('../../queries/filter/getFilterWriter.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
            

          }else if($scope.userJob=="Editor"){
            $scope.Editor = true;
            
            $http.get('../../queries/filter/getFilterEditor.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="Marketing" 
          || $scope.userJob=="Trackimo Customer Support"
          || $scope.userJob=="SEO Specialist"){
            $scope.Marketing = true;

            if($scope.userJob=="Marketing"){
              $http.get('../../queries/filter/getFilterMarketing.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
                $scope.tracker = response.data.records;
              });
            }else if($scope.userJob=="Trackimo Customer Support"){
              $http.get('../../queries/filter/getFilterCustomer.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
                $scope.tracker = response.data.records;
            });
            }else{
              $http.get('../../queries/filter/getFilterSEO.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
                $scope.tracker = response.data.records;
            });
            }
          }else if($scope.userJob=="Social Media Specialist"){
            $scope.SocialMediaSpecialist = true;
            
            $http.get('../../queries/filter/getFilterSocial.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="Multimedia Specialist"){
            $scope.MultimediaSpecialist = true;

            $http.get('../../queries/filter/getFilterMultimedia.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="Data Processor"){
            $scope.DataProcessor = true;
            
            $http.get('../../queries/filter/getFilterData.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="Wordpress Developer"){
            $scope.WordpressDeveloper = true;

            $http.get('../../queries/filter/getFilterWordpress.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="Content Marketing Assistant"){
            $scope.ContentMarketingAssistant = true;
            
            $http.get('../../queries/filter/getFilterContent.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="OJT Web Development"){
            $scope.OJTWebDevelopment = true;

            $http.get('../../queries/filter/getFilterOJTWeb.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="OJT SEO"){
            $scope.OJTSEO = true;

            $http.get('../../queries/filter/getFilterOJTSEO.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="OJT Developer for Automated Data System"){
            $scope.OJTDeveloperforAutomatedDataSystem = true;

            $http.get('../../queries/filter/getFilterOJTDeveloper.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }else if($scope.userJob=="OJT Researcher"){
            $scope.OJTResearcher = true;

            $http.get('../../queries/filter/getFilterOJTResearcher.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response){
              $scope.tracker = response.data.records;
            });
          }
        }
    });
</script>



