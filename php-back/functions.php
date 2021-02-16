<?php
function realescape($arr){
    include "../php-back/".'connection.php';
    foreach($arr as $x => $x_value)
        $arr[$x]=mysqli_real_escape_string($conn, $x_value);
    return $arr;
}
function insertintodb($table,$data){
    include "../php-back/".'connection.php';
    $keys=implode(",", array_keys($data) );
    $values=implode("','", array_values($data) );
    $FILLteam="INSERT INTO $table ($keys) values ('$values')";
    // echo $FILLteam;
    if($conn->query($FILLteam))
        return true;
    else
        return false;
}
function errordisplay($error_main,$error_desc){
    echo '<div class="alert alert-danger"><strong>'.$error_main.'!</strong> '.$error_desc.'</div>';
}
function inputvalidate($mode,$data){
    $flag=0;
    if($mode=='max-length')
    {
        foreach($data as $x => $x_value)
            if(strlen($x)>$x_value)
            {
                $flag=1;
                break;
            }
    }
    else if($mode=='exact-length')
    {
        foreach($data as $x => $x_value)
            if(strlen($x)!=$x_value)
            {
                $flag=1;
                break;
            }
    }
    else if($mode=='min-length')
    {
        foreach($data as $x => $x_value)
            if(strlen($x)<$x_value)
            {
                $flag=1;
                break;
            }
    }
    return $flag==0?true:false;
}
function generateaccesscode($access){
    $bytes = random_bytes(3);
    $code=bin2hex($bytes);
    return $access.$code;
}

?>
