$(document).ready(function() {
    var $navbar = $("#sticky-navbar");
  
    AdjustHeader(); // Incase the user loads the page from halfway down (or something);
    $(window).scroll(function() {
        AdjustHeader();
    });
  
    function AdjustHeader(){
        if ($(window).scrollTop() > 80) {
            if (!$navbar.hasClass("navbar-fixed-top")) {
                $navbar.addClass("navbar-fixed-top");
            }
        } else {
            $navbar.removeClass("navbar-fixed-top");
        }
    }

    jQuery("time.timeago").timeago();

    /* STICKY  SIdebar */
    $("#sticker").sticky({topSpacing:50, bottomSpacing:100});
    $("#sticker2").sticky({topSpacing:30, bottomSpacing:100});
});