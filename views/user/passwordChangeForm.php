<?php
  require ("../../functions/php_globals.php");
  include ("../dashboard/dashboard.php");
?>

	<section class="content-header">
		<h1>
			Change Password
			<small>UniversalTech</small>
		</h1>
	</section>

	<section class="content">
		<div class="container">
			<form action="../../functions/changePassword.php" method="POST">
				<br><br><br><br><br>
				<div class="col-md-3"></div>
				<div class="form-group col-md-5 text-center">
					<label for="password">New Password:</label>
					<input type="password" class="form-control" id="password" required> <br>
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</form>
		</div>
	</section>