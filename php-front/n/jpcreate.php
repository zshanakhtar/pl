<div id="response"></div>
<form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" id="jpclient" >
<div class="panel panel-info">
	<div class="panel-heading" data-toggle="collapse" data-target="#one" style="font-size:150%;"><b>Fill your details</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="one">
		<div class="row form-group">
			<label for="username" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Username</label>
			<div class="col-sm-10">
				<input id="username" name="username" type="text" class="form-control" required />
			</div>
		</div>
		<div class="row form-group">
			<label for="gamecode" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Game Code</label>
			<div class="col-sm-10">
				<input id="gamecode" name="gamecode" type="text" class="form-control" />
			</div>
		</div>
		<div class="row form-group">
			<div class="col-sm-offset-5 col-sm-2">
			     <button type="submit" class="btn btn-warning col-sm-8 col-sm-offset-2">
					<span class="glyphicon glyphicon-play-circle"></span>
					<br class="hidden-lg hidden-sm hidden-xs">					
					<span class="hidden-sm">Start game!</span>
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
            // var data1=$("#"+formid).serialize()+"&flag"+formid+"=Y";
	        // alert($("#"+formid).find('.has-error').length);//No of errors in the form
            if($("#"+formid).find('.has-error').length==0) 
            {
                var data= $("#"+formid).serialize();
                $('#response').ajaxReload("request",formid,data);
            }
        }, 50);
    });
</script>