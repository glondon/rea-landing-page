  
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
  //console.log('statusChangeCallback');
  //console.log(response);
  
  // for FB.getLoginStatus().
  if (response.status === 'connected') {
    // Logged into your app and Facebook.
    //console.log(response.authResponse.accessToken);

    FB.api('/me?fields=id,first_name,last_name,email', function(response) {
      //console.log(JSON.stringify(response));

      var url = document.location.origin;

      // auto fill the forms as much as possible....
      if (url == document.location.origin) {

        $('#name').val(response.first_name);
        $('#email').val(response.email);

      } else {

        $('#name').val(response.first_name);
        $('#email').val(response.email);
      }

    });
    
    testAPI();

  } else if (response.status === 'not_authorized') {
    // The person is logged into Facebook, but not your app.
    document.getElementById('status').innerHTML = 'Please log ' +
      'into this app to auto fill the form.';
  } else {
    // The person is not logged into Facebook, so we're not sure if
    // they are logged into this app or not.
    document.getElementById('status').innerHTML = 'Please log ' +
      'into Facebook to auto fill the form.';
  }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

window.fbAsyncInit = function() {
  FB.init({
    appId      : '536283659887288', //TODO update addId
    cookie     : true,  
    xfbml      : true,  
    version    : 'v2.5' 
  });

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
};

// Load the SDK asynchronously
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
  //console.log('Welcome!  Fetching your information.... ');
  FB.api('/me', function(response) {
    //console.log('Successful login for: ' + response.name);
    document.getElementById('status').innerHTML =
      'Hello ' + response.name + '! The form has been auto filled with your Facebook profile information.';
  });
}
