<?php
	// Set timezone
	date_default_timezone_set('Asia/Manila');

	// Get prev & next month
	if(isset($_GET['ym'])) {
		$ym = $_GET['ym'];
	}else{
		// This month
		$ym = date('Y-m');
	}

	// Check format
	$timestamp = strtotime($ym, '-01');
	if($timestamp === false) {
		$timestamp = time();
	}

	// Today
	$today = date('Y-m-j', time());

	// For H3 title
	$html_title = date('F Y', $timestamp);

	//echo date('Y-m-j', $timestamp);

	// Create prev & next month link
	$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
	$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));

	// Number of days in the month
	$day_count = date('t', $timestamp);

	// 0:Sun 1:Mon 2:Tue...
	$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

	// Create calendar
	$weeks = array();
	$week = '';

	// Create modals
	$modals = array();

	// Add empty cell
	$week .= str_repeat('<td></td>', $str);

	for($day = 1; $day <= $day_count; $day++, $str++) {
		$date = $ym.'-'.$day;

		if($today == $date) {
			$week .= '<td class="today"><a data-toggle="modal" data-target="#'.$date.'">'.$day;
		}else{
			$week .= '<td><a data-toggle="modal" data-target="#'.$date.'">'.$day;
		}
		$week .= '</a></td>';

		// End of the week OR End of the month
		if($str % 7 == 6 || $day == $day_count) {
			if($day == $day_count) {
				// Add empty cell
				$week .= str_repeat('<td></td>', 6 - ($str % 7));
			}

			$weeks[] = '<tr>'.$week.'</tr>';

			// Prepare for new week
			$week = '';
		}

		$modals[] = '
			<!-- Modal -->
			<div id="'.$date.'" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-sm">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">'.date('F d, Y', strtotime($date)).'</h4>
			      </div>
			      <div class="modal-body">
			        <p>Some text in the modal.</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>

			  </div>
			</div>
		';
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	<style>
		.container {
			font-family: 'Roboto', sans-serif;
		}
		.calendar th {
			height: 30px;
			text-align: center;
			font-weight: 700;
		}
		.calendar td {
			height: 100px;
		}
		.calendar td a {
			display: block;
			width: 100%;
			height: 100%;
		}
		.today {
			background: green;
		}
		.calendar th:nth-of-type(7),td:nth-of-type(7) {
			color: blue;
		}
		.calendar th:nth-of-type(1),td:nth-of-type(1) {
			color: red;
		}
	</style>
</head>
<body>
	<div class="container">
		<h3><a href="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
		<br>
		<table class="calendar table table-bordered">
			<tr>
				<th>Sun</th>
				<th>Mon</th>
				<th>Tue</th>
				<th>Wed</th>
				<th>Thurs</th>
				<th>Fri</th>
				<th>Sat</th>
			</tr>
			<?php
				foreach($weeks as $week) {
					echo $week;
				}
			?>
		</table>
		<?php
			foreach($modals as $modal) {
				echo $modal;
			}
		?>
	<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>