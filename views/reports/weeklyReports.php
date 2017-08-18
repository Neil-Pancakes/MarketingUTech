<?php
  require ("../../functions/php_globals.php");
  include ("../dashboard/dashboard.php");
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
    		<?php
	    		$currentweek = (int)(date('j',time())/7);
                $currentmonth = date('n',time());
                $currentyear = date('Y',time());

                switch ($currentweek) {
                    case '0':
                        echo "First";
                        break;

                    case '1':
                        echo "Second";
                        break;
                    
                    case '2':
                        echo "Third";
                        break;

                    case '3':
                        echo "Fourth";
                        break;

                    case '4':
                        echo "Fifth";
                        break;

                    default:
                        echo "Error";
                        break;
                }
	    	?> Week
	    	<small>Report</small>
	    </h1>
    </section>
    <!-- Content (Body) -->
    <section class="content">
    	<table class="table table-bordered table-hover table-condensed" id="table_wrapper">
    		<thead>
    			<tr>
    				<th>Name</th>
    				<th>No. of Days Worked</th>
    				<th>No. of Paid Leaves</th>
    				<th>No. of Unpaid Leaves</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php
    				$qry = 'SELECT * FROM users';
            		$result = mysqli_query($mysqli, $qry);
            		if ($result) {
            			while ($row = mysqli_fetch_assoc($result)) {
                            $qery = "SELECT `totalHours` , `date`
                                    FROM `timetable`
                                    WHERE user_id = ".$row['id']."";
                            $res = mysqli_query($mysqli, $qery);
                            if ($res) {
                                $days = 0;
                                while ($daysWorked = mysqli_fetch_assoc($res)) {
                                    $mydate = $daysWorked['date'];
                                    $dayofweek = date("w",strtotime($mydate));
                                    $week = date("j",strtotime($mydate));
                                    $month = date("n",strtotime($mydate));
                                    $year = date("Y",strtotime($mydate));
                                    //  week of work is compared to the actual week
                                    //  month of work is compared to the actual month
                                    //  year of work is compared to the actual year
                                    if ($week/7<=$currentweek&&$month==$currentmonth&&$year==$currentyear) {
                                        $minHours = 0;
                                        if ($row['workStatus'] == 'Regular') {
                                            $minHours = 8;
                                        }
                                        if ($daysWorked['totalHours']>$minHours && ($dayofweek!=0 || $dayofweek!=6)) {
                                            $days++;
                                        }
                                    }
                                }
                            }
            				echo "
            					<tr>
            						<td>".$row['firstName']." ".$row['lastName']."</td>
            						<td>".$days."</td>
            						<td></td>
            						<td></td>
            					</tr>
            				";
            			}
            		}
    			?>
    		</tbody>
    	</table>
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-success" id="btnExport">Save as xml file</button>
            </div>
        </div>
	</section>
</div>
<script src="../../functions/xmlConverter.js"></script>
