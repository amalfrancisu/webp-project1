<?php
    session_start();
    if ($_SESSION['email']==null or $_SESSION['email']=='guest') {
      echo "Permission denied. Please sign in to webcoursera first.";
      return;
    }

    $email = $_SESSION['email'];
    $courseId = $_POST['courseId'];
    $type = $_POST['type'];

    $conn = mysqli_connect('localhost', 'root', '', 'webcoursera1');
		if (!$conn) {
			echo 'Connection error'.mysqli_connect_error();
		}

    if($type==1) {
      $sql="SELECT * FROM `student-course` WHERE email='$email' AND courseid='$courseId'";
      $result = mysqli_query($conn, $sql);
      if (!$result) { echo mysqli_error($conn); }
      if(mysqli_num_rows($result) > 0) {
        echo "You seem to be already enrolled to this course. Please contact Help and Support if you face any issues.";
        return;
      }
      $sql= "INSERT INTO `student-course` (email,courseid) VALUES ('$email',$courseId)";
      $result = mysqli_query($conn, $sql);
      if (!$result) { echo mysqli_error($conn); }
      echo "You have successfully enrolled to this course. Go to ";
      echo "<a href='myindex.php'>My Courses</a> to see all the enrolled courses.";
    }

    else {
      $sql="SELECT * FROM `student-course` WHERE email='$email' AND courseid='$courseId'";
      $result = mysqli_query($conn, $sql);
      if (!$result) { echo mysqli_error($conn); }
      if(mysqli_num_rows($result) == 0) {
        echo "You don't seem to have enrolled to this course. Please contact Help and Support if you face any issues.";
        return;
      }
      $sql= "DELETE FROM `student-course` WHERE email='$email' AND courseid='$courseId'";
      $result = mysqli_query($conn, $sql);
      if (!$result) { echo mysqli_error($conn); }
      echo "You have been successfully un-enrolled from this course. Go to ";
      echo "<a href='myindex.php'>My Courses</a> to see all the enrolled courses.";
    }
?>
