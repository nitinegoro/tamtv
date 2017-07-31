$(function() {
    var div = $(".sticky");
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
    
        if (scroll >= 100) {
            div.removeClass('hidden-lg').addClass("visible-lg");
        } else {
            div.removeClass("visible-lg").addClass('hidden-lg');
        }
    });
});