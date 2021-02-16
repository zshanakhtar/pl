<?php
include '..\PHPMailer\src\PHPMailer.php';
include '..\PHPMailer\src\SMTP.php';
include '..\PHPMailer\src\Exception.php';
include 'functions.php';
include 'f_registration_validate.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$error_main='Registration Failed';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    extract($_POST);//get all post parameters
    errordisplay($error_main,validate($_POST));
    $hashandsalt = password_hash($pass, PASSWORD_BCRYPT);//hash password
    // echo $hashandsalt;
    if($access_code=='156sadgj')
    {
        $data=array('username'=>$univ_roll,'pass'=>$hashandsalt,'usertype'=>'s','access_code'=>$access_code);
        errordisplay($error_main,'Registration disabled.');//Enable this to close registration during development
        // if(insertintodb('regist',$data))
        //     sendmail('zshanakhtar@outlook.com','Registration Done Successfully','You have been successfully registered please contact administrator to activate account.');
        // else
        //     errordisplay($error_main,'Server Error, please try again later.');
    }
    else
    {
        errordisplay($error_main,'Invalid access code.');
    }
    //if( password_verify($pass, $hashandsalt) )
    //echo '<br>success<br>';
}
else{
	header("Location:../index.php");
}


?>