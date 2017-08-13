<!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src=<?php echo '"'.$_SESSION['picture'].'"'?> class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['firstName']; ?></p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- search form (Optional) -->
        <!--<form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form> -->
        <!-- /.search form -->


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header">
            <?php 
              if (isset($_SESSION['jobTitle']) && $_SESSION['jobTitle'] != null) {
                echo $_SESSION['jobTitle'];
              } else {
                echo "User";
              }
            ?>
          </li>

          <!-- Sidebar Start -->
          <li id="homeTab"><a href="../home/home.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li id="viewTimetable"><a href="../employee/viewTimetable.php"><i class="fa fa-table"></i> <span>View Timetable</span></a></li>

          <?php
          //LINK DECLARATIONS

            if (isset($_SESSION['user_id']) && isset($_SESSION['jobTitle'])) {
              switch ($_SESSION['jobTitle']) {
                case "Writer":
                  echo '<li id="taskTracker"><a href="../writer/writerTest.php"><i class="fa fa-tasks"></i> <span>Daily Task Tracker</span></a></li>';
                  break;
                case "Content Marketing Assistant":
                  echo '<li id="taskTracker"><a href="../content_marketing/contentmarketingTest.php"><i class="fa fa-tasks"></i> <span>Daily Task Tracker</span></a></li>';
                  break;
                case "OJT Web Development":
                  echo '<li id="taskTracker"><a href="../ojt_web_dev/ojtWeb.php"><i class="fa fa-tasks"></i> <span>Daily Task Tracker</span></a></li>';
                  break;
                case "OJT SEO":
                  echo '<li id="taskTracker"><a href="../ojt_seo/ojtSeo.php"><i class="fa fa-tasks"></i> <span>Daily Task Tracker</span></a></li>';
                  break;
                case "OJT System Developer":
                  echo '<li id="taskTracker"><a href="../ojt_sys_dev/ojtSystemDeveloper.php"><i class="fa fa-tasks"></i> <span>Daily Task Tracker</span></a></li>';
                  break;
                case "OJT Researcher":
                  echo '<li id="taskTracker"><a href="../ojt_research/ojtResearch.php"><i class="fa fa-tasks"></i> <span>Daily Task Tracker</span></a></li>';
                  break;

              }
              if (isAdmin($_SESSION['user_id'])) {
                echo '<li class="header">Administrator</li>';
                echo '<li><a href="../admin/employeeList.php"><i class="fa fa-th-list"></i> <span>Employee List</span></a></li>';
                echo '<li class="treeview">
                        <a href="#"><i class="fa fa-link"></i> <span>Reports</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="#">Weekly</a></li>
                          <li><a href="#">Monthly</a></li>
                          <li><a href="#">Yearly</a></li>
                        </ul>
                      </li>';
              }
            }
          ?>

          <!-- Optionally, you can add icons to the links -->
          <li class="header">Tasks</li>
          <li id="taskTracker"><a href="../writer/writerTest.php"><i class="fa fa-tasks"></i> <span>Writer</span></a></li>
          <li><a href="../content_marketing/contentmarketingTest.php"><i class="fa fa-tasks"></i> <span>contentmarketingTest</span></a></li>

          <li><a href="../ojt_research/ojtResearch.php"><i class="fa fa-tasks"></i> <span>ojtResearch</span></a></li>
          <li><a href="../ojt_seo/ojtSeo.php"><i class="fa fa-tasks"></i> <span>ojtSeo</span></a></li>
          <li><a href="../ojt_sys_dev/ojtSystemDeveloper.php"><i class="fa fa-tasks"></i> <span>ojtSystemDeveloper</span></a></li>
          <li><a href="../ojt_web_dev/ojtWeb.php"><i class="fa fa-tasks"></i> <span>ojtWeb</span></a></li>


          <li class="header">Samples</li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Link in level 2</a></li>
              <li><a href="#">Link in level 2</a></li>
            </ul>
          </li>

        </ul>


        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>
