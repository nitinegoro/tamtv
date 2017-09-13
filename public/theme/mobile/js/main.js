$(document).ready(function() 
{
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
})