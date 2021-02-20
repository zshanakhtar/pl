<?php
$query="SELECT sno,username,userstatus,usertype from regist";
$resultaccess=mysqli_query($conn,$query);
?>
<?php
extract($_SESSION);
?>
<div class="panel panel-info">
	<div class="panel-heading" data-toggle="collapse" data-target="#headlines" style="font-size:150%;"><b>Registered Users</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="headlines">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Username</th>
                    <th>Usertype</th>
                    <th>Userstatus</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
$display_sno=0;
while($rowaccess = $resultaccess->fetch_assoc())
{
    $display_sno++;
    extract($rowaccess);
?>
                <tr>
                    <td><?php echo $display_sno;?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $usertype; ?></td>
                    <td><?php echo $userstatus; ?></td>
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
	<div class="panel-heading" data-toggle="collapse" data-target="#submodule" style="font-size:150%;"><b>Edit User Priviledges</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="submodule">
        Select an item to edit
    </div>
</div>

<script>
    $(".z-btn").submoduleLoader();
</script>