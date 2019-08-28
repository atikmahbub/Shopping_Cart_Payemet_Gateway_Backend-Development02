<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Backend Test</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178"  method="post">
					<span class="login100-form-title">
						Sign Up
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Please enter address" style="margin-top: 15px">
						<input class="input100" type="text" name="address" placeholder="Address">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Please enter email" style="margin-top: 15px">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn" style="margin-top: 15px">
						<input type="submit" class="login100-form-btn"  name="submit" value="Sign UP">
					</div>

					<div class="flex-col-c p-t-60 p-b-40" >
						<span class="txt1 p-b-9">
							Already have an Account?
						</span>

						<a href="../index.php" class="txt3">
							Sign In now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


<?php

	include"db.php";
	
	if(isset($_POST['submit'])) { 
	
		$name = $_POST['username'];
		$password = $_POST['pass'];
		$address = $_POST['address'];
		$email = $_POST['email'];


		$_SESSION['username'] = $name;


		

 	   $sqls = "SELECT * FROM signup WHERE email='$email'" ;

       $result = mysqli_query($conn,$sqls ) ;
       if( mysqli_num_rows( $result ) > 0 )
       {
       
       $flag = 1;
       echo "<script type='text/javascript'>alert('Email Already Exists.Try Again');
		window.location='signUp.php';
				</script>";
       }
       if($flag != 1){

		$sql = "INSERT INTO signup (userName,password,address,email) VALUES ('$name','$password','$address','$email')";

	if ($conn->query($sql) === TRUE) {

		 echo "<script type='text/javascript'>
			  window.location='dashboard.php';
					</script>";
	       }

	 else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}
	}
?>

	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../vendor/animsition/js/animsition.min.js"></script>
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/select2/select2.min.js"></script>
	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
	<script src="../vendor/countdowntime/countdowntime.js"></script>
	<script src="../js/main.js"></script>

</body>
</html>