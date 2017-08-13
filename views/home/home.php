<?php
  require ("../dashboard/dashboard.php");
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

    <div class="col-lg-6">
        <div id="alertMsg">
          <?php
            if (isset($_GET['succ'])){
                echo '<div class="alert alert-success" role="alert">'.$_SESSION['alertMsg'].'</div>';
            }
            if (isset($_GET['err'])){
                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['alertMsg'].'</div>';
            }
          ?>
        </div>
        <p class="timestamp" id="time"></p>
        <p class="timestamp" id="date"></p>
        <div id="time-btns">
          <?php
            $query = "SELECT `timeIn`, `timeOut`, `lunchIn`, `lunchOut`
                  FROM `timetable`
                  WHERE DATE(`date`) = DATE(CURRENT_TIMESTAMP) AND user_id = ".$_SESSION["user_id"];
            $result = mysqli_query($mysqli, $query);
            if ($result->num_rows == 1){
              $row = mysqli_fetch_assoc($result);
              if ($row['timeIn'] == 0) {
                echo '<div class="col-md-12 text-center">';
                echo '<button type="button" class="btn btn-success timeBtn" id="btnTimeIn">Time In</button>';
                echo '</div>';
              } else if ($row['timeIn'] != 0 && $row['timeOut'] == 0 && $row['lunchIn'] == 0 && $row['lunchOut'] == 0) {
                echo '<div class="col-md-6 text-center">';
                echo '<button type="button" class="btn btn-danger timeBtn" id="btnTimeOut">Time Out</button>';
                echo '</div>';
                echo '<div class="col-md-6 text-center">';
                echo '<button type="button" class="btn btn-warning timeBtn" id="btnLunchIn">Lunch Time In</button>';
                echo '</div>';
              } else if ($row['timeIn'] != 0 && $row['timeOut'] == 0 && $row['lunchIn'] != 0 && $row['lunchOut'] == 0) {
                echo '<div class="col-md-6 text-center">';
                echo '<button type="button" class="btn btn-danger timeBtn" id="btnTimeOut">Time Out</button>';
                echo '</div>';
                echo '<div class="col-md-6 text-center">';
                echo '<button type="button" class="btn btn-warning timeBtn" id="btnLunchOut">Lunch Time Out</button>';
                echo '</div>';
              } else if ($row['timeIn'] != 0 && $row['timeOut'] == 0 && $row['lunchIn'] != 0 && $row['lunchOut'] != 0) {
                echo '<div class="col-md-12 text-center">';
                echo '<button type="button" class="btn btn-danger timeBtn" id="btnTimeOut">Time Out</button>';
                echo '</div>';
              } else if ($row['timeIn'] != 0 && $row['timeOut'] != 0) {
                echo '<div class="col-md-12 text-center">';
                echo '<button type="button" class="btn btn-success timeBtn disabled">Time In</button>';
                echo '</div>';
              }
            } else {
              header("location:../../functions/timeInOut.php?newDays");
              exit();
            }
          ?>
        </div>
      </div>

      <div class="container">
        <div class="col-md-6 div-table">
          <h2>Time History Today</h2>
          <table class="table table-condensed">
            <tbody id="timeToday-tbody">
              <?php
                $query = "SELECT `timeIn`, `timeOut`, `lunchIn`, `lunchOut`, `date`
                      FROM `timetable`
                      WHERE DATE(`date`) = DATE(CURRENT_TIMESTAMP) AND user_id = ".$_SESSION["user_id"];
                $result = mysqli_query($mysqli, $query);
                if ($result->num_rows == 1){
                  $row = mysqli_fetch_assoc($result);
                  if($row['timeOut'] != 0){
                    echo '<tr>';
                    echo '<td>Timed Out: </td>';
                    echo '<td>'.$row['timeOut'].'</td>';
                    echo '</tr>';
                  }
                  if($row['lunchOut'] != 0){
                    echo '<tr>';
                    echo '<td>Lunch Out: </td>';
                    echo '<td>'.$row['lunchOut'].'</td>';
                    echo '</tr>';
                  }
                  if($row['lunchIn'] != 0){
                    echo '<tr>';
                    echo '<td>Lunch In: </td>';
                    echo '<td>'.$row['lunchIn'].'</td>';
                    echo '</tr>';
                  }
                  if($row['timeIn'] != 0){
                    echo '<tr>';
                    echo '<td>Time In: </td>';
                    echo '<td>'.$row['timeIn'].'</td>';
                    echo '</tr>';
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    //include ("../dashboard/footer.php");
  ?>

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
        url: "../../functions/timestamp.php?time",
        success: function(data) {
            $('#time').html(data);
        },
    });    

    $.ajax({
        url: "../../functions/timestamp.php?date",
        success: function(data) {
            $('#date').html(data);
        },
    });
}
</script>
<script type="text/javascript">
  $(document).on('click', '#btnTimeIn', function(event){
    ajax("../../functions/timeInOut.php?timeIn", "Time in?", "", "Time IN Successful!", "Time in");
  });

  $(document).on('click', '#btnTimeOut', function(event){
    ajax("../../functions/timeInOut.php?timeOut", "Time Out?", "", "Time OUT Successful!", "Time out");
  });

  $(document).on('click', '#btnLunchIn', function(event){
    ajax("../../functions/timeInOut.php?lunchIn", "Lunch in?", "", "Lunch IN Successful!", "Lunch in");
  });

  $(document).on('click', '#btnLunchOut', function(event){
    ajax("../../functions/timeInOut.php?lunchOut",  "Lunch out?", "", "Lunch OUT Successful!", "Lunch out");
  });

  function ajax(phpUrl, titleText, textText, successText, confirmBtnText){
      // Variable to hold request
      var request;

      // Prevent default posting of form - put here to work in case of errors
      event.preventDefault();

      // Abort any pending request
      if (request) {
          request.abort();
      }

      // setup some local variables
      var $btn = $(this);

      // Let's disable the button for the duration of the Ajax request.
      // Note: we disable elements AFTER the form data has been serialized.
      // Disabled form elements will not be serialized.
      $btn.prop("disabled", true);

      swal({
        title: titleText,
        text: textText,
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: confirmBtnText,
        cancelButtonText: "Cancel",
        cancelButtonClass: "btn-danger",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
      },
      function (isConfirm) {
          if (isConfirm) {
            setTimeout(function(){
              request = $.ajax({
                url: phpUrl,
                type: "GET"
              });

              // Callback handler that will be called on success
              request.done(function (response, textStatus, jqXHR){
                  var parts = response.split('|');
                  if(parts[1] == "fail"){
                    swal("Error!", "An error has occurred", "error");
                  }else{
                    swal(successText, "", "success");
                    //document.getElementById("alertMsg").innerHTML=parts[0];
                    document.getElementById("time-btns").innerHTML=parts[0];
                    document.getElementById("timeToday-tbody").innerHTML=parts[1];
                  }       
              });

              // Callback handler that will be called on failure
              request.fail(function (jqXHR, textStatus, errorThrown){
                  swal("Error!", "An error has occurred", "error");
                  // Log the error to the console
                  console.error(
                      "The following error occurred: "+
                      textStatus, errorThrown
                  );
              });

              // Callback handler that will be called regardless
              // if the request failed or succeeded
              request.always(function () {
                  // Reenable the inputs
                  $btn.prop("disabled", false);
              });
            }, 500);
          }
      });
  }
</script>