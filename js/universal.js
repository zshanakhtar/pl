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
        
        console.log(elem);
        //$('#'+fragment).ajaxReload("get",requester,data);
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