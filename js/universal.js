$.fn.fragmentLoader=function(){
    var elem=this;
    $(elem).find('ul').children('li').on('click',function(){
        $(elem).find('ul').children('li').removeClass('active');
        $(this).addClass('active');
        var requester=$(this).closest('ul').data('requester');
        var fragment=$(this).closest('ul').data('fragment');
        var module=fragment+'='+$(this).data(fragment);
        console.log(requester+","+module);
        $('#'+fragment).ajaxReload("get",requester,module);
    });
  }

$.fn.submoduleLoader=function(){
    var elem=this;
    $(elem).on('click',function(){
        var request=$(this).data('request');
        var fragment=$(this).data('fragment');
        var data=fragment+'='+$(this).data(fragment);
        console.log(request+","+data);
        $('#'+request).ajaxReload("get",request,data);
    });
  }

$.fn.ajaxReload= function(urltype,url,data){
    var elem=this;
    $.ajax({
        url: "php-back/"+urltype+url+".php",
        type: "POST",
        data: data,
        success: function(response){ 
            $(elem).html(response);
        },
        error: function(e){  
            alert("error");
            //handle error
        } 
    });
}