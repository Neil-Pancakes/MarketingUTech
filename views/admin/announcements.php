<?php
  require ("../../functions/php_globals.php");
  include ("../dashboard/dashboard.php");

  if (!isAdmin($_SESSION['user_id'])) {
    header("Location:../home/home.php");
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Announcement List
        <small>UniversalTech</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <br><br>
        <!-- Trigger the #addModal with a button -->
        <div><button data-toggle="modal" data-target="#addModal" type="button" class="btn btn-success"><strong>Create <strong><span class="glyphicon glyphicon-plus"></span></button></div>
        <!-- Modal -->
        <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <form id="announcement-form" action="createAnnouncement.php" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Create announcement</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Send to all: </label>
                      <input type="checkbox" name="isBroadcast"><br><br>
                      <select class="userSelect" multiple="multiple" name="user[]" style="width: 100%;">
                        <?php 
                          $query = "SELECT `id`, CONCAT(`firstName`, ' ', `lastName`) AS `name` FROM `users`";
                          $result = $mysqli->query($query);
                          if ($result) {
                            while ($row = $result->fetch_array()) {
                              echo '<option value="'.$row['id'].'" required>'.$row['name'].'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Title</label><br>
                      <input type="text" name="title" required/><br><br>
                      <label>Message</label><br>
                      <textarea name="message" rows="4" cols="30" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <br><br>
      <table id="announcementList" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date Created</th>
                <th>Message</th>
                <th class="no-sort">Edit/Delete</th>
            </tr>
        </thead>
        <tbody id="announcement-tbody">
          <?php 
            $query = "SELECT * FROM `announcement`; ";
            $result = $mysqli->query($query);
            if ($result) {
              while($row = $result->fetch_array()) {
                echo '<tr id='.$row['id'].'>
                  <td></td>
                  <td>'.date("F d, Y", strtotime($row['created'])).'</td>
                  <td>'.$row['message'].'</td>
                  <td>Meme</td>';
                echo '</tr>';
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

  $(".userSelect").select2();

  $(document).ready(function(){
      $('#announcementList').DataTable({
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
  $(document).on('submit', '[id^=announcement-form]', function (e) {
    e.preventDefault(); 

    var data = $(this).serialize();

    swal({
      title: "Are you sure?",
      text: "Create announcement",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Create",
      cancelButtonText: "Cancel",
      cancelButtonClass: "btn-danger",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    },
      function (isConfirm) {
          if (isConfirm) {
            setTimeout(function(){
              $.ajax({
                type: 'POST',
                url: 'createAnnouncement.php',
                data: data,
                success: function (data) {
                  swal("Success!", "Announcement has been updated", "success");
                  $('.modal').modal('hide');
                  if(data == "|error|"){
                    swal("Error!", "An error has occurred", "error");
                  }else{
                    document.getElementById("announcement-tbody").innerHTML=data;
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