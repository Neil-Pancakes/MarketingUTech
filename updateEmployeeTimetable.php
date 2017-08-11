<?php
	require ("php_globals.php");

	if(isset($_GET['user_id']) && isset($_GET['date_id']) && isset($_GET['date'])){
		$user_id = $_GET['user_id'];
		$date_id = $_GET['date_id'];
		$date = date("Y-m-d", strtotime($_GET['date']));

		if($_GET['timeIn'] === ''){
			$timeIn = '0000-00-00 00:00:00';
		}else{
			$timeIn = date("Y-m-d H:i", strtotime($_GET['timeIn']));
		}

		if($_GET['timeOut'] === ''){
			$timeOut = '0000-00-00 00:00:00';
		}else{
			$timeOut = date("Y-m-d H:i", strtotime($_GET['timeOut']));
		}

		if($_GET['lunchIn'] === ''){
			$lunchIn = '0000-00-00 00:00:00';
		}else{
			$lunchIn = date("Y-m-d H:i", strtotime($_GET['lunchIn']));
		}

		if($_GET['lunchOut'] === ''){
			$lunchOut = '0000-00-00 00:00:00';
		}else{
			$lunchOut = date("Y-m-d H:i", strtotime($_GET['lunchOut']));
		}

		//if($_GET['timeOut'] !== ''){
			$query = 'SELECT * FROM timetable WHERE date="'.$date.'" AND user_id = "'.$user_id.'" AND id = "'.$date_id.'"';
			$result = mysqli_query($mysqli, $query);
			if($result){
				$row = mysqli_fetch_assoc($result);
				if($row["timeOut"] > 0){
	                $datetime1 = strtotime($row["timeIn"]);
	                $datetime2 = strtotime($row["timeOut"]);
	                $renderedTime = number_format(round(($datetime2 - $datetime1)/3600,1),1);
	                $underTime = number_format(8.0 - $renderedTime, 1);

	                 if($row["lunchOut"] > 0){
		               $datetime3 = strtotime($row["lunchIn"]);
		               $datetime4 = strtotime($row["lunchOut"]);
		               $renderedLunch = number_format(round(($datetime4 - $datetime3)/3600,1),1);
		               $datetime1 = strtotime($row["timeIn"]);
		               $datetime2 = strtotime($row["timeOut"]);
		               $renderedTime = number_format(round((($datetime2 - $datetime1)/3600) - $renderedLunch, 1),2);
		               $underTime = number_format(8.0 - $renderedTime, 1);
		            }
		            $query = 'UPDATE `timetable`
					SET timeIn = "'.$timeIn.'", timeOut = "'.$timeOut.'", lunchIn = "'.$lunchIn.'", lunchOut = "'.$lunchOut.'", totalHours = "'.$renderedTime.'", undertime = "'.$underTime.'"
					WHERE `user_id` = "'.$user_id.'" AND id = "'.$date_id.'"';
	            }else{
	            	$query = 'UPDATE `timetable`
					SET timeIn = "'.$timeIn.'", timeOut = "'.$timeOut.'", lunchIn = "'.$lunchIn.'", lunchOut = "'.$lunchOut.'"
					WHERE `user_id` = "'.$user_id.'" AND id = "'.$date_id.'"';
	            }

	            if(mysqli_query($mysqli, $query)){
	            	$query = 'SELECT * FROM timetable WHERE date="'.$date.'" AND user_id = "'.$user_id.'" AND id = "'.$date_id.'"';
	            	$result = mysqli_query($mysqli, $query);
					if($result){
						$row = mysqli_fetch_assoc($result);
						$date = date_format(date_create($row["date"]), "F d, Y");
		                $timeIn = date("h:i A", strtotime($row["timeIn"]));
		                $input_timeIn = date("H:i", strtotime($row["timeIn"]));
		                if($row["timeOut"] == 0){
		                  $input_timeOut = $timeOut = "-";
		                  $renderedTime = "-";
		                  $underTime = "-";
		                }else{
		                  $timeOut = date("h:i A", strtotime($row["timeOut"]));
		                  $input_timeOut = date("H:i", strtotime($row["timeOut"]));
		                  $datetime1 = date("h:i", strtotime($row["timeIn"]));
		                  $datetime1 = strtotime($datetime1);
		                  $datetime2 = date("h:i", strtotime($row["timeOut"]));
		                  $datetime2 = strtotime($datetime2);
		                  $renderedTime = number_format(round(($datetime2 - $datetime1)/3600,2),1);
		                  $underTime = number_format(8.0 - $renderedTime, 1);
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
		                  $datetime3 = date("h:i", strtotime($row["lunchIn"]));
		                  $datetime3 = strtotime($datetime3);
		                  $datetime4 = date("h:i", strtotime($row["lunchOut"]));
		                  $datetime4 = strtotime($datetime4);
		                  $renderedLunch = number_format(round(($datetime4 - $datetime3)/3600,1),1);
		                  $datetime1 = date("h:i", strtotime($row["timeIn"]));
		                  $datetime1 = strtotime($datetime1);
		                  $datetime2 = date("h:i", strtotime($row["timeOut"]));
		                  $datetime2 = strtotime($datetime2);
		                  if($row["timeOut"] > 0){
		                    $renderedTime = number_format(round((($datetime2 - $datetime1)/3600) - $renderedLunch, 1),1);
		                    $underTime = number_format(8.0 - $renderedTime, 1);
		                  }       
		                }

		                // echo '
		                //   <tr id="edit'.$row["id"].'">
		                //       <td>'.$date.'</td>
		                //       <td>'.$timeIn.'</td>
		                //       <td>'.$timeOut.'</td>
		                //       <td>'.$lunchIn.'</td>
		                //       <td>'.$lunchOut.'</td>
		                //       <td>'.$renderedTime.'</td>
		                //       <td>'.$renderedLunch.'</td>
		                //       <td>'.$underTime.'</td>
		                //       <td> <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit'.$row["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
		                //       <!-- Modal -->
		                //       <div id="edit'.$row["id"].'" class="modal fade" role="dialog">
		                //         <div class="modal-dialog">

		                //           <!-- Update Modal content-->
		                //           <form id="edit-form" action="updateEmployeeTimetable.php" method="GET">
		                //             <div class="modal-content">
		                //               <div class="modal-header">
		                //                 <button type="button" class="close" data-dismiss="modal">&times;</button>
		                //                 <h4 class="modal-title"><strong>'.$date.'</strong></h4>
		                //               </div>
		                //               <div class="modal-body">
		                //                 <div class="alert alert-danger">
		                //                   <a href="#" class="close" style="text-decoration:none" data-dismiss="alert" aria-label="close" onclick="closeAllAlert()">&times;</a>
		                //                   <strong>Note:</strong> add " - " if empty.
		                //                 </div>
		                //                 <div class="row">
		                //                   <div class="col-md-6">
		                //                     <input type="text" name="user_id" value="'.$user_id.'" hidden />
		                //                     <input type="text" name="date_id" value="'.$row["id"].'" hidden />
		                //                     <input type="text" name="date" value="'.$date.'" hidden />
		                //                     <label for="timeIn">Time In</label><br>
		                //                     <input type="time" name="timeIn" value="'.$input_timeIn.'" /><br><br>
		                //                     <label for="timeOut">Time Out</label><br>
		                //                     <input type="time" name="timeOut" value="'.$input_timeOut.'" /><br><br>
		                //                   </div>
		                //                   <div class="col-md-6">
		                //                     <label for="lunchIn">Lunch In</label><br>
		                //                     <input type="time" name="lunchIn" value="'.$input_lunchIn.'" /><br><br>
		                //                     <label for="lunchOut">Lucn Out</label><br>
		                //                     <input type="time" name="lunchOut" value="'.$input_lunchOut.'" /><br><br>
		                //                   </div>
		                //                 </div>
		                //               </div>
		                //               <div class="modal-footer">
		                //                 <input type="submit" class="btn btn-warning" value="Edit" />
		                //               </div>
		                //             </div>
		                //           </form>

		                //         </div>
		                //       </div>
		                //   </tr>
		                // ';

		                $month = date('F');
			            $date = date('d'); 
			            $year = date('Y');
			            $until = date('Y-m-d');

			            if($date <= 15){
			              $since = date('Y-m-d', strtotime($year."-".$month."-01"));
			              $qry = 'SELECT * FROM timetable WHERE user_id = '.$user_id.' AND date BETWEEN "'.$since.'" AND "'.$until.'"';
			            }else{
			              $since = date('Y-m-d', strtotime($year."-".$month."-16"));
			              $qry = 'SELECT * FROM timetable WHERE user_id = '.$user_id.' AND date BETWEEN "'.$since.'" AND "'.$until.'"';
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
			                }else{
			                  $timeOut = date("h:i A", strtotime($row["timeOut"]));
			                  $input_timeOut = date("H:i", strtotime($row["timeOut"]));
			                  $datetime1 = date("h:i", strtotime($row["timeIn"]));
			                  $datetime1 = strtotime($datetime1);
			                  $datetime2 = date("h:i", strtotime($row["timeOut"]));
			                  $datetime2 = strtotime($datetime2);
			                  $renderedTime = number_format(round(($datetime2 - $datetime1)/3600,2),1);
			                  $underTime = number_format(8.0 - $renderedTime, 1);
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
			                  $datetime3 = date("h:i", strtotime($row["lunchIn"]));
			                  $datetime3 = strtotime($datetime3);
			                  $datetime4 = date("h:i", strtotime($row["lunchOut"]));
			                  $datetime4 = strtotime($datetime4);
			                  $renderedLunch = number_format(round(($datetime4 - $datetime3)/3600,1),1);
			                  $datetime1 = date("h:i", strtotime($row["timeIn"]));
			                  $datetime1 = strtotime($datetime1);
			                  $datetime2 = date("h:i", strtotime($row["timeOut"]));
			                  $datetime2 = strtotime($datetime2);
			                  if($row["timeOut"] > 0){
			                    $renderedTime = number_format(round((($datetime2 - $datetime1)/3600) - $renderedLunch, 1),1);
			                    $underTime = number_format(8.0 - $renderedTime, 1);
			                  }       
			                }

			                echo '
			                  <tr id="edit'.$row["id"].'">
			                      <td>'.$date.'</td>
			                      <td>'.$timeIn.'</td>
			                      <td>'.$timeOut.'</td>
			                      <td>'.$lunchIn.'</td>
			                      <td>'.$lunchOut.'</td>
			                      <td>'.$renderedTime.'</td>
			                      <td>'.$renderedLunch.'</td>
			                      <td>'.$underTime.'</td>
			                      <td> <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit'.$row["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
			                      <!-- Modal -->
			                      <div id="edit'.$row["id"].'" class="modal fade" role="dialog">
			                        <div class="modal-dialog">

			                          <!-- Update Modal content-->
			                          <form id="edit-form" action="updateEmployeeTimetable.php" method="GET">
			                            <div class="modal-content">
			                              <div class="modal-header">
			                                <button type="button" class="close" data-dismiss="modal">&times;</button>
			                                <h4 class="modal-title"><strong>'.$date.'</strong></h4>
			                              </div>
			                              <div class="modal-body">
			                                <div class="alert alert-danger">
			                                  <a href="#" class="close" style="text-decoration:none" data-dismiss="alert" aria-label="close" onclick="closeAllAlert()">&times;</a>
			                                  <strong>Note:</strong> add " - " if empty.
			                                </div>
			                                <div class="row">
			                                  <div class="col-md-6">
			                                    <input type="text" name="user_id" value="'.$user_id.'" hidden />
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
					}else{
						echo 'Something went wrong! 005';
					}
	            }else{
	            	echo 'Something went wrong! 004';
	            }
			}	
		//}
		
	}
?>