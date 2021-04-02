<?php
include "../php-back/".'connection.php'; //connect the connection page
include 'functions.php';

session_start();
$error_main="Game Creation Failed";
if ($_SERVER['REQUEST_METHOD']=='POST'){
	
    extract($_POST);

    $username = mysqli_real_escape_string($conn, $username);//protection of sql injection replaces special characters with respective escape sequences
    $_SESSION['usertype']='j';
    if($gamecode!="")
    {
    	$gamecode = mysqli_real_escape_string($conn, $gamecode);
        $_SESSION['username']=$username;
    	$_SESSION['gamecode']=$gamecode;
    }
    else
    {
    	$gamecode = generategamecode();
        $_SESSION['username']=$username;
        $_SESSION['gamecode']=$gamecode;
        $_SESSION['newgame']=true;
    }
    echo '<script>window.location="jpclient.php"</script>';
    //successdisplay("Game created successfully","username:$username,gamecode:$gamecode");
}
else{
    errordisplay($error_main,'');
}

mysqli_close($conn); // Closing Connection with Database
?>