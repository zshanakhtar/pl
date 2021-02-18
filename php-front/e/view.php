<?php
$query="SELECT sno,headline from editorial";
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
$headline_sno=0;
while($rowaccess = $resultaccess->fetch_assoc())
{
    $headline_sno++;
    $headline = htmlspecialchars($rowaccess['headline']);
    $sno = htmlspecialchars($rowaccess['sno']);
?>
                <tr>
                    <td><?php echo $headline_sno;?></td>
                    <td><?php echo $headline; ?></td>
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
    // $(".ajaxsubmitform").on('submit',function(e) {
    //     var formid=$(this).attr('id');//get this form's id
    //     alert(formid);
    //     e.preventDefault(); // avoid to execute the actual submit of the form.
	//     setTimeout(function(e){ //wait 50ms to allow validator to execute
    //         // var data1=$("#"+formid).serialize()+"&flag"+formid+"=Y";
	//         // alert($("#"+formid).find('.has-error').length);//No of errors in the form
    //         if($("#"+formid).find('.has-error').length==0) 
    //         {
    //             var data= $("#"+formid).serialize();
    //             alert(data);
    //             //$('#editheadline').ajaxReload("get",formid,data);
    //         }
    //     }, 50);
    // });

    $(".z-btn").submoduleLoader();
</script>