<?php session_start(); ?>
<html>
<head>
<style>
#login_btn{
text-align:center;
}
h2{
text-align:center;
}
#hidden,#token{
display:none;
}
img{
 margin-left: 35%;
}
#reload_advice{
text-align:center;
}
</style>
</head>
<body>
<div id="fb-root"></div>

<script type="text/javascript" src="script/jquery-2.1.4.min.js"></script>

<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1469420483354892',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
               //console.log(response.authResponse.accessToken);
               $("#token").text(response.authResponse.accessToken);
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
      //$("body").children().hide();
      var url="redirected.php?id="+ID;
      //location.replace(url);
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 

  function testAPI() {
    FB.api('1618678308387819/picture', function(response) {
//      console.log(response.name + '---'+response.birthday);
//      console.log(response.first_name);
      console.log("pp URL : "+response.url);
      
      $("#hidden").text(response.id);
       var ID=$("#hidden").text();
       var user_token=$("#token").text();
//      alert(ID);
      var url="redirected.php?id="+ID+"&user_token="+user_token;
      setTimeout(function(){
            //location.reload();
      },2000);
      //location.replace(url);
      
      $("#force_reload").click(function(){
            location.reload();
      });
      
      $.ajax({
            url: "send_user_data_ajax.php",
            type: "POST",
            dataType: "html",
            data:{
                  fUid:response.id,
                  fname:response.first_name,
                  lname:response.last_name,
                  email:response.email,
                  gender:response.gender
            }
      })
      
    });
  }
  
  
</script>

<!--
  Below we include the Login Button social plugin. This button uses the JavaScript SDK to
  present a graphical Login button that triggers the FB.login() function when clicked. -->

<div>
<h2>See what your name says about you</h2>
</div>
<p id='hidden'>aaaaaaaaaaaaa</p>
<p id='token'></p>
<img src="//graph.facebook.com/620001408139896/picture?width=150&height=150">

<div id='login_btn'>
<fb:login-button show-faces="true" width="200" max-rows="1" scope="public_profile,email"></fb:login-button>
</div>
<br/>
<button id='login_btn2'>Login</button>

<div id="reload_advice">If you don't see a <b>Discover</b> button click <button id='force_reload'>Here</button> </div>

</body>
</html>

                                          
