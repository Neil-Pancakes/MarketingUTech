<?php
  require("../../functions/php_globals.php");
  include("../../functions/ifNotLoggedIn.php");
  include("../../functions/generalDBFunctions.php");

  date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Google Sign-in -->
    <meta name="google-signin-client_id" content="746015490934-gl3bvgacv9oq9b3kg1gpj4s2m76pa62j.apps.googleusercontent.com"/>

    <title>EIMS - Universal Tech</title>

    <!-- REQUIRED JS SCRIPTS -->
    <script src="../../includes/js/jquery-3.2.1.min.js"></script>
    <script src="../../node_modules/moment/moment.js"></script>
    <script src="../../includes/js/bootstrap.min.js"></script>
    <script src="../../includes/js/bootstrap-table.js"></script>
    <script src="../../includes/js/bootstrap-modal.js"></script>
    <script src="../../includes/js/bootstrap-modalmanager.js"></script>
    <script src="../../includes/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../../includes/js/AdminLTE_app.min.js"></script>
    <script src="../../includes/js/googleSignout.js"></script>
    <script src="../../includes/sweetalert/sweetalert.min.js"></script>
    <script src="../../includes/js/xmlConverter.js"></script>
    <script src="../../includes/js/select2.full.js"></script>
    <script src="../../includes/js/jquery.dataTables.min.js"></script>
    <script src="../../includes/js/dataTables.responsive.min.js"></script>

    <!-- AngularJS Dependencies - For Tasks -->
    <script src="../../includes/js/angular.min.js"></script>
    <script src="../../includes/js/angular-animate.min.js"></script>
    <script src="../../includes/js/angular-aria.min.js"></script>
    <script src="../../includes/js/angular-messages.min.js"></script>
    <script src="../../includes/js/angular-material.min.js"></script>
    <script src="../../includes/js/ui-grid.js"></script>

    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    
    <!-- Styles.css !-->
    <link rel="stylesheet" href="../../includes/css/styles.css">
    <link rel="stylesheet" href="../../includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../includes/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../includes/css/ionicons.min.css">
    <link rel="stylesheet" href="../../includes/css/AdminLTE/AdminLTE.min.css">
    <link rel="stylesheet" href="../../includes/css/AdminLTE/skins/skin-green.min.css">
    <link rel="stylesheet" href="../../includes/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="../../includes/css/angular-material.min.css">
    <link rel="stylesheet" href="../../includes/css/select2.css">
    <link rel="stylesheet" href="../../includes/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../includes/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../../includes/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../../includes/css/ui-grid.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">

    <link rel="shortcut icon" href="../../includes/img/universaltechlogo2.jpg" />
  
  </head>

  <body class="hold-transition skin-green sidebar-mini">

  <div class="wrapper">

    <header class="main-header">
      <a href="../home/home.php" class="logo">
        <span class="logo-mini"><b>U</b>T</span>
        <span class="logo-lg"><b>Universal</b> Tech</span>
      </a>

      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Notifications Menu -->
            <?php
               echo '<li class="dropdown notifications-menu">
               <!-- Menu toggle button -->
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <i class="fa fa-bell-o"></i>';
              $wasFilled = isTaskTrackerAnswered($_SESSION['user_id']); //generalDBFunctions.php;
              if($wasFilled == false){
                echo '<span class="label label-warning">!!!</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <ul class="menu">
                      <li>
                        <h4><img src="../../includes/img/warning.png" style="max-height=20px; max-width:20px;"> You did not fill in your task tracker yesterday!</h4>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>';
              } else {
                echo '<span class="label label-warning"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <ul class="menu">
                      <li>
                        <h4><img src="../../includes/img/star.png" style="max-height=20px; max-width:20px;"> You have no notifications</h4>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>';
              }
            ?>

            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                <li>
                  <ul class="menu">
                    <li><!-- Task item -->
                      <a href="#">
                        <!-- Task title and progress text -->
                        <h3>
                          Design some buttons
                          <small class="pull-right">20%</small>
                        </h3>
                        <!-- The progress bar -->
                        <div class="progress xs">
                          <!-- Change the css width attribute to simulate progress -->
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- end task item -->
                  </ul>
                </li>

                <li class="footer">
                  <a href="#">View all tasks</a>
                </li>

              </ul>
            </li>

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src=<?php echo '"'.$_SESSION['picture'].'"'?> class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['firstName']." ".$_SESSION['lastName'] ?></span>
              </a>

              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src=<?php echo '"'.$_SESSION['picture'].'"'?> class="img-circle" alt="User Image">

                  <p>
                    <?php echo $_SESSION['firstName']." ".$_SESSION['lastName'] ?>
                    <small><?php echo $_SESSION['email'] ?></small>
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="../user/profile.php" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="#" onclick="signOut()" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    
    <?php
      //loads sidebar from external php
      include ("sidebar.php");
    ?>

    <div class="content-wrapper">
    <?php 
      $numPending = announcementPending($_SESSION['user_id']); //generalDBFunctions.php
      if($numPending > 0) {
        echo '
        <br>
        <div class="col-md-12">
          <div class="alert alert-danger" role="alert">ATTENTION! You have '.$numPending.' unread messages.</div>
        </div>';
      }
    ?>
