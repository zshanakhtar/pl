<?php
include 'connection.php'; //connect the connection page
  
session_start();

if ($_SERVER['REQUEST_METHOD']=='POST'){
$usertype='n';
extract($_POST);
extract($_SESSION);

include "../php-front/".$usertype.'/question.php';

}
else{
	header("location: ../index.php");
}

?>