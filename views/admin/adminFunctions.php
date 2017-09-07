<?php 
	function displayWorkStatusSelect($row) {
		echo '
		    <div class="form-group">
		      <label for="workStatus">Work status</label><br>
		      <select id="update_workStatus'.$row["id"].'" class="form-control" name="workStatus" onchange="updateCheckOJT('.$row["id"].')" required>
		      '; 
		        if($row["workStatus"] == "OJT") {
		          echo '
		            <option value="OJT" selected>OJT</option>
		            <option value="Trainee">Trainee</option>
		            <option value="Probationary">Probationary</option>
		            <option value="Regular">Regular</option>
		          ';
		        }else if($row["workStatus"] == "Trainee"){
		          echo '
		            <option value="OJT">OJT</option>
		            <option value="Trainee" selected>Trainee</option>
		            <option value="Probationary">Probationary</option>
		            <option value="Regular">Regular</option>
		          ';
		        }else if($row["workStatus"] == "Probationary"){
		          echo '
		            <option value="OJT" selected>OJT</option>
		            <option value="Trainee">Trainee</option>
		            <option value="Probationary" selected>Probationary</option>
		            <option value="Regular">Regular</option>
		          ';
		        }else if($row["workStatus"] == "Regular"){
		          echo '
		            <option value="OJT" selected>OJT</option>
		            <option value="Trainee">Trainee</option>
		            <option value="Probationary">Probationary</option>
		            <option value="Regular" selected>Regular</option>
		          ';
		        }else{
		          echo '
		            <option value="" disabled selected>Select employee status</option>
		            <option value="OJT">OJT</option>
		            <option value="Trainee">Trainee</option>
		            <option value="Probationary">Probationary</option>
		            <option value="Regular">Regular</option>
		          ';
		        }
	        echo '
	          </select>
	        </div>';
	}

	function displayJobTitleSelect($row) {
	    echo '
	    <div class="form-group">
	      <label for="jobTitle">Job Title</label>
	      <select id="jobTitle'.$row["id"].'" class="form-control" name="jobTitle" required style="width: 100%;">';

	      if($row['jobTitle'] == 'Editor') {
	        echo '<option value="Editor" selected>Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'Writer') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" selected>Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'Marketing Specialist') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" selected>Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'Trackimo Customer Support') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" selected>Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'Social Media Specialist') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" selected>Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'Multimedia Specialist') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" selected>Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'Data Processor') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" selected>Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'SEO Specialist') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" selected>SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'Wordpress Developer') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" selected>Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'Content Marketing Assistant') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" selected>Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'OJT Web Development') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" selected>OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'OJT SEO') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" selected>OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'OJT System Developer') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" selected>OJT System Developer</option>
	        <option value="OJT Researcher" >OJT Researcher</option>';
	      }
	      if($row['jobTitle'] == 'OJT Researcher') {
	        echo '<option value="Editor" >Editor</option>
	        <option value="Writer" >Writer</option>
	        <option value="Marketing Specialist" >Marketing Specialist</option>
	        <option value="Trackimo Customer Support" >Trackimo Customer Support</option>
	        <option value="Social Media Specialist" >Social Media Specialist</option>
	        <option value="Multimedia Specialist" >Multimedia Specialist</option>
	        <option value="Data Processor" >Data Processor</option>
	        <option value="SEO Specialist" >SEO Specialist</option>
	        <option value="Wordpress Developer" >Wordpress Developer</option>
	        <option value="Content Marketing Assistant" >Content Marketing Assistant</option>
	        <option value="OJT Web Development" >OJT Web Development</option>
	        <option value="OJT SEO" >OJT SEO</option>
	        <option value="OJT System Developer" >OJT System Developer</option>
	        <option value="OJT Researcher" selected>OJT Researcher</option>';
	      }
	      echo '
	        </select>
	      </div>';
	}
?>