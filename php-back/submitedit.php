<?php
include 'functions.php';

session_start();
$error_main='Headline Edit Failed';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $data=realescape($_POST);//escape single and double quotes using mysqli_real_escape
    $sno=$data['sno'];
    unset($data['sno']);
    //var_dump($data);
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
    else if($usertype=='a')
        $table='regist';
    
    if(updatedb($table,$data,$sno))
        successdisplay('Updated Successfully','Data successfully updated in '.$table);
    else
        errordisplay($error_main,'Server Error, please try again later.');

}
else{
	header("Location:../index.php");
}
?>