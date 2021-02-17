<?php
$query="SELECT headline from editorial";
$resultaccess=mysqli_query($conn,$query);
?>
<?php
extract($_SESSION);
?>
<div class="panel panel-info">
	<div class="panel-heading text-center" data-toggle="collapse" data-target="#headlines" style="font-size:150%;"><b>View Headlines</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="headlines">
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
                    <td><?php echo $count;?></td>
                    <td><?php echo $headline; ?></td>
                    <td>
                        <button type="submit" class="btn btn-xs btn-warning">
					        <span class="glyphicon glyphicon-pencil"></span>
					        <br class="hidden-lg hidden-sm hidden-xs">					
					        <span class="hidden-sm">Edit</span>
				        </button>
                    </td>
                </tr>
<?php 
}
?>
            </tbody>
        </table>
    </div>
</div>
