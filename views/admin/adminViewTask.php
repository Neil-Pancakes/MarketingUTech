<?php
  require ("../../functions/php_globals.php");
  require ("../dashboard/dashboard.php");

  if (!isAdmin($_SESSION['user_id'])) {
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

  $_SESSION["filter_id"] = $_GET["id"];
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-app="taskFieldsApp" ng-cloak ng-controller="taskFieldsController as ctrl">
    <?php
                $qry = "SElECT * FROM users WHERE id = ".$_GET['id'];
                $result = mysqli_query($mysqli, $qry);
                $row = mysqli_fetch_assoc($result);

                $_SESSION["jobTitle"] = $row["jobTitle"];
?>
      <input ng-model="userJob" ng-init="userJob = '<?php echo $_SESSION['jobTitle'];?>'" hidden>
      <form ng-submit="search()">
        <div>
          <input type="text" ng-model="userId" ng-init="userId = '<?php echo $_GET['id'];?>'" hidden />
          <md-content layout-padding ng-cloak>
            <div layout-gt-xs="row" data-ng-init="init()">
              <div flex-gt-xs>
                <h4>Filter Date</h4>
                <md-datepicker ng-model="ctrl.startDate" md-placeholder="Start date" required></md-datepicker>
                <md-datepicker ng-model="ctrl.endDate" md-placeholder="End date" required></md-datepicker>
                <md-button class="md-accent md-raised md-hue-2" type="submit">Search</md-button>
                <button style="float:right;" ng-click="export()">Export</button>
              </div>
            </div>
          </md-content>
        </form>
        <div align="center">
          <h2 ng-show="empty" style="text-align:center;">Your task tracker is empty!</h2>
          <div ui-grid="grid1" ui-grid-exporter ui-grid-pagination class="grid"></div>
          <br>
          <div ui-grid="grid2" ui-grid-exporter ui-grid-pagination class="grid" ng-show="show"></div>
        </div>
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
    var app = angular.module('taskFieldsApp', ['ngMaterial','ui.grid', 'ui.grid.pagination', 'ui.grid.exporter']);
    
    app.config(['$qProvider', function ($qProvider) {
      $qProvider.errorOnUnhandledRejections(false);
    }]);
    
    app.controller('taskFieldsController', function($scope, $http, $mdDialog) {
        $scope.init = function () {
          if($scope.userJob=="Writer"){
            $http.get('../../queries/filter/getFilterWriter.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
              $scope.tracker = response.data.records;
              $scope.grid1.data = $scope.tracker;
            });
          }else if($scope.userJob=="Editor"){
            $http.get('../../queries/filter/getFilterEditor.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
              $scope.tracker = response.data.records;
              $scope.grid1.data = $scope.tracker;
            });
          }else if($scope.userJob=="Marketing" 
          || $scope.userJob=="Trackimo Customer Support"
          || $scope.userJob=="SEO Specialist"){
            if($scope.userJob=="Marketing"){
              $http.get('../../queries/filter/getFilterMarketing.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
              });
            }else if($scope.userJob=="Trackimo Customer Support"){
              $http.get('../../queries/filter/getFilterCustomer.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
              });
              
            }else if($scope.userJob=="SEO Specialist"){
              $http.get('../../queries/filter/getFilterSEO.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
              });
            }
          }else if($scope.userJob=="Social Media Specialist"){
            $http.get('../../queries/filter/getFilterSocial.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
            });
            
          }else if($scope.userJob=="Multimedia Specialist"){
            $http.get('../../queries/filter/getFilterMultimedia.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
            });
          }else if($scope.userJob=="Data Processor"){
            $http.get('../../queries/filter/getFilterData.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
            });
          }else if($scope.userJob=="Wordpress Developer"){
            $http.get('../../queries/filter/getFilterWordpress.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
            });
          }else if($scope.userJob=="Content Marketing Assistant"){
            $http.get('../../queries/filter/getFilterContent.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
            });
          }else if($scope.userJob=="OJT Web Development"){
            $http.get('../../queries/filter/getFilterOJTWeb.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
              $scope.tracker = response.data.records;
              $scope.grid1.data = $scope.tracker;
              if($scope.tracker.length<=0){
                $scope.empty = true;
              }
            });
          }else if($scope.userJob=="OJT SEO"){
            $http.get('../../queries/filter/getFilterOJTSEO.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
            });
          }else if($scope.userJob=="OJT Developer for Automated Data System"){
            $http.get('../../queries/filter/getFilterOJTDeveloper.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
            });
          }else if($scope.userJob=="OJT Researcher"){
            $http.get('../../queries/filter/getFilterOJTResearcher.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response){
                $scope.tracker = response.data.records;
                $scope.grid1.data = $scope.tracker;
                if($scope.tracker.length<=0){
                  $scope.empty = true;
                }
            });
          }

          $http.get('../../queries/getAdditionalTasksAdmin.php?userId="'+$scope.userId+'"&startDate="0000-00-00"&endDate="9999-12-31"').then(function (response) {
            $scope.todayAdditional = response.data.records;
            $scope.grid2.data = $scope.todayAdditional;
            if($scope.todayAdditional.length>0){
              $scope.show=true;

              if($scope.tracker.length<=0){
                  $scope.empty = true;
              }
            }
          });
        };
        $scope.show=false;

        $scope.search = function(){
          $scope.show=true;
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
          $http.get('../../queries/getAdditionalTasksAdmin.php?userId="'+$scope.userId+'"&startDate="'+$scope.date1+'"&endDate="'+$scope.date2+'"').then(function (response) {
            $scope.todayAdditional = response.data.records;
          });
          
          $scope.grid1.data = $scope.tracker;
          $scope.grid2.data = $scope.todayAdditional;
        }

        $scope.grid1 = {
          enableGridMenu: true,
          exporterLinkLabel: 'Task Tracker Report',
          exporterPdfDefaultStyle: {fontSize: 9},
          exporterPdfTableStyle: {margin: [30, 30, 30, 30]},
          exporterPdfTableHeaderStyle: {fontSize: 10, bold: true, italics: true, color: 'red'},
          exporterPdfOrientation: 'portrait',
          exporterPdfPageSize: 'LETTER',
          exporterPdfMaxGridWidth: 500,
          onRegisterApi: function(gridApi){ 
            $scope.gridApi1 = gridApi;
          }
        };

        $scope.grid2 = {
          enableGridMenu: true,
          exporterLinkLabel: 'Task Tracker Report',
          exporterPdfDefaultStyle: {fontSize: 9},
          exporterPdfTableStyle: {margin: [30, 30, 30, 30]},
          exporterPdfTableHeaderStyle: {fontSize: 10, bold: true, italics: true, color: 'red'},
          exporterPdfOrientation: 'portrait',
          exporterPdfPageSize: 'LETTER',
          exporterPdfMaxGridWidth: 500,
          onRegisterApi: function(gridApi){ 
            $scope.gridApi1 = gridApi;
          }
        };

        $scope.export = function(){ //NOT WORKING//
          $scope.gridApi1.exporter.pdfExport( uiGridExporterConstants.ALL, uiGridExporterConstants.ALL );
        };
    });
</script>



