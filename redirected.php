<!DOCTYPE html>
<html>
<head>
	<title>Click Here To Get Your Character Cetificate !</title>
	<style type="text/css">
	#hidden,#token{
	      display:none;
	}
		#top_bar{
			height: 130px;
			background-color: #D8D8D8 ;
		}
		#main_wrapper{
			height: 600px;
			margin-top: 10px;
			background-color: #D8E8D8;
		}
		#left_bar{
			width: 20%;
			height: 100%;
			margin-left: 5%;
			background-color: #D8D8D8;
		}
		#main{
			height: 400px;
			width: 40%;
			margin-left: 5%;
			margin-top: 5%;
			background-color: #1F68FF;
			border-radius: 20px;
		}
		#main p{
			text-align: center;
			padding: 10px;
			font-size: 2.5em;
		}
		#right_bar{
			width: 20%;
			height: 100%;
			margin-left: 5%;
			background-color: #D8D8D8;
		}
		#left_bar,#main,#right_bar{
			float: left;
		}
		#get{
			font-size: 3em;
			background-color: #1FD6BF;
			margin-left: 23%;
			border-radius: 10px;
			padding: 5px;
		}
		#get:hover{
			background-color: #56FF75;
		}
	</style>
</head>
<body>

<div id='hidden'></div>
	<div id="top_bar">
		
	</div>
	<div id="main_wrapper">
		<div id="left_bar">
			
		</div>
		<div id="main">
			<p>Get your character certificate from great persons !!</p>
			<button type="button" id="get">Get Certified</button>
		</div>
		<div id="right_bar">
			
		</div>
	</div>
	
	<script type="text/javascript" src="script/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
	      $(document).ready(function(){
	      
 window.fbAsyncInit = function() {
  FB.init({
    appId      : '1005897192788799',
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
    FB.api('/me?fields=id,first_name,last_name,email,gender,timezone', function(response) {
//      console.log(response.name + '---'+response.birthday);
      console.log(response.first_name);
      $(".pn").text(response.first_name);
      $("#hidden").text(response.id);
       var ID=$("#hidden").text();
//       alert("ID:"+ID);
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
  
      
	      
	      
	      	$("#get").click(function(){
	      	var id=$("#hidden").text();
	      	FB.login();
	      	if(id!=''){
	      	      var url='discovered.php?id='+id;
            	      location.replace(url);
	      	}
	      	else{
      	      	location.reload();
	      	}

	      	});
      	});
	</script>
</body>
</html>
