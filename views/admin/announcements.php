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
              <form id="createAnnouncement" action="createAnnouncement.php" method="POST">
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
                  <td>'.$row['title'].'</td>
                  <td>'.$row['created'].'</td>
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
  var ctr = 0;
  $(document).ready(function(){
    $("#add_send_to").click(function(e){

      e.preventDefault();
      $(".add_field").append('<div id="'+ctr+'" style="padding-top: 4px"><input id="input_'+ ctr +'" type="text" name="user[]" onkeyup="showResult(this.value, '+ ctr +')" required><ul id="name_list_'+ctr+'" class="dropdown-content"></ul> <button class="remove_field btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button></div>');
      ctr++;
    });

    $(".add_field").on("click", ".remove_field", function(e){
      e.preventDefault();
      $(this).parent('div').remove();
    });
  });
</script>
<script>
  // autocomplet : this function will be executed every time we change the text
  function showResult(e, id) {
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = e;
    if (keyword.length >= min_length) {
      $.ajax({
        url: 'searchName.php',
        type: 'POST',
        data: {keyword:keyword, id:id},
        success:function(data){
          $('#name_list_'+id).show();
          $('#name_list_'+id).html(data);
        }
      });
    } else {
      $('#name_list_'+id).hide();
    }
  }

  // set_item : this function will be executed when we select an item
  function set_item(item, id, db_user_id) {
    // change input value
    $('#input_' + id).val(item);
    $('#' + id).append('<input id="input_user_'+ id +'" name="user_id[]" hidden/>');
    $('#input_user_' + id).val(db_user_id);

    // hide proposition list
    $('#name_list_' + id).hide();
  }
</script>
<script>
  $(document).on('submit', '[id^=createAnnouncement]', function (e) {
    e.preventDefault();

    var data = $(this).serialize();

    swal({
      title: "Are you sure?",
      text: "Create new Announcement",
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
                type: 'POST',
                url: 'createAnnouncement.php',
                data: data,
                success: function (data) {
                  swal("Success!", "Announcement has been added", "success");
                  $('.modal').modal('hide');
                  document.getElementById("announcement-tbody").innerHTML = data;
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