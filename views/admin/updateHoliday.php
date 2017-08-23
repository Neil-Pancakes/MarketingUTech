<?php
	require ("../../functions/php_globals.php");

	if(isset($_GET["id"]) && isset($_GET["date"]) && isset($_GET["holidayType"])){
		$date = date('Y-m-d', strtotime(strtr($_GET['date'], '/', '-')));

		$query = 'UPDATE holidays
			SET `holiday_date` = "'.$date.'", `type` = "'.$_GET["holidayType"].'"
			WHERE `id` =  "'.$_GET["id"].'"
		';
		if($mysqli->query($query)){
			$query = "SELECT * FROM `holidays` ORDER BY holiday_date";
	        $result = $mysqli->query($query);
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
		}else{
			echo "|update-error|";
		}
	}else{
		echo "|error|";
	}
?>