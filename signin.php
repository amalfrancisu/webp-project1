<?php

define('URL', 'http://localhost/webp-project1/');

	session_start();

	if (strpos($_SERVER['REQUEST_URI'], 'logout') !== false) {
		session_unset();
		session_destroy();
		header('Location: '.URL.'signin.php');
	}

	$conn = mysqli_connect('localhost', 'root', '', 'webcoursera');

		if (!$conn) {
			echo 'Connection error'.mysqli_connect_error();
		}

		
	if (isset($_POST['create'])) {
		$name=mysqli_real_escape_string($conn, $_REQUEST['name']);
		$email=mysqli_real_escape_string($conn, $_REQUEST['email']);
		$password=mysqli_real_escape_string($conn, $_REQUEST['password']);
		$dob=mysqli_real_escape_string($conn, $_REQUEST['dob']);
		$institute=mysqli_real_escape_string($conn, $_REQUEST['institute']);
		$password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO student (email,password,name,dob,institute) VALUES('$email','$password','$name','$dob','$institute')";

		

		if (!(mysqli_query($conn, $sql))) {
			header('Location: '.URL.'signin.php#sign-up?id=404');
			exit();
		} else {
			$_SESSION['email']=$email;
			header('Location: '.URL.'index.php');
			exit();
		}
}

if (isset($_POST['login'])){     
    $email1=mysqli_real_escape_string($conn,$_REQUEST['email1']);
	$password1=mysqli_real_escape_string($conn,$_REQUEST['password1']);
    $sql="SELECT * FROM `student` WHERE email='$email1'";
    $sql1=mysqli_query($conn,$sql);
    $output=mysqli_fetch_all($sql1,MYSQLI_ASSOC);

    #var_dump($output[0]['password']);
	if(!($sql1)){
        echo mysqli_error($conn);
    }
	#count($output)==1 && (strcmp($output[0]['password'],$password1)==0)
	if(password_verify($password1, $output[0]['password']) )
	{
		$_SESSION['email']= $email1;
		header('Location: '.URL.'index.php');
		exit();
    }
	header('Location: '.URL.'signin.php?id=405');
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Web Coursera Sign in/up Form</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'><link rel="stylesheet" href="assets/css/signin_style.css">
</head>
<body>
<!-- partial:index.partial.html --><a href="index.php"><i class="fas fa-home" style="float: left;"></i></a>
<h2>Web Coursera Sign in/up Form</h2>


<div class="container" id="container">

	<div class="form-container sign-up-container" id="sign-up">
		<form action="#" method="post">
			<h1>Create Account</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> -->
			<!-- <span>or use your email for registration</span> -->
			<input name="name" type="text" placeholder="Name" />
			<input name="email" type="email" placeholder="Email" />
			<div id='message1'>
				<?php
				if (strpos($_SERVER['REQUEST_URI'], '404') !== false) {
					echo 'email is already taken';
				}
				?>
				<script>
					document.getElementById('message1').style.color = 'lightcoral';
				</script>
			</div>
			<input type="password" id="password" name="password" pattern="(?=.*\d).{8,}" title="Must contain at least one number and at least 8 or more characters" required />
			<input name="dob" type="date" placeholder="Date Of Birth" />
			<input name="institute" type="text" placeholder="Institute Name" />
			<button type="submit" name="create">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="#" method="POST">
			<h1>Sign in</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span> -->
			<input name="email1" type="email" placeholder="Email" />
			<input name="password1" type="password" placeholder="Password" />
			<button type="submit" name="login">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
  <script  src="assets/js/signin_script.js"></script>

</body>
</html>
