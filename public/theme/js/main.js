$(document).ready(function() 
{
    /*!
    * STICKY MENU BOOTSTRAPS
    */
    var $navbar = $("#sticky-navbar");
  
    AdjustHeader();

    $(window).scroll(function() 
    {
        AdjustHeader();
    });
  
    function AdjustHeader()
    {
        if ($(window).scrollTop() > 80) 
        {
            if (!$navbar.hasClass("navbar-fixed-top")) 
            {
                $navbar.addClass("navbar-fixed-top");
            }
        } else {
            $navbar.removeClass("navbar-fixed-top");
        }
    }

    $('[data-toggle="tooltip"]').tooltip(); 

    /* JQUERY TIMEAGO */
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

    /*!
    * POLLING CLIK
    */
    $('a#set-polling').on('click',function(argument) 
    {
        var setanswer = $(this).data('id'),
            setpost   = $(this).data('post');

        $.post(base_url + 'account/set_polling/', {
            answer: setanswer,
            post:setpost,
            backTo : current_url
        }, function(data) {
            if(data.status === 'success')
            {
                
            } else {
                window.location.assign(base_url + 'login?back-to=' + data.redirectTo);
            }
        });
    });

    /* DATEPICKER */
    $('#datepicker1, #datepicker2').daterangepicker({
        singleDatePicker: true,
        format:'YYYY-MM-DD', 
    });
});