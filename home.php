<?php
  ob_start();
  require ("dashboard.php");
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Time Keeper
        <small>UniversalTech</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="col-lg-12">
      <?php
        if (isset($_GET['succ'])){
            echo '<div class="alert alert-success" role="alert">'.$_SESSION['alertMsg'].'</div>';
        }
        if (isset($_GET['err'])){
            echo '<div class="alert alert-danger" role="alert">'.$_SESSION['alertMsg'].'</div>';
        }
      ?>
      <p class="timestamp" id="time"></p>
      <p class="timestamp" id="date"></p>
        <div class="col-md-12 text-center">
          <?php
          $query = "SELECT `timeIn`, `timeOut`
                FROM `timetable`
                WHERE DATE(`date`) = DATE(CURRENT_TIMESTAMP)";
          $result = mysqli_query($mysqli, $query);
          if ($result->num_rows == 1){
            $row = mysqli_fetch_assoc($result);
            if ($row['timeIn'] == 0) {
              echo '<button type="button" class="btn btn-success timeBtn" id="btnTimeIn">Time In</button>';
            } else if ($row['timeIn'] != 0 && $row['timeOut'] == 0) {
              echo '<button type="button" class="btn btn-danger timeBtn" id="btnTimeOut">Time Out</button>';
            } else if ($row['timeIn'] != 0 && $row['timeOut'] != 0) {
              echo '<button type="button" class="btn btn-success timeBtn disabled">Time In</button>';
            }
          } else {
            header("location:functions/timeInOut.php?newDays");
            exit();
          }
          ?>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">UniversalTech</a>.</strong> All rights reserved.
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
    setInterval(timestamp, 1000);
});

function timestamp() {
    $.ajax({
        url: "functions/timestamp.php?time",
        success: function(data) {
            $('#time').html(data);
        },
    });    

    $.ajax({
        url: "functions/timestamp.php?date",
        success: function(data) {
            $('#date').html(data);
        },
    });
}

$('#btnTimeIn').click(function (){
  window.location.href = "functions/timeInOut.php?timeIn";
});

$('#btnTimeOut').click(function (){
  window.location.href = "functions/timeInOut.php?timeOut";
});

</script>