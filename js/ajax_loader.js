
$(document).ready(function() {
	$("#loader-wrapper").hide();
	$("#topheader .navbar-nav a:first").click();
});

$(document).ajaxStart(function(){
	// alert('ajax started');
	$("#loader-wrapper").show();
});

$(document).ajaxComplete(function(){
	// alert('ajax colmpleted');
	$("#loader-wrapper").hide();
});