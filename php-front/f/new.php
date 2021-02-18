<div id="response"></div>
<form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" id="new" >
<div class="panel panel-info">
	<div class="panel-heading" data-toggle="collapse" data-target="#one" style="font-size:150%;"><b>Fill your details</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="one">
		<div class="row form-group">
			<label for="headline" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Headline</label>
			<div class="col-sm-10">
				<input id="headline" name="headline" type="text" class="form-control" required />
			</div>
		</div>
		<div class="row form-group">
			<label for="paper" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Paper</label>
			<div class="col-sm-10">
				<input id="paper" name="paper" type="text" class="form-control" required />
			</div>
		</div>
		<div class="row form-group">
			<label for="article_link" class="col-sm-2 control-label" style="color:#337ab7; font-size:14px">Article Link</label>
			<div class="col-sm-10">
				<input id="article_link" name="article_link" type="text" class="form-control" required />
			</div>
		</div>
		<div class="row form-group">
			<div class="col-sm-offset-5 col-sm-2">
			     <button type="submit" class="btn btn-warning col-sm-8 col-sm-offset-2">
					<span class="glyphicon glyphicon-floppy-disk"></span>
					<br class="hidden-lg hidden-sm hidden-xs">					
					<span class="hidden-sm">Submit</span>
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
                $('#response').ajaxReload("submit",formid,data);
            }
        }, 50);
    });
</script>