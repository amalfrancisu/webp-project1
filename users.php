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
            <li><input type="text" name="search" placeholder="Search"></li>
            <li><input type="submit" class="btn btn-primary" style="background-color: black; margin-top: 3px;" name="submit" value="Search"></li>
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

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>“Wisdom is not a product of schooling but of the lifelong attempt to acquire it.”<br> – Albert Einstein</h1>
      <a href="index.php#features" class="btn-get-started">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="625412" data-purecounter-duration="1" class="purecounter"></span>
            <p>Students</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1" class="purecounter"></span>
            <p>Courses</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="6" data-purecounter-duration="1" class="purecounter"></span>
            <p>Categories</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="9" data-purecounter-duration="1" class="purecounter"></span>
            <p>Trainers</p>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <br><br><br><br>
    <!-- ======= Categories Section ======= -->
    <section id="features" class="features">
      <div class="container" data-aos="fade-up">
        <h2> </h1>
          <div class="section-title">
            <p>Categories</p>
          </div>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-3 col-md-4" onclick="webpRedirectToCoursePage(1)">
            <div class="icon-box">
              <i class="ri-store-line" style="color: #ffbb2c;"></i>
              <h3><a>HTML</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0" onclick="webpRedirectToCoursePage(2)">
            <div class="icon-box">
              <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
              <h3><a>CSS</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0" onclick="webpRedirectToCoursePage(3)">
            <div class="icon-box">
              <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
              <h3><a>JAVASCRIPT</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0" onclick="webpRedirectToCoursePage(4)">
            <div class="icon-box">
              <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
              <h3><a>JAVA</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4" onclick="webpRedirectToCoursePage(5)">
            <div class="icon-box">
              <i class="ri-database-2-line" style="color: #47aeff;"></i>
              <h3><a>AJAX</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4" onclick="webpRedirectToCoursePage(6)">
            <div class="icon-box">
              <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
              <h3><a>PYTHON</a></h3>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Categories Section -->


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
              <li><i class="bx bx-chevron-right"></i> <a href="about.php">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php#features">Categories</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="signin.php">Sign In</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="signin.php">Register</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>More About Us</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="terms-and-conditions.php">Terms</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="privacy-policy.php">Privacy Policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="help-and-support.php">Help and Support</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="about.php">About Us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="contact.php">Contact Us</a></li>
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


<table width='70%' cellpadding='5' cellspace='5'>


<tr>
    <td><strong>Email</strong></td>
    <td><strong>Name</strong></td>

</tr>
<?php while ($row = mysqli_fetch_array($query)) { ?>
<tr>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['name']; ?></td>
</tr>


<?php } ?>
</table>

<?php
    header("refresh:10; url=index.php");
?>