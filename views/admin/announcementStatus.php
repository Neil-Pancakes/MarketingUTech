<?php
	require '../../functions/php_globals.php';

	if(isset($_POST['status']) && isset($_POST['id'])){
		$status = $_POST['status'];
		$id = $_POST['id'];
		$query = 'UPDATE `announcement_content`
			SET `status` = "'.$status.'"
			WHERE `id` = "'.$id.'"
		';

		if(mysqli_query($mysqli, $query)){
			$function_true = "ajax('status".$id."', 'true', '".$id."', 'Activate')";
            $function_false = "ajax('status".$id."', 'false', '".$id."', 'Deactivate')";

			if($status == 'true'){
				echo '<button id="btnFalse'.$id.'" type="button" class="btn btn btn-danger" onclick="'.$function_false.'">Deactivate</button>|';
			}else{
				echo '<button id="btnTrue'.$id.'" type="button" class="btn btn btn-success" onclick="'.$function_true.'">Activate</button>|';
			}

			$result = $mysqli->query("SELECT * FROM `announcement_content` WHERE `id` = '".$id."'");
            if ($result) {
              while($row = $result->fetch_array()) {
                $result2 = $mysqli->query("SELECT * FROM `announcement` WHERE `announcement_id` = '".$row['id']."'");
                $result3 = $mysqli->query("SELECT * FROM `announcement` WHERE `announcement_id` = '".$row['id']."'");
                if($result2 && $result3){
                  $row2 = $result2->fetch_array();

                  $created = date("F d, Y", strtotime($row2['created']));
                  //For Status field
                  if($row['status'] == "true"){
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
                    <td>
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal'.$row['id'].'">Edit</button> ';
                      $function_true = "ajax('status".$row['id']."', 'true', '".$row['id']."', 'Activate')";
                      $function_false = "ajax('status".$row['id']."', 'false', '".$row['id']."', 'Deactivate')";
                      echo '<span id="status'.$row["id"].'">';
                      if($status == 'Active'){
                        echo '<button id="btnFalse'.$row["id"].'" type="button" class="btn btn btn-danger" onclick="'.$function_false.'">Deactivate</button>';
                      }else{
                        echo '<button id="btnTrue'.$row["id"].'" type="button" class="btn btn btn-success" onclick="'.$function_true.'">Activate</button>';
                      }
                      echo '</span>';
                    echo '
                    </td>
                    <!-- Modal -->
                    <div id="modal'.$row['id'].'" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Announcement</h4>
                          </div>
                          <form id="modal-edit-form" action="updateAnnouncement.php" method="POST">
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <input type="text" name="announcementContent_id" value="'.$row['id'].'" required hidden/>
                                  <label>Send to all: </label>';
                                  $function = "modalIsBroadcast('multipleUser".$row['id']."')";
                                  if($row2['isBroadcast'] == 'true'){
                                    echo '
                                    <input id="sendToAll" type="checkbox" name="isBroadcast" onclick="'.$function.'" checked><br>
                                    <select id="multipleUser'.$row['id'].'" class="userSelect" multiple="multiple" name="user[]" style="width: 100%;" data-tags="true" data-placeholder="Select user/s" data-allow-clear="true" disabled required>
                                    ';
                                  }else{
                                    echo '
                                    <input id="sendToAll" type="checkbox" name="isBroadcast" onclick="'.$function.'"><br>
                                    <select id="multipleUser'.$row['id'].'" class="userSelect" multiple="multiple" name="user[]" style="width: 100%;" data-tags="true" data-placeholder="Select user/s" data-allow-clear="true" required>
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
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-warning">Edit</button>
                            </div>
                          </form>
                        </div>

                      </div>
                    </div>
                    ';
                  echo '</tr>';
                }
              }
            }
		}else{
			echo '|error|';
		}
	}
?>