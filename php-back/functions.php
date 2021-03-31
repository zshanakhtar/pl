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
    $conn->close();
}
function updatedb($table,$data,$sno){
    include "../php-back/".'connection.php';
    $flag_update_statement=0;
    foreach($data as $x => $x_value){
        // echo $x."\n";
        // echo $x_value."\n";
        $stmt = $conn->prepare("UPDATE $table SET $x = ? WHERE sno='$sno'");
        $stmt->bind_param("s", $x_value);
        $flag_update_statement = $stmt->execute()?$flag_update_statement+1:$flag_update_statement;
        $stmt->close();
    }
    return ($flag_update_statement==sizeof($data));
    $conn->close();
}
function deletefromdb($table,$sno){
    include "../php-back/".'connection.php';
    $query="DELETE FROM $table WHERE sno='$sno'";
    return $query;
    //if($conn->query($query))
        //return true;
    //else
        //return false;
    $conn->close();
}


function generategamecode(){
    $bytes = random_bytes(3);
    $code=bin2hex($bytes);
    return $code;
}


function errordisplay($error_main,$error_desc){
    echo '<div class="alert alert-danger"><strong>'.$error_main.'!</strong> '.$error_desc.'</div>';
}
function successdisplay($success_main,$success_desc){
    echo '<div class="alert alert-success"><strong>'.$success_main.'!</strong> '.$success_desc.'</div>';
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
?>
