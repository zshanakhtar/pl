<?php
include 'functions.php';
//include 'f_registration_validate.php';

session_start();
$error_main='Headline Insertion Failed';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $data=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    // extract($data);//get all post parameters
    //print_r($data);
    //$error_desc=validate($data);
    // if($error_desc!='success')
    // errordisplay($error_main,$error_desc);

    //errordisplay($error_main,'Insertion disabled.');//Enable this when closing insertion during development
    if(insertintodb('editorial',$data))
        successdisplay('Inserted Successfully','Headline successfully inserted into editorials');
    else
        errordisplay($error_main,'Server Error, please try again later.');

}
else{
	header("Location:../index.php");
}
?>