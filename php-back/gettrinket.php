<?php
include 'connection.php'; //connect the connection page
  
session_start();

if ($_SERVER['REQUEST_METHOD']=='POST'){
$usertype='n';
extract($_POST);
extract($_SESSION);
// echo $usertype;
// echo $username;
//echo $approvet;

reset($_POST);
$first_key = key($_POST);

include "../php-front/".$usertype.'/'.$first_key.'.php';

}
else{
	header("location: ../index.php");
}

?>