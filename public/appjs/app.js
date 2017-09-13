window.fbAsyncInit = function() {
    FB.init({
        appId      : '141250066463038',
        xfbml      : true,
        version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Check login status
function statusCheck(response)
{
    console.log('statusCheck', response.status);
    if (response.status === 'connected')
    {
        FB.api('/me?fields=id,name,email,birthday,picture', function(response) 
        {
            $.ajax({
                type: "POST",
                url: base_url + "api/fb/get_user",
                data: response,
                success: function(data) {
                    console.log(data);
                    if (data.status === true)
                    {
                        window.location = base_url + 'main';
                    }   else {
                        window.location = base_url + 'login';
                    }                 
                }
            });
        });
    } else if (response.status === 'not_authorized')
    {
       
    } else
    {
       
    }
}

// Get login status
function loginCheck()
{
    FB.getLoginStatus(function(response) {
         console.log('loginCheck', response);
        statusCheck(response);
    });
}

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function getUser()
{
    FB.api('/me?fields=id,name,email,birthday', function(response) {
        console.log('getUser', response);
    });
}



$(function(){
    // Trigger login Facbook
    $('.login-facebook').on('click', function() {
        FB.login(function(){
            loginCheck();
        }, {scope: 'public_profile,publish_actions,email'});
    });

});




