$(document).ready(function() {
    var $navbar = $("#sticky-navbar");
  
    AdjustHeader();

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

    /* NOT ALLOWED SPACE IN INPUT 
    * @see https://stackoverflow.com/questions/19024825/not-allow-a-blank-character-space-in-a-input-form
    */
    $('#not-space').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });
});