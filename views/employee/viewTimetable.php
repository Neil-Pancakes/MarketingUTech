<?php
  ob_start();
  require ("../../functions/php_globals.php");
  require ("../dashboard/dashboard.php");

  if(!isset($_SESSION['user_id'])){
    header("location: index.php");
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Timetable
        <small>UniversalTech</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <h4>Filter Date</h4>
      <form id="filterDate" action="filterDate.php" method="GET">
        <div class="since-until-datepicker">
            <div class='col-md-2' style="padding-left: 0px">
                <div class="form-group">
                    <div class='input-group date' id='since-datetimepicker'>
                        <input id="since" type='text' name="since" class="form-control" placeholder="Start date" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class='col-md-2' style="padding-left: 0px">
                <div class="form-group">
                    <div class='input-group date' id='until-datetimepicker'>
                        <input id="until" type='text' name="until" class="form-control" placeholder="End date" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div> 
            <div class='col-md-2' style="padding-left: 0px">
                <div class="form-group">
                    
                    <div class='input-group date' id='until-datetimepicker'>
                        <button type="submit" class="form-control btn btn-success">
                          <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </div> 
        </div>
      </form>
      <table id="timetable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Lunch Time In</th>
                <th>Lunch Time Out</th>
                <th>Rendered Time</th>
                <th>Rendered Lunch</th>
                <th>Late / Undertime</th>
                <th>Overtime</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Lunch Time In</th>
                <th>Lunch Time Out</th>
                <th>Rendered Time</th>
                <th>Rendered Lunch</th>
                <th>Late / Undertime</th>
                <th>Overtime</th>
            </tr>
        </tfoot>
        <tbody id="timetable-tbody">
          <?php
            $month = date('F');
            $date = date('d'); 
            $year = date('Y');
            $until = date('Y-m-d');

            if($date <= 15){
              $since = date('Y-m-d', strtotime($year."-".$month."-01"));
              $qry = 'SELECT * FROM timetable WHERE user_id = '.$_SESSION['user_id'].' AND timeIn != 0 AND date BETWEEN "'.$since.'" AND "'.$until.'"';
            }else{
              $since = date('Y-m-d', strtotime($year."-".$month."-16"));
              $qry = 'SELECT * FROM timetable WHERE user_id = '.$_SESSION['user_id'].' AND timeIn != 0 AND date BETWEEN "'.$since.'" AND "'.$until.'"';
            }

            $result = mysqli_query($mysqli, $qry);

            if($result){
              while($row = mysqli_fetch_assoc($result)){
                $date = date_format(date_create($row["date"]), "F d, Y");
                $timeIn = date("h:i A", strtotime($row["timeIn"]));
                if($row["timeOut"] == 0){
                  $timeOut = "-";
                  $renderedTime = "-";
                  $underTime = "-";
                }else{
                  $timeOut = date("h:i A", strtotime($row["timeOut"]));
                  $datetime1 = date("H:i", strtotime($row["timeIn"]));
                  $datetime1 = strtotime($datetime1);
                  $datetime2 = date("H:i", strtotime($row["timeOut"]));
                  $datetime2 = strtotime($datetime2);
                  $renderedTime = abs(number_format(round(($datetime2 - $datetime1)/3600,1),1));
                  $underTime = number_format(8.0 - $renderedTime, 1);
                  if($underTime < 0){
                    $overTime = abs($underTime);
                    $underTime = 0;
                  }else{
                    $overTime = 0;
                  }

                  if($renderedTime > 8 && $row['overtimeStatus'] != 'true'){
                    $renderedTime = 8;
                  }
                }

                if($row["lunchIn"] == 0){
                  $lunchIn = "-";
                  $renderedLunch = "-";
                  $overTime = "-";
                }else{
                  $lunchIn = date("h:i A", strtotime($row["lunchIn"]));
                }

                if($row["lunchOut"] == 0){
                  $lunchOut = "-";
                  $renderedLunch = "-";
                  $overTime = "-";
                }else{
                  $lunchOut = date("h:i A", strtotime($row["lunchOut"]));
                  $datetime3 = date("H:i", strtotime($row["lunchIn"]));
                  $datetime3 = strtotime($datetime3);
                  $datetime4 = date("H:i", strtotime($row["lunchOut"]));
                  $datetime4 = strtotime($datetime4);
                  $renderedLunch = number_format(round(($datetime4 - $datetime3)/3600,1),1);
                  $datetime1 = date("H:i", strtotime($row["timeIn"]));
                  $datetime1 = strtotime($datetime1);
                  $datetime2 = date("H:i", strtotime($row["timeOut"]));
                  $datetime2 = strtotime($datetime2);
                  if($row["timeOut"] > 0){
                    $renderedTime = abs(number_format(round((($datetime2 - $datetime1)/3600) - $renderedLunch, 1),1));
                    $underTime = number_format(8.0 - $renderedTime, 1);
                    if($underTime < 0){
                      $overTime = abs($underTime);
                      $underTime = 0;
                    }else{
                      $overTime = 0;
                    }

                    if($renderedTime > 8 && $row['overtimeStatus'] != 'true'){
                      $renderedTime = 8;
                    }
                  }       
                }
                echo '
                  <tr>
                      <td>'.$date.'</td>
                      <td>'.$timeIn.'</td>
                      <td>'.$timeOut.'</td>
                      <td>'.$lunchIn.'</td>
                      <td>'.$lunchOut.'</td>
                      <td>'.$renderedTime.'</td>
                      <td>'.$renderedLunch.'</td>
                      <td>'.$underTime.'</td>
                      <td>'.$overTime.'</td>
                  </tr>
                ';
              }
            }
          ?>
        </tbody>
      </table>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include ("dashboard/footer.php");
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
      $('#timetable').DataTable({
        "responsive": true,
        "pagingType": "full_numbers",
        "lengthMenu": [[-1, 15, 16, 30, 31], ["All", 15, 16, 30 ,31]],
        "order": [],
        "columnDefs": [ {
          "targets"  : 'no-sort',
          "orderable": false,
        }]
      });
  });
</script>
<script type="text/javascript">
    $(function () {
        $('#since-datetimepicker').datetimepicker({
          format: 'DD/MM/YYYY',
        });
        $('#until-datetimepicker').datetimepicker({
          useCurrent: false, //Important! See issue #1075
          format: 'DD/MM/YYYY'
        });
        $("#since-datetimepicker").on("dp.change", function (e) {
            $('#until-datetimepicker').data("DateTimePicker").minDate(e.date);
        });
        $("#until-datetimepicker").on("dp.change", function (e) {
            $('#since-datetimepicker').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script type="text/javascript">
  // Variable to hold request
  var request;

  // Bind to the submit event of our form
  $("#filterDate").submit(function(event){

      // Prevent default posting of form - put here to work in case of errors
      event.preventDefault();

      var since = $("#since").val(); 
      var until = $("#until").val();

      // Abort any pending request
      if (request) {
          request.abort();
      }

      if(since && until){
        // setup some local variables
        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        var serializedData = $form.serialize();

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        // Fire off the request to /form.php
        request = $.ajax({
            url: "filterDate.php",
            type: "GET",
            data: serializedData
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            console.log("Hooray, it worked!");
            document.getElementById("timetable-tbody").innerHTML=response;
        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
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
            $inputs.prop("disabled", false);
        });
      }
  });
</script>