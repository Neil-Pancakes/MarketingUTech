<?php
  require ("../../functions/php_globals.php");
  include ("../dashboard/dashboard.php");
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
				        <small>".$row["firstName"]." ".$row["lastName"]."</small>
				      </h1>". "<ol class='breadcrumb'>
				        <li><a href='#'><i class='fa fa-dashboard'></i> Level</a></li>
				        <li class='active'>Here</li>
				      </ol>";
			}
    	?>
    </section>
    <!-- Main content -->
    <section class="content">
    	<?php
	    	echo "
	    	<div class='modal-content'>
	        <div class='modal-header'>
	          <h4 class='modal-title'><strong>View</strong></h4>
	        </div>
	        <div class='modal-body'>
	              <div class='row'>
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

                  	if($row['workStatus'] == '')
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
	      		echo "
		      			</div>
		      		</div>
		        ";
	    ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    //include ("../dashboard/footer.php");
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon`s Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar`s background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

