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
            $editor = '<li id="taskTracker">
                        <a href="../editor/editorTest.php">
                          <i class="fa fa-tasks"></i>
                          <span>Daily Task Tracker</span>
                        </a>
                      </li>';
            $writer = '<li id="taskTracker">
                        <a href="../writer/writerTest.php">
                          <i class="fa fa-tasks"></i> 
                          <span>Daily Task Tracker</span>
                        </a>
                      </li>';
            $trackimo_cs = '<li id="taskTracker">
                              <a href="../trackimo_cs/trackimoCSTest.php">
                                <i class="fa fa-tasks"></i> 
                                <span>Daily Task Tracker</span>
                              </a>
                            </li>';
            $soc_med = '<li id="taskTracker">
                          <a href="../soc_med/socialMediaTest.php">
                            <i class="fa fa-tasks"></i> 
                            <span>Daily Task Tracker</span>
                          </a><
                        /li>';
            $multimedia = '<li id="taskTracker">
                            <a href="../multimedia/multimediaTest.php">
                              <i class="fa fa-tasks"></i> 
                              <span>Daily Task Tracker</span>
                            </a>
                          </li>';
            $data_proc = '<li id="taskTracker">
                            <a href="../data_processor/dataprocessorTest.php">
                              <i class="fa fa-tasks"></i> 
                              <span>Daily Task Tracker</span>
                            </a>
                          </li>';
            $seo_spc = '<li id="taskTracker">
                          <a href="../seo_spc/seoSpecialistTest.php">
                            <i class="fa fa-tasks"></i> 
                            <span>Daily Task Tracker</span>
                          </a>
                        </li>';
            $wp_dev = '<li id="taskTracker">
                        <a href="../wp_dev/wordpressDeveloperTest.php">
                          <i class="fa fa-tasks"></i> 
                          <span>Daily Task Tracker</span>
                        </a>
                      </li>';
            $cont_mktg = '<li id="taskTracker">
                            <a href="../cont_mktg/contentmarketingTest.php">
                              <i class="fa fa-tasks"></i> 
                              <span>Daily Task Tracker</span>
                            </a>
                          </li>';
            $ojt_web = '<li id="taskTracker">
                          <a href="../ojt_web_dev/ojtWeb.php">
                            <i class="fa fa-tasks"></i> 
                            <span>Daily Task Tracker</span>
                          </a>
                        </li>';
            $ojt_seo = '<li id="taskTracker">
                          <a href="../ojt_seo/ojtSeo.php">
                            <i class="fa fa-tasks"></i> 
                            <span>Daily Task Tracker</span>
                          </a>
                        </li>';
            $ojt_sys_dev = '<li id="taskTracker">
                              <a href="../ojt_sys_dev/ojtSystemDeveloper.php">
                                <i class="fa fa-tasks"></i> 
                                <span>Daily Task Tracker</span>
                              </a>
                            </li>';
            $ojt_research = '<li id="taskTracker">
                              <a href="../ojt_research/ojtResearch.php">
                                <i class="fa fa-tasks"></i> 
                                <span>Daily Task Tracker</span>
                              </a>
                            </li>';

            if (isset($_SESSION['user_id']) && isset($_SESSION['jobTitle'])) {
              switch ($_SESSION['jobTitle']) {
                case "Editor":
                  echo $editor;
                  break;
                case "Writer":
                  echo $writer;
                  break;
                case "Trackimo Customer Support":
                  echo $trackimo_cs;
                  break;
                case "Social Media Specialist":
                  echo $soc_med;
                  break;
                case "Multimedia Specialist":
                  echo $multimedia;
                  break;
                case "Data Processor":
                  echo $data_proc;
                  break;
                case "SEO Specialist":
                  echo $seo_spc;
                  break;
                case "Wordpress Developer":
                  echo $wp_dev;
                  break;
                case "Content Marketing Assistant":
                  echo $cont_mktg;
                  break;
                case "OJT Web Development":
                  echo $ojt_web;
                  break;
                case "OJT SEO":
                  echo $ojt_seo;
                  break;
                case "OJT System Developer":
                  echo $ojt_sys_dev;
                  break;
                case "OJT Researcher":
                  echo $ojt_research;
                  break;

              }
              if (isAdmin($_SESSION['user_id'])) {
                echo '<li class="header">Administrator</li>';
                echo '<li id="employeeList"><a href="../admin/employeeList.php"><i class="fa fa-th-list"></i> <span>Employee List</span></a></li>';
                echo '<li class="treeview">
                        <a href="#"><i class="fa fa-money"></i> <span>Finance Reports</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                        <ul class="treeview-menu">
                          <li><a href="../reports/salaryReports.php">Salary Report</a></li>
                          <li><a href="../reports/weeklyReports.php">Weekly</a></li>
                          <li><a href="../reports/monthlyReports.php">Monthly</a></li>
                          <li><a href="../reports/yearlyReports.php">Yearly</a></li>
                        </ul>
                      </li>';
                echo '<li class="treeview">
                        <a href="#"><i class="fa fa-tasks"></i> <span>Task Reports</span>
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
                echo '<li id="announcements"><a href="../admin/announcements.php"><i class="fa fa-sticky-note"></i><span>Announcements</span></a></li>';
              }
            }
          ?>

          <!-- Optionally, you can add icons to the links -->
          <li class="header">Tasks</li>
          <li class="treeview">
            <a href="#"><i class="fa fa-tasks"></i> <span>Task Testing</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="../writer/writerTest.php"><i class="fa fa-tasks"></i> <span>writerTest</span></a></li>
              <li><a href="../editor/editorTest.php"><i class="fa fa-tasks"></i> <span>editorTest</span></a></li>
              <li><a href="../wp_dev/wordpressDeveloperTest.php"><i class="fa fa-tasks"></i> <span>wordpressDeveloperTest</span></a></li>
              <li><a href="../trackimo_cs/trackimoCSTest.php"><i class="fa fa-tasks"></i> <span>trackimoCSTest</span></a></li>
              <li><a href="../soc_med/socialMediaTest.php"><i class="fa fa-tasks"></i> <span>socialMediaTest</span></a></li>
              <li><a href="../seo_spc/seoSpecialistTest.php"><i class="fa fa-tasks"></i> <span>seoSpecialistTest</span></a></li>
              <li><a href="../multimedia/multimediaTest.php"><i class="fa fa-tasks"></i> <span>multimediaTest</span></a></li>
              <li><a href="../mktg_spc/marketingSpecialistTest.php"><i class="fa fa-tasks"></i> <span>marketingSpecialistTest</span></a></li>
              <li><a href="../data_processor/dataprocessorTest.php"><i class="fa fa-tasks"></i> <span>dataprocessorTest</span></a></li>
              <li><a href="../cont_mktg/contentmarketingTest.php"><i class="fa fa-tasks"></i> <span>contentmarketingTest</span></a></li>
              <li><a href="../ojt_research/ojtResearch.php"><i class="fa fa-tasks"></i> <span>ojtResearch</span></a></li>
              <li><a href="../ojt_seo/ojtSeo.php"><i class="fa fa-tasks"></i> <span>ojtSeo</span></a></li>
              <li><a href="../ojt_sys_dev/ojtSystemDeveloper.php"><i class="fa fa-tasks"></i> <span>ojtSystemDeveloper</span></a></li>
              <li><a href="../ojt_web_dev/ojtWeb.php"><i class="fa fa-tasks"></i> <span>ojtWeb</span></a></li>
            </ul>
          </li>

        </ul>


        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>
