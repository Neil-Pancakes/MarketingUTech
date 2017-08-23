<?php
  require ("../../functions/php_globals.php");
  include ("../dashboard/dashboard.php");

  if (!isAdmin($_SESSION['user_id'])) {
    header("Location:../home/home.php");
  }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Holiday List
        <small>UniversalTech</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <br><br>
        <!-- Trigger the #addModal with a button -->
        <div><button data-toggle="modal" data-target="#addModal" type="button" class="btn btn-success"><strong>Add Holiday <strong><span class="glyphicon glyphicon-plus"></span></button></div>
        <!-- Modal -->
        <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <form id="holiday-form" action="createHoliday.php" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Holiday</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Date</label><br>
                      <input type="date" name="date" required>
                    </div>
                    <div class="col-md-6">
                      <label>Holiday Type</label><br>
                      <select name="holidayType">
                        <option value="regular">Regular</option>
                        <option value="special">Special</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <br><br>
      <table id="holidayList" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Holiday Type</th>
                <th class="no-sort">Edit/Delete</th>
            </tr>
        </thead>
        <tbody id="holiday-tbody">
            <?php
              $query = "SELECT * FROM holidays ORDER BY holiday_date";
              $result = mysqli_query($mysqli, $query);
              if($result){
                while($row = mysqli_fetch_assoc($result)){
                  echo '
                    <tr>
                      <td>'.date("F d, Y", strtotime($row["holiday_date"])).'</td>
                      <td>'.ucfirst($row["type"]).'</td>
                      <td>
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit'.$row["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                        <!-- Modal -->
                        <div id="edit'.$row["id"].'" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <form id="modal-holiday-form">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Edit holiday ('.date("F d, Y", strtotime($row["holiday_date"])).')</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <input type="text" name="id" value="'.$row["id"].'" hidden required/>
                                      <label>Date</label><br>
                                      <input type="date" name="date" value="'.date("Y-m-d", strtotime($row["holiday_date"])).'" required>
                                    </div>
                                    <div class="col-md-6">
                                      <label>Holiday Type</label><br>
                                      <select name="holidayType">
                                        ';
                                          if($row["type"] == "regular"){
                                            echo '
                                              <option value="regular" selected>Regular</option>
                                              <option value="special">Special</option>
                                            ';
                                          }else{
                                            echo '
                                              <option value="regular">Regular</option>
                                              <option value="special" selected>Special</option>
                                            ';
                                          }
                                        echo '
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                              </form>
                            </div>

                          </div>
                        </div>
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
document.getElementById("holidays").setAttribute("class", "active");

  $(document).ready(function(){
      $('#holidayList').DataTable({
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

  $(document).on('submit', '[id^=holiday-form]', function (e) {
    e.preventDefault(); 

    var data = $(this).serialize();

    swal({
      title: "Are you sure?",
      text: "Add holiday",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Add",
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
                url: 'createHoliday.php',
                data: data,
                success: function (data) {
                  swal("Success!", "Holiday has been added", "success");
                  $('.modal').modal('hide');
                  if(data == "|error|"){
                    swal("Error!", "An error has occurred", "error");
                  }else if(data == "|exists|"){
                    swal("Error!", "Holiday already exists", "error");
                  }else{
                    document.getElementById("holiday-tbody").innerHTML=data;
                  }
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

  $(document).on('submit', '[id^=modal-holiday-form]', function (e) {
    e.preventDefault(); 

    var data = $(this).serialize();

    swal({
      title: "Are you sure?",
      text: "Edit holiday",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Edit",
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
                url: 'updateHoliday.php',
                data: data,
                success: function (data) {
                  swal("Success!", "Holiday has been added", "success");
                  $('.modal').modal('hide');
                  if(data == "|error|"){
                    swal("Error!", "An error has occurred", "error");
                  }else if(data == "|update-error|"){
                    swal("Error!", "Server update error", "error");
                  }else if(data == "|exists|"){
                    swal("Error!", "Holiday already exists", "error");
                  }else{
                    document.getElementById("holiday-tbody").innerHTML=data;
                  }
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