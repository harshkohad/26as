$(function(){
    if($(".jsToggleTopNav").length > 0) {
        $("body").on('click', '.jsToggleTopNav', function(){
           if($(".jsTopMenu").hasClass('active')) {
               $(".jsTopMenu").removeClass('active');
           } else {
               $(".jsTopMenu").addClass('active');
           }
        });
    }
    
    if($(".level_2").length > 0) {
        var width = 0;
        $(".level_2").each(function(i, e){
            width = width + 100 + $(e).innerWidth();
        });
        $(".jsDeptListData").css("width", width + "px");
    }
    
    // Org Structure 
    
    if($(".jsDeptListData").length > 0) {
        var parent = $(".jsDeptListData");
        var level2 = $(".level_2", parent);
        $.each(level2, function(i, e){
            var child = $(e).find('.level_3');
            if(child.length == 0) {
                $(e).addClass('rm-after')
            }
        });
    }
    
    var winHeight = $(window).innerHeight();
    $(".jsContentWrp").css('min-height', winHeight + 'px');
    
});