<?php
    session_start();
    if ($_SESSION['email']==null or $_SESSION['email']=='guest') {
      echo "Permission denied. Please sign in to webcoursera first.";
      return;
    }
?>



<?php

$conn = mysqli_connect('localhost', 'root', '', 'webcoursera');

if (!$conn) {
    echo 'Connection error' . mysqli_connect_error();
}

$sql = "SELECT * FROM student"; 

// if(isset($_POST['search'])) {

//     $search_term = $connect -> real_escape_string($_POST['search_box']);
//     $sql .= "WHERE person_id = '{$search_term}'";
// }

$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
//
//$sql = mysqli_query($connect,"SELECT * FROM student WHERE rollno = '$search_term'");
echo ' Displayed ';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Web Coursera</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>



  <script src="webp.js"></script>
  <form action="courses.php" method="GET" id="formForCategoryId">
      <input type="hidden" name="categoryId" id = "formFieldForCategoryId" />
  </form>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">Web Coursera</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="index.php">All Courses</a></li>
          <li><a href="myindex.php">My Courses</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="index.php#features">Categories</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>

          <form action="search.php" class="form-inline" method="post">
            <input type="text" name="search" placeholder="Search">
            <input type="submit" class="btn btn-secondary" style="background-color: #5fcf80; margin-top: 0px;" name="submit" value="Search">
          </form>
          <li><a href="">Hello,
            <?php echo $_SESSION['email']?>
          </a></li>
          <!-- <li><a href="#">Setting</a></li> -->

          <?php if($_SESSION['email']!='guest') : ?>
            <li><a href="./signin.php?logout=true">Logout</a></li>
          <?php endif; ?>


          <!-- <li><a href="http://localhost/Main%20Page/main login.php?logout=true">Logout</a></li> -->

          <?php if($_SESSION['email']=='guest') : ?>
            <li><a href="signin.php">Sign In</a></li>
          <?php endif; ?>
        <i class="bi bi-list mobile-nav-toggle"></i>


      </nav><!-- .navbar -->

      <?php if($_SESSION['email']=='guest') : ?>
        <a href="signin.php" class="get-started-btn">Register</a>
      <?php endif; ?>
      <!-- <a href="signin.php" class="get-started-btn">Register</a> -->

    </div>
  </header><!-- End Header -->


      <!-- ======= Breadcrumbs ======= -->
      <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Users</h2>
        </div>
    </div><!-- End Breadcrumbs -->

  <br><br><br>  

  <main id="main">
<div class="col-lg-9 " style="margin: auto;">
  <table width='70%' cellpadding='5' cellspace='5' class="table table-striped">


        <tr>
            <td style="text-align:center"><strong>Name</strong></td>
            <td style="text-align:center"><strong>Institute</strong></td>

        </tr>
        <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td style="text-align:center"><?php echo $row['name']; ?></td>
            <td style="text-align:center"><?php echo $row['Institute']; ?></td>
        </tr>


    <?php } ?>
    </table>
</div>




    <br><br><br><br>


  </main><!-- End #main -->

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
              <li><i class="bx bx-chevron-right"></i> <a href="signin.php">Sign In</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="signin.php">Register</a></li>
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


