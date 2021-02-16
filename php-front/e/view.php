<?php

$query="SELECT headline from editorial";
// echo $FILLteam;
$resultaccess=mysqli_query($conn,$query);

?>

<?php


extract($_SESSION);
// $resultapp=mysqli_query($conn,"SELECT * FROM judge WHERE judge_id='$username' AND flageval2='N'");
// $rowapp = $resultapp->fetch_assoc();

//     $app_id=$rowapp['app_id'];

//     $_SESSION['app_id']=$app_id;

//     $resultsum=mysqli_query($conn,"SELECT * FROM student WHERE app_id='$app_id'");
//     $row = $resultsum->fetch_assoc();
?>

<div class="panel panel-info">
	<div class="panel-heading text-center" data-toggle="collapse" data-target="#available" style="font-size:150%;"><b>Available Feedbacks</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="available">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Headline</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
<?php
$count=0;
while($rowaccess = $resultaccess->fetch_assoc())
{
    $count++;
?>
                <tr>
                    <?php $headline = htmlspecialchars($rowaccess['headline']);?>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $headline; ?></td>
                    <td class="playground">
                        <button type="submit" class="btn btn-danger z-optionbtn" data-target=".z-optionbox.z-i0" style="float:left;">
                            <span class="glyphicon glyphicon-cog"></span>
                        </button>
                        <div class="col-xs-12" style="float:left;position:relative">
                            <ul class="z-optionbox z-i0" data-requester='trinket' data-fragment='feedbackt' style="display:none;">
                                <li class="z-option" data-feedbackt="edit&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Form as Student"><span class="glyphicon glyphicon-edit"></span><br>Edit</li>
                                <li class="z-option" data-feedbackt="preview&feedback_code=<?php echo $feedback_code; ?>" title="Open Feedback Preview as Student"><span class="glyphicon glyphicon-eye-open"></span><br>Preview</li>
                            </ul>
                        </div>
                    </td>
                </tr>
<?php 
}
?>
            </tbody>
        </table>
    </div>
</div>


<div class="panel panel-info">
	<div class="panel-heading text-center" data-toggle="collapse" data-target="#feedbackt" style="font-size:150%;"><b>Feedback Form</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="feedbackt">
		
	</div>
</div>


<script>
    $(".z-optionbtn").zoption();
    $('.playground').fragmentLoader();
    
</script>

