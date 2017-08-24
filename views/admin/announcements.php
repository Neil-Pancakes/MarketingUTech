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
                    <div class="col-md-12">
                      <label>Send to all: </label>
                      <input id="sendToAll" type="checkbox" name="isBroadcast" onclick="isBroadcastClick()"><br>
                      <select id="multipleUser" class="userSelect" multiple="multiple" name="user[]" style="width: 100%;" data-tags="true" data-placeholder="Select user/s" data-allow-clear="true">
                        <?php 
                          $query = "SELECT `id`, CONCAT(`firstName`, ' ', `lastName`) AS `name` FROM `users`";
                          $result = $mysqli->query($query);
                          if ($result) {
                            while ($row = $result->fetch_array()) {
                              echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                            }
                          }
                        ?>
                      </select><br><br>
                      <label>Title</label><br>
                      <input id="announcementTitle" type="text" name="title" required/><br><br>
                      <label>Message</label><br>
                      <textarea id="announcementMessage" name="message" rows="4" cols="77" required></textarea>
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
                $result3 = $mysqli->query("SELECT * FROM `announcement` WHERE `announcement_id` = '".$row['id']."'");
                if($result2 && $result3){
                  $row2 = $result2->fetch_array();

                  $created = date("F d, Y", strtotime($row2['created']));
                  //For Status field
                  if($row2['status'] == "true"){
                    $status = "Active";
                  } else {
                    $status = "Inactive";
                  }

                  $recipient = array();
                  $recipient_id = array();
                  //For Recipient Field
                  if ($row2['isBroadcast'] == "true"){
                    array_push($recipient, "Broadcast");
                    //$recipient = "Broadcast";
                  } else {
                    while($row3 = $result3->fetch_array()) {
                      $userResult = $mysqli->query("SELECT id, CONCAT(firstName, ' ', lastName) AS `name` FROM `users` WHERE id = '".$row3['user_id']."'");
                      if ($userResult) {
                        $userRow = $userResult->fetch_array();
                        array_push($recipient, $userRow['name']);
                        array_push($recipient, ", ");
                        array_push($recipient_id, $userRow['id']);
                        //$recipient = $userRow['name'];
                      }
                    }
                    array_pop($recipient);
                  }

                  echo '<tr id='.$row['id'].'>
                    <td>'.$row['title'].'</td>
                    <td>'.$created.'</td>
                    <td>
                    ';
                      foreach($recipient as $user){
                        echo $user;
                      }
                    echo '
                    </td>
                    <td>'.$row['message'].'</td>
                    <td>'.$status.'</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal'.$row['id'].'">Edit</button></td>
                    <!-- Modal -->
                    <div id="modal'.$row['id'].'" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Announcement</h4>
                          </div>
                          <form>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <label>Send to all: </label>';
                                  $function = "modalIsBroadcast('multipleUser".$row['id']."')";
                                  if($row2['isBroadcast'] == 'true'){
                                    echo '
                                    <input id="sendToAll" type="checkbox" name="isBroadcast" onclick="'.$function.'" checked><br>
                                    <select id="multipleUser'.$row['id'].'" class="userSelect" multiple="multiple" name="user[]" style="width: 100%;" data-tags="true" data-placeholder="Select user/s" data-allow-clear="true" disabled>
                                    ';
                                  }else{
                                    echo '
                                    <input id="sendToAll" type="checkbox" name="isBroadcast" onclick="'.$function.'"><br>
                                    <select id="multipleUser'.$row['id'].'" class="userSelect" multiple="multiple" name="user[]" style="width: 100%;" data-tags="true" data-placeholder="Select user/s" data-allow-clear="true">
                                    ';
                                  }
                                    $query4 = "SELECT `id`, CONCAT(`firstName`, ' ', `lastName`) AS `name` FROM `users`";
                                    $result4 = $mysqli->query($query4);
                                    if ($result4) {
                                      while ($row4 = $result4->fetch_array()) {
                                        if(in_array($row4['id'], $recipient_id)) {
                                          echo '<option value="'.$row4['id'].'" selected>'.$row4['name'].'</option>';
                                        }else{
                                          echo '<option value="'.$row4['id'].'">'.$row4['name'].'</option>';
                                        }
                                      }
                                    }
                                  echo '
                                  </select><br><br>
                                  <label>Title</label><br>
                                  <input id="announcementTitle" type="text" name="title" value="'.$row['title'].'" required/><br><br>
                                  <label>Message</label><br>
                                  <textarea id="announcementMessage" name="message" rows="4" cols="77" required>'.$row['message'].'</textarea>
                                </div>
                              </div>
                            </div>
                          </form>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Edit</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    ';
                  echo '</tr>';
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

  function isBroadcastClick(){
    var select = document.getElementById("multipleUser");
    select.disabled = !select.disabled;
  }

  function modalIsBroadcast(id){
    var select = document.getElementById(id);
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
                  $(".userSelect").select2();
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