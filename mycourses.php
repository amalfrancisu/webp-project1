<?php

define('URL', 'http://localhost/webp-project1/');
session_start();
if ($_SESSION['email']==null or $_SESSION['email']=='guest') {
	echo "Permission denied. Please sign in to webcoursera first.";
	return;
}
#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

  $conn = mysqli_connect('localhost', 'root', '', 'webcoursera');

		if (!$conn) {
			echo 'Connection error'.mysqli_connect_error();
		}

    class webpCourses {
      public $count=6 ;
   }

    class webpCoursesInACategory {
      public $categoryName = "";
    }

		class webpCoursesInAType{
      public $count = 0;
    }

		class webpCourseDetails {
			public $courseId = "";
			public $categoryId = "";
			public $courseType = "";
			public $courseName = "";
			public $courseDuration = "";
			public $courseDescription = "";
			public $courseLink = "";
			public $trainerName = "";
			public $users = "89";
			public $hearts = "56";
			public $courseImg = "";
			public $trainerImg = "";
			public $studyMaterials = "";
			public $enrolled = "YES";
		}

    $obj = new webpCourses();
		$categoryLookup = array("HTML", "CSS", "JAVASCRIPT", "JAVA", "AJAX", "PYTHON");
		for ($i=1; $i<=6; $i++) {
			$obj->{"$i"} = new webpCoursesInACategory();
			$obj->{"$i"}->categoryName = $categoryLookup[$i-1];
			$obj->{"$i"}->{"Full Courses"} = new webpCoursesInAType();
			$obj->{"$i"}->{"Short Courses"} = new webpCoursesInAType();
			$obj->{"$i"}->{"Mini Courses"} = new webpCoursesInAType();
		}

		$studentEmail = $_SESSION['email'];
    $sql="SELECT * FROM `student-course` WHERE email='$studentEmail'";
    $result = mysqli_query($conn, $sql);
    if (!$result) { echo mysqli_error($conn); }

    while($row = $result->fetch_assoc()) {
      $courseid = $row['courseid'];
			$sql2="SELECT * FROM course WHERE courseid=$courseid";
			$result2 = mysqli_query($conn, $sql2);
			if (!$result2) { echo mysqli_error($conn); }

			while($row2 = $result2->fetch_assoc()) {
				$ccount = $obj->{$row2['categoryid']}->{$row2['coursetype']}->count;
				$ccount = $ccount + 1;
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->count = $ccount;
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"} = new webpCourseDetails();
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->courseId = $row2['courseid'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->categoryId = $row2['categoryid'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->courseType = $row2['coursetype'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->courseName = $row2['cname'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->courseDuration = $row2['duration'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->courseDescription = $row2['description'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->courseLink = $row2['link'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->trainerName = $row2['trainername'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->courseImg = $row2['courseimg'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->trainerImg = $row2['trainerimg'];
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->studyMaterials = $row2['studymaterials'];
				$sql4 = "SELECT * FROM `student-course` WHERE courseid='$courseid'";
				$result4 = mysqli_query($conn, $sql4);
				if (!$result4) { echo mysqli_error($conn); }
				$obj->{$row2['categoryid']}->{$row2['coursetype']}->{"$ccount"}->users = mysqli_num_rows($result4);
			}
    }
    $myJSON = json_encode($obj);
		$_SESSION['json_output'] = $myJSON;
		#setcookie("json_output", $myJSON, time() + (86400 * 30), "/");
    #$output=mysqli_fetch_all($sql1,MYSQLI_ASSOC);
    #var_dump($output[0]['password']);
		#echo "Returned rows are: " . mysqli_num_rows($result);
		#echo nl2br("obj given initial values\n");
		#var_dump($obj);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Courses</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v4.3.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Web Coursera</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
					<li><a href="index.php">All Courses</a></li>
          <li><a href="myindex.php">My Courses</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="index.html#features">Categories</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
          <li><input type="text" name="search" placeholder="Search "></li>
          <li><a href="signin.html">Sign In</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="signin.html" class="get-started-btn">Register</a>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <div id="categoryNameAfterThis"></div>

      </div>
    </div><!-- End Breadcrumbs -->



    <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-4 col-lg-4"> </div>
          <div class="col-lg-6 col-lg-6">

            <br>
            <input type="checkbox" id="webpCheckboxForFullCourses" checked>
            <label for="webpCheckboxForFullCourses">Full Courses</label>
            &nbsp;&nbsp;
            <input type="checkbox" id="webpCheckboxForShortCourses" checked>
            <label for="webpCheckboxForShortCourses">Short Courses</label>
            &nbsp;&nbsp;
            <input type="checkbox" id="webpCheckboxForMiniCourses" checked>
            <label for="webpCheckboxForMiniCourses">Mini Courses</label>
            &nbsp;
            <button class="get-started-btn" onclick="webpApplyFilter()">Apply</button>

          </div>
        </div>
    </div>




    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div id="webpGeneratedHtmlCode"></div>

      </div>
    </section><!-- End Courses Section -->

  </main><!-- End #main -->

	<form action="enrollment.php" method="POST" id="EformEnrollment">
      <input type="hidden" name="courseId" id = "EformFieldForCourseId" />
			<input type="hidden" name="type" id = "EformFieldForType" />
  </form>

  <script src="webp.js"></script>
  <script>
	 	var webpCourses = <?php echo $_SESSION['json_output']?>;
    webpApplyFilter();
    //webpFillCoursePage(true,true,true);
  </script>


  <!-- ======= Footer ======= -->
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Web Coursera</h3>
            <p>
              NIT Calicut <br>
              Calicut, Kerala<br>
              India <br><br>
              <strong>Phone:</strong> 9898984989<br>
              <strong>Email:</strong> webcoursera@nitc.ac.in<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="about.html">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.html#features">Categories</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="signin.html">Sign In</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="signin.html">Register</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>More About Us</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="terms-and-conditions.html">Terms</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="privacy-policy.html">Privacy Policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="help-and-support.html">Help and Support</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="about.html">About Us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="contact.html">Contact Us</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Type in your email id to be informed about the upcoming courses</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>WebCoursera</span></strong>. All Rights Reserved
        </div>

      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://twitter.com/nitcofficial" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://www.facebook.com/nitcofficial.india" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/nitcofficial/" class="instagram"><i class="bx bxl-instagram"></i></a>
        <!-- <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



</body>

</html>
