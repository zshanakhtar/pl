<?php
$query="SELECT * from $table WHERE sno='$sno'";
$result=mysqli_query($conn,$query);
    if($row = $result->fetch_assoc()){
        if($table!=='trailer')
            $ques=$row['headline'];
        else
            $ques=$row['title'];
?>
    <div class="panel panel-danger">
        <div class="panel-heading text-center">
            <?php echo $ques;?>
        </div>
    </div>
<?php
}
?>
