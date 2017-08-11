<?php
  require ("php_globals.php");
  include ("dashboard.php");
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee List
        <small>UniversalTech</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <table id="empList" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Job Title</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Mobile Number</th>
                <th>Work Status</th>
                <th class="no-sort">View/Edit/Delete</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Job Title</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Mobile Number</th>
                <th>Work Status</th>
                <th>View/Edit/Delete</th>
            </tr>
        </tfoot>
        <tbody id="empList-tbody">
          <?php
            $qry = 'SELECT * FROM users';
            $result = mysqli_query($mysqli, $qry);

            if($result) {
              while($row = mysqli_fetch_assoc($result)){
                if($row["birthday"] == NULL){
                  $birthday = '';
                }else{
                  $birthday = date_format(date_create($row["birthday"]), "F d, Y");
                }
                echo '
                  <tr>
                    <td><a href="adminViewTimetable.php?id='.$row["id"].'">'.$row["firstName"].' '.$row["lastName"].'</a></td>
                    <td>'.$row["jobTitle"].'</td>
                    <td>'.$row["email"].'</td>
                    <td>'.$birthday.'</td>
                    <td>'.$row["mobileNumber"].'</td>
                    <td>'.$row["workStatus"].'</td>
                    <td>
                      <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#view'.$row["id"].'" onclick="viewCheckOJT('.$row["id"].')"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
                      <!-- Modal -->
                      <div id="view'.$row["id"].'" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                          <!-- View Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><strong>View</strong></h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-3">
                                  <h4>Basic Info</h4>
                                  <label>First Name</label><br>
                                  <div>'.$row["firstName"].'</div><br><br>
                                  <label>Last Name</label><br>
                                  <div>'.$row["lastName"].'</div><br><br>
                                  <label>Email</label><br>
                                  <div>'.$row["email"].'</div><br><br>
                                  <label>Job Title</label><br>
                                  <div>'.$row["jobTitle"].'</div><br><br>
                                  <label>Work Status</label><br>
                                  <div id="view_workStatus'.$row["id"].'">'.$row["workStatus"].'</div><br><br>
                                </div>
                                <div id="view_dateOfHire'.$row["id"].'" class="col-md-3">
                                  <h4>Date of Hire</h4>
                                  <label>Trainee</label><br>
                                  <div>'.$row["dateHiredTrainee"].'</div><br><br>
                                  <label>Probationary</label><br>
                                  <div>'.$row["dateHiredProbationary"].'</div><br><br>
                                  <label>Regular</label><br>
                                  <div>'.$row["dateHiredRegular"].'</div><br><br>
                                </div>

                                <div id="view_compensation'.$row["id"].'" class="col-md-3">
                                    <h4>Current Compensation</h4>
                                    <label>Basic Pay</label><br>
                                    <div>'.$row["basicPay"].'</div><br><br>
                                    <label>Allowance</label><br>
                                    <div>'.$row["allowance"].'</div><br><br>
                                    <label>Transportation</label><br>
                                    <div>'.$row["transportation"].'</div><br><br>
                                    <label>Meal</label><br>
                                    <div>'.$row["meal"].'</div><br><br>
                                  </div>
                                  <div class="col-md-3">
                                    <h4>Contact Number</h4>
                                    <label>Mobile Number</label>
                                    <div>'.$row["mobileNumber"].'</div><br><br>
                                    <label>Telephone Number</label>
                                    <div>'.$row["telephoneNumber"].'</div><br><br>
                                    <h4>Other Info</h4>
                                    <label>Address</label>
                                    <div>'.$row["address"].'</div><br><br>
                                    <label>Birthday</label>
                                    <div>'.$birthday.'</div>
                                  </div>

                                <!-- if type is OJT else hide -->
                                <div id="view_ojt_info'.$row["id"].'" class="col-md-3">
                                  <label>Total hours</label><br>
                                  <div>'.$row["OJT_hoursTotal"].'</div><br><br>
                                  <label>Hours Remaining</label><br>
                                  <div>'.$row["OJT_hoursRemaining"].'</div><br><br>
                                  <label>Allowance Daily</label><br>
                                  <div>'.$row["OJT_allowanceDaily"].'</div><br><br>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                      <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#update'.$row["id"].'" onclick="updateCheckOJT('.$row["id"].')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                      <!-- Modal -->
                      <div id="update'.$row["id"].'" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                          <!-- Update Modal content-->
                          <form id="update-form" action="updateEmployee.php" method="GET">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><strong>Edit</strong></h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-3">
                                    <h4>Basic Info</h4>
                                    <input type="text" name="id" value="'.$row["id"].'" hidden />
                                    <label for="firstName">First Name</label><br>
                                    <input type="text" name="firstName" value="'.$row["firstName"].'" onkeypress="return isLetter(event)" required/><br><br>
                                    <label for="lastName">Last Name</label><br>
                                    <input type="text" name="lastName" value="'.$row["lastName"].'" onkeypress="return isLetter(event)" required/><br><br>
                                    <label for="email">Email</label><br>
                                    <input type="email" name="email" value="'.$row["email"].'" required/><br><br>
                                    <label for="jobTitle">Job Title</label><br>
                                    <input type="text" name="jobTitle" value="'.$row["jobTitle"].'" onkeypress="return isLetter(event)" required/><br><br>
                                    <label for="workStatus">Work status</label><br>
                                    <select id="update_workStatus'.$row["id"].'" name="workStatus" onchange="updateCheckOJT('.$row["id"].')" required>
                                    '; 
                                      if($row["workStatus"] == "OJT") {
                                        echo '
                                          <option value="OJT" selected>OJT</option>
                                          <option value="Trainee">Trainee</option>
                                          <option value="Probationary">Probationary</option>
                                          <option value="Regular">Regular</option>
                                        ';
                                      }else if($row["workStatus"] == "Trainee"){
                                        echo '
                                          <option value="OJT">OJT</option>
                                          <option value="Trainee" selected>Trainee</option>
                                          <option value="Probationary">Probationary</option>
                                          <option value="Regular">Regular</option>
                                        ';
                                      }else if($row["workStatus"] == "Probationary"){
                                        echo '
                                          <option value="OJT" selected>OJT</option>
                                          <option value="Trainee">Trainee</option>
                                          <option value="Probationary" selected>Probationary</option>
                                          <option value="Regular">Regular</option>
                                        ';
                                      }else if($row["workStatus"] == "Regular"){
                                        echo '
                                          <option value="OJT" selected>OJT</option>
                                          <option value="Trainee">Trainee</option>
                                          <option value="Probationary">Probationary</option>
                                          <option value="Regular" selected>Regular</option>
                                        ';
                                      }else{
                                        echo '
                                          <option value="" disabled selected>Select employee status</option>
                                          <option value="OJT">OJT</option>
                                          <option value="Trainee">Trainee</option>
                                          <option value="Probationary">Probationary</option>
                                          <option value="Regular">Regular</option>
                                        ';
                                      }
                                      echo '</select><br><br>';
                                  echo'
                                  </div>
                                  <div id="dateOfHire'.$row["id"].'" class="col-md-3">
                                    <h4>Date of Hire</h4>
                                    <label for="">Trainee</label><br>
                                    <input type="date" name="dateHiredTrainee" value="'.$row["dateHiredTrainee"].'" /><br><br>
                                    <label for="dateHiredProbationary">Probationary</label><br>
                                    <input type="date" name="dateHiredProbationary" value="'.$row["dateHiredProbationary"].'" /><br><br>
                                    <label for="dateHiredRegular">Regular</label><br>
                                    <input type="date" name="dateHiredRegular" value="'.$row["dateHiredRegular"].'" /><br><br>
                                  </div>
                                  <div id="compensation'.$row["id"].'" class="col-md-3">
                                    <h4>Current Compensation</h4>
                                    <label for="basicPay">Basic Pay</label><br>
                                    <input type="number" name="basicPay" value="'.$row["basicPay"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="allowance">Allowance</label><br>
                                    <input type="number" name="allowance" value="'.$row["allowance"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="transportation">Transportation</label><br>
                                    <input type="number" name="transportation" value="'.$row["transportation"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="meal">Meal</label><br>
                                    <input type="number" name="meal" value="'.$row["meal"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                  </div>
                                  <div class="col-md-3">
                                    <h4>Contact Number</h4>
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input type="text" name="mobileNumber" value="'.$row["mobileNumber"].'" onkeypress="return isNumber(event)" /><br><br>
                                    <label for="telephoneNumber">Telephone Number</label>
                                    <input type="text" name="telephoneNumber" value="'.$row["telephoneNumber"].'" onkeypress="return isNumber(event)" /><br><br>
                                    <h4>Other Info</h4>
                                    <label for="address">Address</label>
                                    <input type="text" name="address" value="'.$row["address"].'" /><br><br>
                                    <label for="birthday">Birthday</label>
                                    <input type="date" name="birthday" value="'.$row["birthday"].'" required /><br><br>
                                  </div>
                              
                                  <!-- if type is OJT else hide -->
                                  <div id="update_ojt_info'.$row['id'].'" class="col-md-3">
                                    <h4>OJT Info</h4>
                                    <label for="OJT_hoursTotal">Total hours</label><br>
                                    <input type="number" name="OJT_hoursTotal" value="'.$row["OJT_hoursTotal"].'" step="0.1" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="OJT_hoursRemaining">Hours Remaining</label><br>
                                    <input type="number" name="OJT_hoursRemaining" value="'.$row["OJT_hoursRemaining"].'" step="0.1" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="OJT_allowanceDaily">Allowance daily</label><br>
                                    <input type="number" name="OJT_allowanceDaily" value="'.$row["OJT_allowanceDaily"].'" step="0.01" onkeypress="return isDecimal(event)" required/><br><br>
                                  </div>
                                </div> <!-- end of row --> 
                              </div> <!-- end of modal-body -->
                              <div class="modal-footer">
                                <input type="submit" class="btn btn-success confirmSubmit" value="Update"/>
                              </div>
                            </div> <!-- end of modal-content -->
                          </form>

                        </div>
                      </div>
                      <button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                    </td>
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

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
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
      $('#empList').DataTable({
        "responsive": true,
        "pagingType": "full_numbers",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [],
        "columnDefs": [ {
          "targets"  : 'no-sort',
          "orderable": false,
        }]
      });
  });
</script>
<script>
  function updateCheckOJT(id){
    var workStatus = $('#update_workStatus' + id).val();
    if(workStatus == "OJT"){
      $('#update_ojt_info' + id).show();
      $('#dateOfHire' + id).hide();
      $('#compensation' + id).hide();
      $('#update_ojt_info' + id + '> input:disabled').attr("disabled",false);
      $('#dateOfHire' + id + '> input:hidden').attr("disabled",true);
      $('#compensation' + id + '> input:hidden').attr("disabled",true);
    }else{
      $('#update_ojt_info' + id).hide();
      $('#dateOfHire' + id).show();
      $('#compensation' + id).show();
      $('#update_ojt_info' + id + '> input:hidden').attr("disabled",true);
      $('#dateOfHire' + id + '> input:disabled').attr("disabled",false);
      $('#compensation' + id + '> input:disabled').attr("disabled",false);
    }
  }

  function viewCheckOJT(id){
    var workStatus = $('#view_workStatus' + id).text();
    if(workStatus == "OJT"){
      $('#view_ojt_info' + id).show();
      $('#view_dateOfHire' + id).hide();
      $('#view_compensation' + id).hide();
    }else{
      $('#view_ojt_info' + id).hide();
      $('#view_dateOfHire' + id).show();
      $('#view_compensation' + id).show();
    }
  }

  function isLetter(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (!(charCode >= 65 && charCode <= 90) && !(charCode >= 97 && charCode <= 122) && (charCode != 32 && charCode != 0)){
        return false;
    }
    return true;
  }

  function isNumber(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (!(charCode >= 48 && charCode <= 57)){
        return false;
    }
    return true;
  }

  function isDecimal(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (!(charCode >= 48 && charCode <= 57) && charCode != 46){
        return false;
    }
    return true;
  }
</script>
<script>
  $(document).on('submit', '[id^=update-form]', function (e) {
    e.preventDefault();

    var data = $(this).serialize();

    swal({
      title: "Are you sure?",
      text: "Update employee info",
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
                url: 'updateEmployee.php',
                data: data,
                success: function (data) {
                  swal("Success!", "Employee info has been updated", "success");
                  $('.modal').modal('hide');
                  document.getElementById("empList-tbody").innerHTML=data;
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