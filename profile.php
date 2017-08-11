<?php
  require ("php_globals.php");
  include ("dashboard.php");
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
    include ("dashboard/footer.php");
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

<script>
$(document).ready(function(){
    setInterval(timestamp, 1000);
});

function timestamp() {
    $.ajax({
        url: "functions/timestamp.php?time",
        success: function(data) {
            $('#time').html(data);
        },
    });    

    $.ajax({
        url: "functions/timestamp.php?date",
        success: function(data) {
            $('#date').html(data);
        },
    });
}
</script>
<script type="text/javascript">
  $(document).on('click', '#btnTimeIn', function(event){
    ajax("functions/timeInOut.php?timeIn", "Time in?", "", "Time IN Successful!", "Time in");
  });

  $(document).on('click', '#btnTimeOut', function(event){
    ajax("functions/timeInOut.php?timeOut", "Time Out?", "", "Time OUT Successful!", "Time out");
  });

  $(document).on('click', '#btnLunchIn', function(event){
    ajax("functions/timeInOut.php?lunchIn", "Lunch in?", "", "Lunch IN Successful!", "Lunch in");
  });

  $(document).on('click', '#btnLunchOut', function(event){
    ajax("functions/timeInOut.php?lunchOut",  "Lunch out?", "", "Lunch OUT Successful!", "Lunch out");
  });

  function ajax(phpUrl, titleText, textText, successText, confirmBtnText){
      // Variable to hold request
      var request;

      // Prevent default posting of form - put here to work in case of errors
      event.preventDefault();

      // Abort any pending request
      if (request) {
          request.abort();
      }

      // setup some local variables
      var $btn = $(this);

      // Let's disable the button for the duration of the Ajax request.
      // Note: we disable elements AFTER the form data has been serialized.
      // Disabled form elements will not be serialized.
      $btn.prop("disabled", true);

      swal({
        title: titleText,
        text: textText,
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: confirmBtnText,
        cancelButtonText: "Cancel",
        cancelButtonClass: "btn-danger",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
      },
      function (isConfirm) {
          if (isConfirm) {
            setTimeout(function(){
              request = $.ajax({
                url: phpUrl,
                type: "GET"
              });

              // Callback handler that will be called on success
              request.done(function (response, textStatus, jqXHR){
                  var parts = response.split('|');
                  if(parts[1] == "fail"){
                    swal("Error!", "An error has occurred", "error");
                  }else{
                    swal(successText, "", "success");
                    //document.getElementById("alertMsg").innerHTML=parts[0];
                    document.getElementById("time-btns").innerHTML=parts[0];
                    document.getElementById("timeToday-tbody").innerHTML=parts[1];
                  }       
              });

              // Callback handler that will be called on failure
              request.fail(function (jqXHR, textStatus, errorThrown){
                  swal("Error!", "An error has occurred", "error");
                  // Log the error to the console
                  console.error(
                      "The following error occurred: "+
                      textStatus, errorThrown
                  );
              });

              // Callback handler that will be called regardless
              // if the request failed or succeeded
              request.always(function () {
                  // Reenable the inputs
                  $btn.prop("disabled", false);
              });
            }, 500);
          } else {
            swal("Cancelled", "", "error");
          }
      });
  }
</script>