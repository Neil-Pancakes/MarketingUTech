<?php
	require ("../../functions/php_globals.php");
	session_start();

	if(isset($_GET['since']) && isset($_GET['until'])){
		$since = date('Y-m-d', strtotime(strtr($_GET['since'], '/', '-')));
		$until = date('Y-m-d', strtotime(strtr($_GET['until'], '/', '-')));		

		$qry = 'SELECT * FROM timetable WHERE user_id = '.$_SESSION['user_id'].' AND timeIn != 0 AND date BETWEEN "'.$since.'" AND "'.$until.'"';
		$result = mysqli_query($mysqli, $qry);

        if($result){
          if(mysqli_num_rows($result) > 0){
          	while($row = mysqli_fetch_assoc($result)){
	            $date = date_format(date_create($row["date"]), "F d, Y");
	            $timeIn = date("h:i A", strtotime($row["timeIn"]));
	            if($row["timeOut"] == 0){
	              $timeOut = "-";
	              $renderedTime = 0;
	              $underTime = "-";
	            }else{
	              $timeOut = date("h:i A", strtotime($row["timeOut"]));
	              $datetime1 = date("H:i", strtotime($row["timeIn"]));
	              $datetime1 = strtotime($datetime1);
	              $datetime2 = date("H:i", strtotime($row["timeOut"]));
                  $datetime2 = strtotime($datetime2);
	              $renderedTime = abs(number_format(round(($datetime2 - $datetime1)/3600,1),1));
                  $underTime = number_format(8.0 - $renderedTime, 1);
                  if($underTime < 0){
                    $overTime = abs($underTime);
                    $underTime = 0;
                  }else{
                    $overTime = 0;
                  }

                  if($renderedTime > 8 && $row['overtimeStatus'] != 'true'){
                    $renderedTime = 8;
                  }
	            }

	            if($row["lunchIn"] == 0){
	            	$lunchIn = "-";
	            	$renderedLunch = "-";
	            }else{
	            	$lunchIn = date("h:i A", strtotime($row["lunchIn"]));
	            }

	            if($row["lunchOut"] == 0){
	            	$lunchOut = "-";
	            	$renderedLunch = "-";
	            }else{
	            	$lunchOut = date("h:i A", strtotime($row["lunchOut"]));
	            	$datetime3 = date("H:i", strtotime($row["lunchIn"]));
	            	$datetime3 = strtotime($datetime3);
	            	$datetime4 = date("H:i", strtotime($row["lunchOut"]));
                  	$datetime4 = strtotime($datetime4);
	              	$renderedLunch = number_format(round(($datetime4 - $datetime3)/3600,1),1);
	              	$datetime1 = date("H:i", strtotime($row["timeIn"]));
	              	$datetime1 = strtotime($datetime1);
	              	$datetime2 = date("H:i", strtotime($row["timeOut"]));
                  	$datetime2 = strtotime($datetime2);
                  	if($row["timeOut"] > 0){
                    	abs($renderedTime = number_format(round((($datetime2 - $datetime1)/3600) - $renderedLunch, 1),1));
                    	$underTime = number_format(8.0 - $renderedTime, 1);
                    	if($underTime < 0){
	                      $overTime = abs($underTime);
	                      $underTime = 0;
	                    }else{
	                      $overTime = 0;
	                    }

	                    if($renderedTime > 8 && $row['overtimeStatus'] != 'true'){
	                      $renderedTime = 8;
	                    }
                  	}
	            }

	            echo '
	              <tr>
	                  <td>'.$date.'</td>
	                  <td>'.$timeIn.'</td>
	                  <td>'.$timeOut.'</td>
	                  <td>'.$lunchIn.'</td>
	                  <td>'.$lunchOut.'</td>
	                  <td>'.$renderedTime.'</td>
	                  <td>'.$renderedLunch.'</td>
	                  <td>'.$underTime.'</td>
	                  <td>'.$overTime.'</td>
	              </tr>
	            ';
	          }
          }else{
          	echo '
				<tr class="odd">
					<td valign="top" colspan="7" class="dataTables_empty">
						No data available in table
					</td>
				</tr>
        	';
          }
        }
	}else{
		header('location: viewTimetable.php');
	}
?>