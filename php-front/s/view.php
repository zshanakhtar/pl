<?php
$query="SELECT sno,headline,author,sport,article_link from followsports";
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
                    <th>Author</th>
                    <th>Sport</th>
                    <th>Article Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
$headline_sno=0;
while($rowaccess = $resultaccess->fetch_assoc())
{
    $headline_sno++;
    extract($rowaccess);
?>
                <tr>
                    <td><?php echo $headline_sno;?></td>
                    <td><?php echo $headline; ?></td>
                    <td><?php echo $author; ?></td>
                    <td><?php echo $sport; ?></td>
                    <td><?php echo "<a target='_blank' href='".$article_link."'>".$article_link."</a>" ; ?></td>
                    <td>
                        <button data-request="submodule" data-fragment="edit" data-edit="<?php echo $sno;?>" class="btn btn-xs btn-warning z-btn">
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


<div class="panel panel-info">
	<div class="panel-heading text-center" data-toggle="collapse" data-target="#submodule" style="font-size:150%;"><b>Edit Headline</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="submodule">
        Select an item to edit
    </div>
</div>

<script>
    $(".z-btn").submoduleLoader();
</script>