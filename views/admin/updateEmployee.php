<?php
	require ("../../functions/php_globals.php");
	include ("adminFunctions.php");

	if(isset($_GET['id']) && isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['email']) && isset($_GET['jobTitle']) && isset($_GET['workStatus']) && isset($_GET['birthday']) && isset($_GET['address'])){
		$id = $_GET['id'];
		$firstName = $_GET['firstName'];
		$lastName = $_GET['lastName'];
		$email = $_GET['email'];
		$jobTitle = $_GET['jobTitle'];
		$workStatus = $_GET['workStatus'];
		$birthday = $_GET['birthday'];
		$address = mysqli_real_escape_string($mysqli, $_GET['address']);

		if(isset($_GET['mobileNumber'])){
			$mobileNumber = $_GET['mobileNumber'];
		}else{
			echo 'Mobile number not set';
		}

		if(isset($_GET['telephoneNumber'])){
			$telephoneNumber = $_GET['telephoneNumber'];
		}else{
			echo 'Telephone number not set';
		}


		if($workStatus == "OJT"){
			if(isset($_GET['OJT_hoursTotal']) && isset($_GET['OJT_hoursRemaining']) && isset($_GET['OJT_allowanceDaily'])){
				$OJT_hoursTotal = $_GET['OJT_hoursTotal'];
				$OJT_hoursRemaining = $_GET['OJT_hoursRemaining'];
				$OJT_allowanceDaily = $_GET['OJT_allowanceDaily'];

				$qry = "
					UPDATE users
					SET firstName = '".$firstName."',
						lastName = '".$lastName."',
						email = '".$email."',
						jobTitle = '".$jobTitle."',
						workStatus = '".$workStatus."',
						birthday = '".$birthday."',
						mobileNumber = '".$mobileNumber."',
						telephoneNumber = '".$telephoneNumber."',
						address = '".$address."',
						OJT_hoursTotal = '".$OJT_hoursTotal."',
						OJT_hoursRemaining = '".$OJT_hoursRemaining."',
						OJT_allowanceDaily = '".$OJT_allowanceDaily."'
					WHERE id = '".$id."'
				";

				$result = mysqli_query($mysqli, $qry);
			}else{
				echo "ojt info isset error";
			}
		}else{
			if(isset($_GET['basicPay']) && isset($_GET['allowance']) && isset($_GET['transportation']) && isset($_GET['meal'])){
				if(isset($_GET['dateHiredTrainee'])){
					$dateHiredTrainee = $_GET['dateHiredTrainee'];
				}else{
					
				}
				if(isset($_GET['dateHiredProbationary'])){
					$dateHiredProbationary = $_GET['dateHiredProbationary'];
				}else{
					echo 'Date hired probationary is not set';
				}
				if(isset($_GET['dateHiredRegular'])){
					$dateHiredRegular = $_GET['dateHiredRegular'];
				}else{
					echo 'Date hired regular is not set';
				}

				$basicPay = $_GET['basicPay'];
				$allowance = $_GET['allowance'];
				$transportation = $_GET['transportation'];
				$meal = $_GET['meal'];

				$qry = "
					UPDATE users
					SET firstName = '".$firstName."',
						lastName = '".$lastName."',
						email = '".$email."',
						jobTitle = '".$jobTitle."',
						workStatus = '".$workStatus."',
						dateHiredTrainee = '".$dateHiredTrainee."',
						dateHiredProbationary = '".$dateHiredProbationary."',
						dateHiredRegular = '".$dateHiredRegular."',
						basicPay = '".$basicPay."',
						allowance = '".$allowance."',
						transportation = '".$transportation."',
						meal = '".$meal."',
						birthday = '".$birthday."',
						mobileNumber = '".$mobileNumber."',
						telephoneNumber = '".$telephoneNumber."',
						address = '".$address."'
					WHERE id = '".$id."'
				";

				$result = mysqli_query($mysqli, $qry);
			}
		}

		if($result){
			$qry = 'SELECT * FROM users';
	        $result = mysqli_query($mysqli, $qry);

	        if($result) {
	          	while($row = mysqli_fetch_assoc($result)){
		            if($row["birthday"] == NULL){
		              $birthday = '';
		            }else{
		              $birthday = date_format(date_create($row["birthday"]), "F d, Y");
		            }
                echo '
                  <tr>
                    <td><a href="adminViewTimetable.php?id='.$row["id"].'">'.$row["firstName"].' '.$row["lastName"].'</a></td>
                    <td>'.$row["jobTitle"].'</td>
                    <td>'.$row["email"].'</td>
                    <td>'.$birthday.'</td>
                    <td>'.$row["mobileNumber"].'</td>
                    <td>'.$row["workStatus"].'</td>
                    <td>
                      <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#view'.$row["id"].'" onclick="viewCheckOJT('.$row["id"].')"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
                      <!-- Modal -->
                      <div id="view'.$row["id"].'" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                          <!-- View Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"><strong>View</strong></h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-3">
                                  <h4>Basic Info</h4>
                                  <label>First Name</label><br>
                                  <div>'.$row["firstName"].'</div><br><br>
                                  <label>Last Name</label><br>
                                  <div>'.$row["lastName"].'</div><br><br>
                                  <label>Email</label><br>
                                  <div>'.$row["email"].'</div><br><br>
                                  <label>Job Title</label><br>
                                  <div>'.$row["jobTitle"].'</div><br><br>
                                  <label>Work Status</label><br>
                                  <div id="view_workStatus'.$row["id"].'">'.$row["workStatus"].'</div><br><br>
                                </div>
                                <div id="view_dateOfHire'.$row["id"].'" class="col-md-3">
                                  <h4>Date of Hire</h4>
                                  <label>Trainee</label><br>
                                  <div>'.$row["dateHiredTrainee"].'</div><br><br>
                                  <label>Probationary</label><br>
                                  <div>'.$row["dateHiredProbationary"].'</div><br><br>
                                  <label>Regular</label><br>
                                  <div>'.$row["dateHiredRegular"].'</div><br><br>
                                </div>

                                <div id="view_compensation'.$row["id"].'" class="col-md-3">
                                    <h4>Current Compensation</h4>
                                    <label>Basic Pay</label><br>
                                    <div>'.$row["basicPay"].'</div><br><br>
                                    <label>Allowance</label><br>
                                    <div>'.$row["allowance"].'</div><br><br>
                                    <label>Transportation</label><br>
                                    <div>'.$row["transportation"].'</div><br><br>
                                    <label>Meal</label><br>
                                    <div>'.$row["meal"].'</div><br><br>
                                  </div>
                                  <div class="col-md-3">
                                    <h4>Contact Number</h4>
                                    <label>Mobile Number</label>
                                    <div>'.$row["mobileNumber"].'</div><br><br>
                                    <label>Telephone Number</label>
                                    <div>'.$row["telephoneNumber"].'</div><br><br>
                                    <h4>Other Info</h4>
                                    <label>Address</label>
                                    <div>'.$row["address"].'</div><br><br>
                                    <label>Birthday</label>
                                    <div>'.$birthday.'</div>
                                  </div>

                                <!-- if type is OJT else hide -->
                                <div id="view_ojt_info'.$row["id"].'" class="col-md-3">
                                  <label>Total hours</label><br>
                                  <div>'.$row["OJT_hoursTotal"].'</div><br><br>
                                  <label>Hours Remaining</label><br>
                                  <div>'.$row["OJT_hoursRemaining"].'</div><br><br>
                                  <label>Allowance Daily</label><br>
                                  <div>'.$row["OJT_allowanceDaily"].'</div><br><br>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                      <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#update'.$row["id"].'" onclick="updateCheckOJT('.$row["id"].')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                      
                      <!-- Modal -->
                      <div class="modal fade" id="update'.$row["id"].'" role="dialog">
                        <div class="modal-dialog modal-lg">
                          <!-- Update Modal content-->
                          <form id="update-form" action="updateEmployee.php" method="GET">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title"><strong>Edit</strong></h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-4">
                                    <h4>Basic Info</h4>
                                    <input type="text" name="id" value="'.$row["id"].'" hidden />
                                    <div class="form-group">
                                      <label for="firstName">First Name</label>
                                      <input type="text" class="form-control" name="firstName" value="'.$row["firstName"].'" onkeypress="return isLetter(event)" required/>
                                    </div>
                                    <div class="form-group">
                                      <label for="lastName">Last Name</label>
                                      <input type="text" class="form-control" name="lastName" value="'.$row["lastName"].'" onkeypress="return isLetter(event)" required/>
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="email" class="form-control" name="email" value="'.$row["email"].'" disabled/>
                                      <input type="email" name="email" value="'.$row["email"].'" hidden/>
                                    </div>';

                                    displayJobTitleSelect($row);
                                    displayWorkStatusSelect($row);

                                  echo'
                                  </div>
                                  <div id="dateOfHire'.$row["id"].'" class="form-group col-md-4">
                                    <h4>Date of Hire</h4>
                                    <label for="dateHiredTrainee">Trainee</label><br>
                                    <input type="date" class="form-control" name="dateHiredTrainee" value="'.$row["dateHiredTrainee"].'" /><br><br>
                                    <label for="dateHiredProbationary">Probationary</label><br>
                                    <input type="date" class="form-control" name="dateHiredProbationary" value="'.$row["dateHiredProbationary"].'" /><br><br>
                                    <label for="dateHiredRegular">Regular</label><br>
                                    <input type="date" class="form-control" name="dateHiredRegular" value="'.$row["dateHiredRegular"].'" /><br><br>
                                  </div>
                                  <div id="compensation'.$row["id"].'" class="form-group col-md-4">
                                    <h4>Current Compensation</h4>
                                    <label for="basicPay">Basic Pay</label><br>
                                    <input type="number" class="form-control" name="basicPay" value="'.$row["basicPay"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="allowance">Allowance</label><br>
                                    <input type="number" class="form-control" name="allowance" value="'.$row["allowance"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="transportation">Transportation</label><br>
                                    <input type="number" class="form-control" name="transportation" value="'.$row["transportation"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="meal">Meal</label><br>
                                    <input type="number" class="form-control" name="meal" value="'.$row["meal"].'" step="0.01" min="0" onkeypress="return isDecimal(event)" required/><br><br>
                                  </div>
                                  <div class="form-group col-md-4">
                                    <h4>Contact Number</h4>
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobileNumber" value="'.$row["mobileNumber"].'" onkeypress="return isNumber(event)" /><br><br>
                                    <label for="telephoneNumber">Telephone Number</label>
                                    <input type="text" class="form-control" name="telephoneNumber" value="'.$row["telephoneNumber"].'" onkeypress="return isNumber(event)" /><br><br>
                                    <h4>Other Info</h4>
                                    <label for="address">Address</label>
                                    <textarea type="text" class="form-control" name="address">'.$row["address"].'</textarea><br><br>
                                    <label for="birthday">Birthday</label>
                                    <input type="date" class="form-control" name="birthday" value="'.$row["birthday"].'" required /><br><br>
                                  </div>
                              
                                  <!-- if type is OJT else hide -->
                                  <div id="update_ojt_info'.$row['id'].'" class="form-group col-md-4">
                                    <h4>OJT Info</h4>
                                    <label for="OJT_hoursTotal">Total hours</label><br>
                                    <input type="number" class="form-control" name="OJT_hoursTotal" value="'.$row["OJT_hoursTotal"].'" step="0.1" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="OJT_hoursRemaining">Hours Remaining</label><br>
                                    <input type="number" class="form-control" name="OJT_hoursRemaining" value="'.$row["OJT_hoursRemaining"].'" step="0.1" onkeypress="return isDecimal(event)" required/><br><br>
                                    <label for="OJT_allowanceDaily">Allowance daily</label><br>
                                    <input type="number" class="form-control" name="OJT_allowanceDaily" value="'.$row["OJT_allowanceDaily"].'" step="0.01" onkeypress="return isDecimal(event)" required/><br><br>
                                  </div>
                                </div> <!-- end of row --> 
                              </div> <!-- end of modal-body -->
                              <div class="modal-footer">
                                <input type="submit" class="btn btn-success confirmSubmit" value="Update"/>
                              </div>
                            </div> <!-- end of modal-content -->
                          </form>

                        </div>
                      </div>
                      <button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                ';
	          	}
	        }
			//header("location: employeeList.php");
		}else{
			echo "result update error";
		}
	}else{
		echo "isset error";
	}
?>