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
        Announcement List
        <small>UniversalTech</small>
      </h1>
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
                      <input id="sendToAll" type="checkbox" name="isBroadcast" onclick="isBroadcastClick()"><br><br>
                      <select id="multipleUser" class="userSelect" multiple="multiple" name="user[]" style="width: 100%;" data-tags="true" data-placeholder="Select user/s" data-allow-clear="true">
                        <?php 
                          $query = "SELECT `id`, CONCAT(`firstName`, ' ', `lastName`) AS `name` FROM `users`";
                          $result = $mysqli->query($query);
                          if ($result) {
                            while ($row = $result->fetch_array()) {
                              echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Title</label><br>
                      <input id="announcementTitle" type="text" name="title" required/><br><br>
                      <label>Message</label><br>
                      <textarea id="announcementMessage" name="message" rows="4" cols="30" required></textarea>
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
                <th>Recipient/s</th>
                <th>Message</th>
                <th>Status</th>
                <th class="no-sort">Edit/Delete</th>
            </tr>
        </thead>
        <tbody id="announcement-tbody">
          <?php 
            $result = $mysqli->query("SELECT * FROM `announcement_content`");
            if ($result) {
              while($row = $result->fetch_array()) {
                $result2 = $mysqli->query("SELECT * FROM `announcement` WHERE `announcement_id` = '".$row['id']."'");
                if($result2){
                  while($row2 = $result2->fetch_array()) {
                    //For Recipient Field
                    if ($row2['isBroadcast'] == "true"){
                      $recipient = "Broadcast";
                    } else {
                      $userResult = $mysqli->query("SELECT CONCAT(firstName, ' ', lastName) AS `name` FROM `users` WHERE id = '".$row2['user_id']."'");
                      if ($userResult) {
                        $userRow = $userResult->fetch_array();
                        $recipient = $userRow['name'];
                      }
                    }
                    //For Status field
                    if($row2['status'] == "true"){
                      $status = "Active";
                    } else {
                      $status = "Inactive";
                    }

                    echo '<tr id='.$row['id'].'>
                      <td>'.$row['title'].'</td>
                      <td>'.date("F d, Y", strtotime($row2['created'])).'</td>
                      <td>'.$recipient.'</td>
                      <td>'.$row['message'].'</td>
                      <td>'.$status.'</td>
                      <td></td>';
                    echo '</tr>';
                  }
                }
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
  document.getElementById("announcements").setAttribute("class", "active");

  $("#multipleUser").select2();
  var select = document.getElementById("multipleUser");

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

  function isBroadcastClick(){
    select.disabled = !select.disabled;
  }

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
                  $('#announcement-form').trigger('reset');
                  $('.modal').modal('hide');
                  $("#multipleUser").select2();
                  select.disabled = false;
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