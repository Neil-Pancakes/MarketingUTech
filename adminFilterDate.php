<?php
	require ("php_globals.php");
	session_start();

	if(isset($_GET['since']) && isset($_GET['until'])){
		$since = date('Y-m-d', strtotime(strtr($_GET['since'], '/', '-')));
		$until = date('Y-m-d', strtotime(strtr($_GET['until'], '/', '-')));		

		$qry = 'SELECT * FROM timetable WHERE user_id = '.$_SESSION["filter_id"].' AND timeIn != 0 AND date BETWEEN "'.$since.'" AND "'.$until.'"';
		$result = mysqli_query($mysqli, $qry);

        if($result){
          if(mysqli_num_rows($result) > 0){
          	while($row = mysqli_fetch_assoc($result)){
	            $date = date_format(date_create($row["date"]), "F d, Y");
	            $timeIn = date("h:i A", strtotime($row["timeIn"]));
	            if($row["timeOut"] == 0){
	              $timeOut = "-";
	              $noOfHours = 0;
	              $renderedTime = 0;
	            }else{
	              $timeOut = date("h:i A", strtotime($row["timeOut"]));
	              $noOfHours = $timeOut - $timeIn;

	              $datetime1 = date_create($row["timeIn"]);
	              $datetime2 = date_create($row["timeOut"]);
	              $interval = date_diff($datetime1, $datetime2);
	              $renderedTime = $interval->format('%h hours %i minutes');
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
	            	$datetime3 = date_create($row["lunchIn"]);
	              	$datetime4 = date_create($row["lunchOut"]);
	              	$interval = date_diff($datetime3, $datetime4);
	              	$renderedLunch = $interval->format('%h hours %i minutes');
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
	                  <td></td>
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