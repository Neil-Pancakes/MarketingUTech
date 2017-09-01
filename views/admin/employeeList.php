<?php
  require ("../../functions/php_globals.php");
  include ("../dashboard/dashboard.php");
  include ("adminFunctions.php");

  if (!isAdmin($_SESSION['user_id'])) {
    header("Location:../home/home.php");
  }
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee List
        <small>UniversalTech</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <table id="empList" class="table" cellspacing="0" width="100%">
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
                      <div class="modal fade" id="update'.$row["id"].'" role="dialog">
                        <div class="modal-dialog modal-lg">
                          <!-- Update Modal content-->
                          <form id="update-form" action="updateEmployee.php" method="GET">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title"><strong>Edit</strong></h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-4">
                                    <h4>Basic Info</h4>
                                    <input type="text" name="id" value="'.$row["id"].'" hidden />
                                    <div class="form-group">
                                      <label for="firstName">First Name</label>
                                      <input type="text" class="form-control" name="firstName" value="'.$row["firstName"].'" onkeypress="return isLetter(event)" required/>
                                    </div>
                                    <div class="form-group">
                                      <label for="lastName">Last Name</label>
                                      <input type="text" class="form-control" name="lastName" value="'.$row["lastName"].'" onkeypress="return isLetter(event)" required/>
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="email" class="form-control" name="email" value="'.$row["email"].'" disabled/>
                                      <input type="email" name="email" value="'.$row["email"].'" hidden/>
                                    </div>';

                                    displayJobTitleSelect($row);
                                    displayWorkStatusSelect($row);

                                  echo'
                                  </div>
                                  <div id="dateOfHire'.$row["id"].'" class="form-group col-md-4">
                                    <h4>Date of Hire</h4>
                                    <label for="dateHiredTrainee">Trainee</label><br>
                                    <input type="date" class="form-control" name="dateHiredTrainee" value="'.$row["dateHiredTrainee"].'" /><br><br>
                                    <label for="dateHiredProbationary">Probationary</label><br>
                                    <input type="date" class="form-control" name="dateHiredProbationary" value="'.$row["dateHiredProbationary"].'" /><br><br>
                                    <label for="dateHiredRegular">Regular</label><br>
                                    <input type="date" class="form-control" name="dateHiredRegular" value="'.$row["dateHiredRegular"].'" /><br><br>
                                  </div>
                                  <div id="compensation'.$row["id"].'" class="form-group col-md-4">
                                    <h4>Current Compensation</h4>
                                    <label for="basicPay">Basic Pay</label><br>
                                    <input type="number" class="form-control" name="basicPay" value="'.$row["basicPay"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="allowance">Allowance</label><br>
                                    <input type="number" class="form-control" name="allowance" value="'.$row["allowance"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="transportation">Transportation</label><br>
                                    <input type="number" class="form-control" name="transportation" value="'.$row["transportation"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="meal">Meal</label><br>
                                    <input type="number" class="form-control" name="meal" value="'.$row["meal"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                  </div>
                                  <div class="form-group col-md-4">
                                    <h4>Contact Number</h4>
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobileNumber" value="'.$row["mobileNumber"].'" onkeypress="return isNumber(event)" /><br><br>
                                    <label for="telephoneNumber">Telephone Number</label>
                                    <input type="text" class="form-control" name="telephoneNumber" value="'.$row["telephoneNumber"].'" onkeypress="return isNumber(event)" /><br><br>
                                    <h4>Other Info</h4>
                                    <label for="address">Address</label>
                                    <textarea type="text" class="form-control" name="address">'.$row["address"].'</textarea><br><br>
                                    <label for="birthday">Birthday</label>
                                    <input type="date" class="form-control" name="birthday" value="'.$row["birthday"].'" required /><br><br>
                                  </div>
                              
                                  <!-- if type is OJT else hide -->
                                  <div id="update_ojt_info'.$row['id'].'" class="form-group col-md-4">
                                    <h4>OJT Info</h4>
                                    <label for="OJT_hoursTotal">Total hours</label><br>
                                    <input type="number" class="form-control" name="OJT_hoursTotal" value="'.$row["OJT_hoursTotal"].'" step="0.1" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="OJT_hoursRemaining">Hours Remaining</label><br>
                                    <input type="number" class="form-control" name="OJT_hoursRemaining" value="'.$row["OJT_hoursRemaining"].'" step="0.1" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="OJT_allowanceDaily">Allowance daily</label><br>
                                    <input type="number" class="form-control" name="OJT_allowanceDaily" value="'.$row["OJT_allowanceDaily"].'" step="0.01" onkeypress="return isDecimal(event)" required/><br><br>
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

  <!-- Control Sidebar Start-->
  <?php include '../dashboard/control_sidebar.php'; ?>
  
</div>
<!-- ./wrapper -->
<script>
  document.getElementById("employeeList").setAttribute("class", "active");

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