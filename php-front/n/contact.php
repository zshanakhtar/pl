
<div class="panel panel-info">
	<div class="panel-heading" data-toggle="collapse" data-target="#zero" style="font-size:150%;"><b>Instructions</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="zero">
		<h3 style="margin-left:100px;">
		1-First Generate a token by providing your details
		<br>
		2-Note this down
		<br>
		3-Use your token to open feedback dashboard
		<br>
		4-Submit your feedback
		</h3>
	</div>
</div>
<form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" id="token" >
<div class="panel panel-info">
	<div class="panel-heading" data-toggle="collapse" data-target="#one" style="font-size:150%;"><b>Fill your details</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="one">
		<div class="row form-group">
			<label for="univ_roll" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">University Roll No</label>
			<div class="col-sm-10">
				<input id="univ_roll" name="univ_roll" type="text" class="form-control" required />
			</div>
		</div>
		<div class="row form-group">
			<label for="pass" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Password</label>
			<div class="col-sm-10">
				<input id="pass" name="pass" type="text" class="form-control" required />
			</div>
		</div>
		<div class="row form-group">
			<label for="access_code" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Access code</label>
			<div class="col-sm-10">
				<input id="access_code" name="access_code" type="text" class="form-control" required />
			</div>
		</div>
		
		<div class="row form-group">
			<div class="col-sm-offset-5 col-sm-2">
			     <button type="submit" class="btn btn-warning col-sm-8 col-sm-offset-2">
					<span class="glyphicon glyphicon-floppy-disk"></span>
					<br class="hidden-lg hidden-sm hidden-xs">					
					<span class="hidden-sm">Get Token</span>
				 </button>
			</div>
		</div>
	</div>
</div>
</form>

<script>
    $(".ajaxsubmitform").validator();
    $(".ajaxsubmitform").on('submit',function(e) {
        var formid=$(this).attr('id');//get this form's id
        e.preventDefault(); // avoid to execute the actual submit of the form.
	    setTimeout(function(e){ //wait 50ms to allow validator to execute
            var url = formid; // the script where you handle the form input.
            // var data1=$("#"+formid).serialize()+"&flag"+formid+"=Y";
	        // alert($("#"+formid).find('.has-error').length);//No of errors in the form
            if($("#"+formid).find('.has-error').length==0) 
            {
                var data= $("#"+formid).serialize();
                $('#token').ajaxReload(url,data);
            }
        }, 50);
    });
</script>