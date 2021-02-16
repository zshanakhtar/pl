<?php
include 'functions.php';

session_start();
$error_main='Headline Insertion Failed';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $data=realescape($_POST);//escape single and double quotes using mysqli_real_escape

    //errordisplay($error_main,'Insertion disabled.');//Enable this when closing insertion during development
    
    extract($_SESSION);
    if($usertype=='e')
        $table='editorial';
    else if($usertype=='t')
        $table='technology';
    else if($usertype=='s')
        $table='followsports';
    else if($usertype=='f')
        $table='trailer';
    
    if(insertintodb($table,$data))
        successdisplay('Inserted Successfully','Headline successfully inserted into editorials');
    else
        errordisplay($error_main,'Server Error, please try again later.');

}
else{
	header("Location:../index.php");
}
?>