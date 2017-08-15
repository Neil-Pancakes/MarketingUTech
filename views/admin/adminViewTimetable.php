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

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php
        $row = mysqli_fetch_assoc($result);
        if(substr($row["lastName"], -1) == "s"){
          $header = $row["firstName"].' '.$row["lastName"].'\' Timetable';
        }else{
          $header = $row["firstName"].' '.$row["lastName"].'\'s Timetable';
        }
        echo '
          <h1>
            '.$header.'
            <small>UniversalTech</small>
          </h1>
        ';
      ?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <h4>Filter Date</h4>
      <form id="filterDate" action="adminFilterDate.php" method="GET">
        <div class="since-until-datepicker">
            <div class='col-md-2' style="padding-left: 0px">
                <div class="form-group">
                    <div class='input-group date' id='since-datetimepicker'>
                        <input id="since" type='text' name="since" class="form-control" placeholder="Start date" required/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class='col-md-2' style="padding-left: 0px">
                <div class="form-group">
                    <div class='input-group date' id='until-datetimepicker'>
                        <input id="until" type='text' name="until" class="form-control" placeholder="End date" required/>
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
      <table id="timetable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                <th>Edit</th>
            </tr>
        </thead>
        <tbody id="timetable-tbody">
          <?php
            $month = date('F');
            $date = date('d'); 
            $year = date('Y');
            $until = date('Y-m-d');

            if($date <= 15){
              $since = date('Y-m-d', strtotime($year."-".$month."-01"));
              $qry = 'SELECT * FROM timetable WHERE user_id = '.$_GET["id"].' AND date BETWEEN "'.$since.'" AND "'.$until.'"';
            }else{
              $since = date('Y-m-d', strtotime($year."-".$month."-16"));
              $qry = 'SELECT * FROM timetable WHERE user_id = '.$_GET["id"].' AND date BETWEEN "'.$since.'" AND "'.$until.'"';
            }

            $result = mysqli_query($mysqli, $qry);

            if($result){
              while($row = mysqli_fetch_assoc($result)){
                $date = date_format(date_create($row["date"]), "F d, Y");
                if($row["timeIn"] == 0){
                  $input_timeIn = $timeIn = "-";
                }else{
                  $timeIn = date("h:i A", strtotime($row["timeIn"]));
                  $input_timeIn = date("H:i", strtotime($row["timeIn"]));
                }
                if($row["timeOut"] == 0){
                  $input_timeOut = $timeOut = "-";
                  $renderedTime = "-";
                  $underTime = "-";
                  $overTime = "-";
                }else{
                  $timeOut = date("h:i A", strtotime($row["timeOut"]));
                  $input_timeOut = date("H:i", strtotime($row["timeOut"]));
                  $datetime1 = date("H:i", strtotime($row["timeIn"]));
                  $datetime1 = strtotime($datetime1);
                  $datetime2 = date("H:i", strtotime($row["timeOut"]));
                  $datetime2 = strtotime($datetime2);
                  $renderedTime = abs(number_format(round(($datetime2 - $datetime1)/3600,2),1));
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
                  $input_lunchIn = $lunchIn = "-";
                  $renderedLunch = "-";
                }else{
                  $lunchIn = date("h:i A", strtotime($row["lunchIn"]));
                  $input_lunchIn = date("H:i", strtotime($row["lunchIn"]));
                }

                if($row["lunchOut"] == 0){
                  $input_lunchOut = $lunchOut = "-";
                  $renderedLunch = "-";
                }else{
                  $lunchOut = date("h:i A", strtotime($row["lunchOut"]));
                  $input_lunchOut = date("H:i", strtotime($row["lunchOut"]));
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
                  <tr id="edit'.$row["id"].'">
                      <td>'.$date.'</td>
                      <td>'.$timeIn.'</td>
                      <td>'.$timeOut.'</td>
                      <td>'.$lunchIn.'</td>
                      <td>'.$lunchOut.'</td>
                      <td>
                        ';
                        if($renderedTime != "-"){
                          echo sprintf("%.1f", $renderedTime);
                        }else{
                          echo $renderedTime;
                        }
                      echo '
                      </td>
                      <td>
                        ';
                        if($renderedLunch != "-"){
                          echo sprintf("%.1f", $renderedLunch);
                        }else{
                          echo $renderedLunch;
                        }
                      echo '
                      </td>
                      <td>
                        ';
                        if($underTime != "-"){
                          echo sprintf("%.1f", $underTime);
                        }else{
                          echo $underTime;
                        }
                      echo '
                      </td>
                      <td>
                        ';
                        if($overTime != "-"){
                          echo sprintf("%.1f", $overTime);
                        }else{
                          echo $overTime;
                        }
                      echo '
                      </td>

                      <td> 
                      <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit'.$row["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                      ';

                      $function_true = "ajax('OTStatus".$row["id"]."', 'overtimeStatus.php?status=true&user_id=".$_GET["id"]."&date_id=".$row["id"]."')";
                      $function_false = "ajax('OTStatus".$row["id"]."', 'overtimeStatus.php?status=false&user_id=".$_GET["id"]."&date_id=".$row["id"]."')";
                      echo '<span id="OTStatus'.$row["id"].'">';
                      if($row["overtimeStatus"] == 'true'){
                        echo '<button id="btnFalse'.$row["id"].'" type="button" class="btn btn-xs btn-danger" onclick="'.$function_false.'"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></button>';
                      }else{
                        echo '<button id="btnTrue'.$row["id"].'" type="button" class="btn btn-xs btn-success" onclick="'.$function_true.'"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></button>';
                      }
                      echo '</span>';

                      echo '
                      </td>
                      <!-- Modal -->
                      <div class="modal fade" id="edit'.$row["id"].'" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                          <!-- Update Modal content-->
                          <form id="edit-form" action="updateEmployeeTimetable.php" method="GET">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><strong>'.$date.'</strong></h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <input type="text" name="user_id" value="'.$_GET["id"].'" hidden />
                                    <input type="text" name="date_id" value="'.$row["id"].'" hidden />
                                    <input type="text" name="date" value="'.$date.'" hidden />
                                    <label for="timeIn">Time In</label><br>
                                    <input type="time" name="timeIn" value="'.$input_timeIn.'" /><br><br>
                                    <label for="timeOut">Time Out</label><br>
                                    <input type="time" name="timeOut" value="'.$input_timeOut.'" /><br><br>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lunchIn">Lunch In</label><br>
                                    <input type="time" name="lunchIn" value="'.$input_lunchIn.'" /><br><br>
                                    <label for="lunchOut">Lucn Out</label><br>
                                    <input type="time" name="lunchOut" value="'.$input_lunchOut.'" /><br><br>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="submit" class="btn btn-warning" value="Edit" />
                              </div>
                            </div>
                          </form>

                        </div>
                      </div>
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

  <!-- Control Sidebar Start-->
  <?php include '../dashboard/control_sidebar.php'; ?>
  
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
          url: "adminFilterDate.php",
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
  });
</script>
<script>
  $(document).on('submit', '[id^=edit-form]', function (e) {
    e.preventDefault(); 

    var data = $(this).serialize();

    swal({
      title: "Are you sure?",
      text: "Edit employee timetable",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Update",
      cancelButtonText: "Cancel",
      cancelButtonClass: "btn-danger",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    },
      function (isConfirm) {
          if (isConfirm) {
            setTimeout(function(){
              $.ajax({
                type: 'GET',
                url: 'updateEmployeeTimetable.php',
                data: data,
                success: function (data) {
                  swal("Success!", "Employee timetable has been updated", "success");
                  $('.modal').modal('hide');
                  document.getElementById("timetable-tbody").innerHTML=data;
                },
                error: function (data) {
                  swal("Error!", "An error has occurred", "error");
                }
              });
            }, 1500);
          }
      });

    return false;
  });
</script>
<script>
  function ajax(btnID, phpUrl){
    swal({
      title: "Are you sure?",
      text: "Change Overtime status",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Update",
      cancelButtonText: "Cancel",
      cancelButtonClass: "btn-danger",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    },
      function (isConfirm) {
          if (isConfirm) {
            setTimeout(function(){
              $.ajax({
                type: 'GET',
                url: phpUrl,
                success: function (data) {
                  swal("Success!", "Employee info has been updated", "success");
                  $('.modal').modal('hide');
                  document.getElementById(btnID).innerHTML=data;
                },
                error: function (data) {
                  swal("Error!", "An error has occurred", "error");
                }
              });
            }, 1500);
          }
      });

    return false;
  }
</script>