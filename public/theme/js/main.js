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

    /* BX SLIDER */
    $('.headline-slider').bxSlider({
        slideWidth: 400,
        minSlides: 2,
        maxSlides: 2,
        slideMargin: 10,
        auto:true
    });

    $('.owl-carousel').owlCarousel({
        items:3,
        lazyLoad:true,
        margin:10,
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:3000,
        navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
    });

    /* VIEWER */
    $('.galery').lightGallery();

    var clickEvent = false;
    $('#myCarousel').carousel({
        interval:   4000    
    }).on('click', '.list-group li', function() {
            clickEvent = true;
            $('.list-group li').removeClass('active');
            $(this).addClass('active');     
    }).on('slid.bs.carousel', function(e) {
        if(!clickEvent) {
            var count = $('.list-group').children().length -1;
            var current = $('.list-group li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if(count == id) {
                $('.list-group li').first().addClass('active'); 
            }
        }
        clickEvent = false;
    });

});


console.log("%cHey, what are you doing?%c\nAre you a JavaScript developer? We want you! visit http://teitramega.co.id/career","font-family:sans-serif;font-size: 56px; color: #010080;text-shadow: 0 3px #cecece; webkit-text-stroke: 1px #d87d02;","font-family:sans-serif;font-size:18px;font-weight:600;color:#CDCDCD;");