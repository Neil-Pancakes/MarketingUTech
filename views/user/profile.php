<?php
  require ("../../functions/php_globals.php");
  include ("../dashboard/dashboard.php");
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
    	<?php
    		$query = "SELECT *
                  FROM `users`
                  WHERE id = ".$_SESSION["user_id"];
        $result = mysqli_query($mysqli, $query);
        if($result){
          $row = mysqli_fetch_assoc($result);
          echo "<h1>
		        Profile
		        <small>".$row["firstName"]." ".$row["lastName"]."</small>";
        }
    	?>
      <a href="changePassword.php" class="btn btn-danger" role="button" style="float:right">Change Password</a>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class='modal-content'>
        <div class='modal-header'>
          <h4 class='modal-title'><strong>View</strong></h4>
        </div>

        <div class='modal-body'>
          <div class='row'>
            <?php
              echo "
                <div class='col-md-3'>
                  <h4>Basic Info</h4>
                  <label>First Name</label><br>
                  <div>".$row["firstName"]."</div><br><br>
                  <label>Last Name</label><br>
                  <div>".$row["firstName"]."</div><br><br>
                  <label>Email</label><br>
                  <div>".$row["email"]."</div><br><br>
                  <label>Job Title</label><br>
                  <div>".$row["jobTitle"]."</div><br><br>
                  <label>Work Status</label><br>
                  <div>".$row["workStatus"]."</div><br><br>
                </div>
                	<div class='col-md-3'>
                  	<h4>Contact Number</h4>
                  	<label>Mobile Number</label>
                  	<div>".$row["mobileNumber"]."</div><br><br>
                  	<label>Telephone Number</label>
                  	<div>".$row["telephoneNumber"]."</div><br><br>
                	</div>
                	<div class='col-md-3'>
                		<h4>Other Info</h4>
                  	<label>Address</label>
                  	<div>".$row["address"]."</div><br><br>
                  	<label>Birthday</label>
                  	<div>".$row["birthday"]."</div>
                	</div>";

                	if($row['workStatus'] == '') {
                  	echo "
                  		<div class='col-md-3'>
                    		<!-- if type is OJT else hide -->
                    		<h4>OJT Details</h4>
  	                	<div id='view_ojt_info'".$row["id"]." class='col-md-3'>
                    		<label>Total hours</label><br>
                    		<div>".$row["OJT_hoursTotal"]."</div><br><br>
                    		<label>Hours Remaining</label><br>
                    		<div>".$row["OJT_hoursRemaining"]."</div><br><br>
                    		<label>Allowance Daily</label><br>
                    		<div>".$row["OJT_allowanceDaily"]."</div><br><br>
                		</div>";
                  }
              ?>
		      			</div>
		      		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include ("../dashboard/control_sidebar.php");
  ?>

</div>
<!-- ./wrapper -->

