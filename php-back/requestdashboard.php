<?php
include "../php-back/".'connection.php'; //connect the connection page
include 'functions.php';

session_start();
$error_main="Login Failed";
if ($_SERVER['REQUEST_METHOD']=='POST'){
	
extract($_POST);

$l_username = mysqli_real_escape_string($conn, $username);
$l_password = mysqli_real_escape_string($conn, $pass);


$resultsum=mysqli_query($conn,"SELECT userstatus,usertype,pass FROM regist WHERE username='$l_username'");
	if($row = $resultsum->fetch_assoc())
	{
			extract($row);
			// echo $l_password;
			// echo $pass;
			if($userstatus=='f')
			{
				errordisplay($error_main,'Account not activated, contact administrator.');
			}
			else if($userstatus=='t' && password_verify($l_password,$pass))
			{
				$_SESSION['usertype']=$usertype;
				$_SESSION['username']=$l_username;
				echo '<script>window.location="dashboard.php"</script>';
			}
			else
			{
				errordisplay($error_main,'Either username or Password incorrect.');
			}
			// header("Location:dashboard.php");
	}		
	else
	{
        errordisplay($error_main,'Either username or Password incorrect.');
	}
	

mysqli_close($conn); // Closing Connection with Server
}
else{
	echo '<script>window.location="index.php"</script>';
}

?>