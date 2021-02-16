$.fn.fragmentLoader=function(){
    var elem=this;
    $(elem).find('ul').children('li').on('click',function(){
        $(elem).find('ul').children('li').removeClass('active');
        $(this).addClass('active');
        var requester=$(this).closest('ul').data('requester');
        var fragment=$(this).closest('ul').data('fragment');
        var module=fragment+'='+$(this).data(fragment);
        $('#'+fragment).ajaxReload("get",requester,module);
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
            //handle returned arrayList
        },
        error: function(e){  
            alert("error");
            //handle error
        } 
    });
}

$.fn.zoption= function(){
    var elem=this;
    $(elem).on('click',function(){
        var target=$(elem).data('target');
        $(target).toggle();
        
        // var fragment=$(this).closest('ul').data('fragment');
        // var module=fragment+'='+$(this).data(fragment);
        // $('#'+fragment).ajaxReload("get",fragment,module);
    });
}
$(window).on('click',function(event){
    if($(event.target).closest(".z-optionbtn").length==0)
    {
      $(".z-optionbox").hide();
    }
  });