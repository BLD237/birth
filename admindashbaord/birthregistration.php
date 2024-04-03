<?php
// include 'class.php';
// $general = new general();

if(!session_start()){
  session_start();
}
if($_SESSION['bcglevel']==1){

}else if($_SESSION['bcglevel']==2){
  include "user.php";
}else{
  header("LOCATION:  /birth/index.php?reference=notlogin");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BCG-admin-Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">BCG-SYSTEM</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn">.</i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>           
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['bcgusername'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['bcgusername'] ?></h6>
              <span><?php echo $_SESSION['bcgemail']?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="admin.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

      <!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Birth certificate App..</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="newapplications.php">
              <i class="bi bi-circle"></i><span>New Applications</span>
            </a>
          </li>
          <li>
            <a href="rejected.php">
              <i class="bi bi-circle"></i><span>Verified Applications</span>
            </a>
          </li>
          <li>
            <a href="rejected.php">
              <i class="bi bi-circle"></i><span>Rejected Applications</span>
            </a>
          </li>
          <li>
            <a href="allapplications.php">
              <i class="bi bi-circle"></i><span>All Applications</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Manage Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="register.php">
              <i class="bi bi-circle"></i><span>Create User</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>Manage Admin users</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>Manage users</span>
            </a>
          </li>
          <li>
            <a href="registral.php">
              <i class="bi bi-circle"></i><span>Add registral</span>
            </a>
          </li>
          
        </ul>

      </li><!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Search</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->   

      <li class="nav-item">
        <a class="nav-link collapsed" href="/birthregistration/index.php">
          <i class="bi bi-card-list"></i>
          <span>Issue birth certificate</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-in-left"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-gear"></i>
          <span>Settings</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/birth/index.php">
          <i class="bi bi-file-earmark"></i>
          <span>Home</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="container">
    <div class="row">
    <form id="data-collection-form" action="/birth/action.php" method="post">
        <div class="box">
        <div class="col">       
      <h2>Applicant Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Applicant name</label>
      <input  class="form-control input-sm" type="text" name="applicantname" id="child-age" required>

      <label for="child-school">Applicant contact</label>
      <input  class="form-control input-sm"  type="text" name="applicantcontact" id="child-school" required>
      <label for="child-age">Applicant id-number</label>
      <input  class="form-control input-sm" type="text" name="applicantidnumber" id="child-age" required>
      </div>
      </div>
            <hr>
    <div class="col">       
      <h2>Child's Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Child's First Name</label>
      <input  class="form-control input-sm" type="text" name="fname" id="child-age" required>

      <label for="child-school">Child's Last Name</label>
      <input  class="form-control input-sm"  type="text" name="lname" id="child-school" required>

      <label for="child-hobbies">Child's Date Of Birth</label>
      <input  class="form-control input-sm" type="date" name="childdob" id="child-hobbies" required>

      <label for="child-hobbies">Child's Date Of Birth</label>
      <select name="gender" id="" class="form-control input-sm" > 
        <option value="male">Male</option>
        <option value="male">female</option>
    </select>

      <label for="child-age">Child's Place of Birth</label>
      <input  class="form-control input-sm" type="text" name="placeofbirth" id="child-age" required>

      <label for="child-school">Child's wieght:</label>
      <input  class="form-control input-sm"  type="number" name="wieght" id="child-school" required>

      <label for="child-hobbies">Child's height</label>
      <input  class="form-control input-sm" type="number" name="hieght" id="child-hobbies" required>
      </div>
      </div>
      <hr>
      <!-- next info -->
      <div class="col">       
      <h2>Father's Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Father's name</label>
      <input  class="form-control input-sm" name="fathername" type="text" id="child-age" required>

      <label for="child-school">Father's address</label>
      <input  class="form-control input-sm" name="fatheraddress" type="text" id="child-school" required>

      <label for="child-hobbies">Father's place of birth</label>
      <input  class="form-control input-sm" name="fatherplaceofbirth" type="text" id="child-hobbies" required>
        
      <label for="child-hobbies">father's subdivision</label>
      <input  class="form-control input-sm" name="fathersubdivision" type="text" id="child-hobbies" required>

      <label for="child-age">Father's date of birth</label>
      <input  class="form-control input-sm" name="fatherdob" type="date" id="child-age" required>

      <label for="child-school">Father's occuppation</label>
      <input  class="form-control input-sm" name="fatheroccupation" type="text" id="child-school" required>

      <label for="child-hobbies">Father's Idcard number</label>
      <input  class="form-control input-sm" name="fatherid" type="text" id="child-hobbies" required>

      <label for="child-hobbies">Father's Phone</label>
      <input  class="form-control input-sm" type="text" name="fatherphone" id="child-hobbies" required>

      <label for="child-hobbies">Father's email</label>
      <input  class="form-control input-sm" name="fatheremail" type="text" id="child-hobbies">
      </div>
      </div>
      <hr>

      <!-- next info -->
      <div class="col">       
      <h2>Mother's Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Mother's name</label>
      <input name="mothername"  class="form-control input-sm" type="text" id="child-age" required>

      <label for="child-school">Mother's address</label>
      <input name="motheraddress" class="form-control input-sm"  type="text" id="child-school" required>

      <label for="child-hobbies">Mother's place of birth</label>
      <input  name="mother_place_of_birth" class="form-control input-sm" type="text" id="child-hobbies" required>
      
      <label for="child-hobbies">Mother's subdivision</label>
      <input name="mother_subdivision" class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-age">Mother's date of birth</label>
      <input name="mother_date_of_birth" class="form-control input-sm" type="date" id="child-age" required>

      <label for="child-school">Mother's occuppation</label>
      <input name="mother_occupation"  class="form-control input-sm"  type="text" id="child-school" required>

      <label for="child-hobbies">Mother's Idcard number</label>
      <input name="mother_idcard_number" class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-hobbies">Mother's Phone</label>
      <input name="mother_phone" class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-hobbies">Mother's email</label>
      <input name="mother_email" class="form-control input-sm" type="text" id="child-hobbies">
      </div>
      </div>
      <hr>
      <!-- next info -->
      <div class="col">       
      <h2>Location Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Nationality*</label>
      <input name="nationality" class="form-control input-sm" type="text" id="child-age" required>

      <label  for="child-age">Hostpital / Health name</label>
      <input name="hospital_name"  class="form-control input-sm" type="text" id="child-age" required>    
      <label for="child-school">Region</label>
      <select name="region" id="" class="form-control input-sm" >  
      <option value="">SELECT REGION</option>            
        <option value="CENTRE">CENTRE</option>
        <option value="LITORAL">LITORAL</option>
        <option value="WEST">WEST</option>
        <option value="NORTH WES">NORTH WEST</option>
        <option value="SOUTH WEST">SOUTH WEST</option>
        <option value="EAST">EAST</option>
        <option value="SOUTH">SOUTH</option>
        <option value="NORTH">NORTH</option>
        <option value="FAR NORTH">FAR NORTH</option>
        <option value="ADAMAWA">ADAMAWA</option>
    </select>

      <label for="child-hobbies">division</label>
      <input name="division" class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-age">Town</label>
      <input name="town" class="form-control input-sm" type="text" id="child-age" required>      
      </div>
      </div>
      <hr>
      <div class="col">       
      <h2>Witness Information/Midwife</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Nationality*</label>
      <input name="witness_nationality" class="form-control input-sm" type="text" id="child-age" required>
      <label for="child-age">ID CARD*</label>

      <input name="witness_idcard"  class="form-control input-sm" type="text" id="child-age" required> 

      <label  for="child-hobbies">Midwife Name*</label>
      <input name="midwife_name"  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-age">Phone*</label>
      <input name="midwife_phone" class="form-control input-sm" type="text" id="child-age" required>      
      </div>
      </div>
      <button class="btn btn-primary" name="action" value="register" >SUBMIT</button>
      </div>
      
    </form>
    </div>
</div>



    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>BCG-SYSTEM</span></strong>. All Rights Reserved
    </div>
  
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>