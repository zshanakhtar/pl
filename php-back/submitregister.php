<?php
include 'functions.php';
include 'f_registration_validate.php';

session_start();
$error_main='Registration Failed';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $_POST=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    extract($_POST);//get all post parameters
    $error_desc=validate($_POST);
    if($error_desc!='success')
        errordisplay($error_main,$error_desc);
    else{
        $hashandsalt = password_hash($pass, PASSWORD_BCRYPT);//hash password
        // echo $hashandsalt;
        if($_SESSION['usertype']=='a')
            $data=array('username'=>$username,'pass'=>$hashandsalt,'usertype'=>$usertype,'userstatus'=>'t');
        else
            $data=array('username'=>$username,'pass'=>$hashandsalt,'usertype'=>$usertype);
        //errordisplay($error_main,'Registration disabled.');//Enable this to close registration during development
        if(insertintodb('regist',$data))
            successdisplay('Registration Done Successfully','You have been successfully registered please contact administrator to activate account.');
        else
            errordisplay($error_main,'Server Error, please try again later.');
    }
    
    //if( password_verify($pass, $hashandsalt) )
    //echo '<br>success<br>';
}
else{
	header("Location:../index.php");
}
?>