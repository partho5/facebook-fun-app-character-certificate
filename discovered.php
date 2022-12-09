<?php 
$id=$_GET['id']; 
$user_token=$_GET['user_token'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Get character cetificate !</title>
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

		
		#right_bar{
			width: 20%;
			height: 100%;
			margin-left: 5%;
			background-color: #D8D8D8;
		}
		#left_bar,#main,#right_bar{
			float: left;
		}
		#discover{
			font-size: 3em;
			background-color: #1FD6BF;
			margin-left: 30%;
			border-radius: 10px;
			padding: 5px;
		}
		#discover:hover{
			background-color: #56FF75;
		}
		#share{
			height: auto;
			padding: 10px;
			padding-left:30px;
			padding-right:30px;
			width: 40%;
			margin-left: auto;
			margin-right: auto;
			margin-top: 40px;
			background-color: #10F17D;
			border-radius: 10px;
			text-align:center;
			font-size: 1.3em;
			border:5px solid #1F68FF;
		}
		#share:hover{
		      cursor:pointer;
		      border:5px solid #01D3BC;
		      background-color: #01FF1B;
		      padding-left:50px;
			padding-right:50px;
		}
		li{
		float:left;
		margin-left: 15px;
		}

	</style>
</head>
<body>

<div id="fb-root"></div>

<div id='hidden'><?php echo $id; ?></div>
<div id='token'><?php echo $user_token; ?></div>
	<div id="top_bar">
		
	</div>
	<div id="main_wrapper">
		<div id="left_bar">
			
		</div>
		<div id="main">
			<?php 
			      
			      require_once('box.php');
			      
			      $con=mysqli_connect('108.61.83.50','dealinte_partho','User123!!','dealinte_fb_api') or die("error!");
			      $q="SELECT fname,lname,gender FROM Users WHERE fUid='$id' ";
			      $r=mysqli_query($con,$q);
			      if($r){
			            while($row=mysqli_fetch_array($r)){
			                  $name=$row['fname'].' '.$row['lname'];
			                  $gender=$row['gender'];
			            }
			      }
			 ?>
			 
			 <div id='share'>Share on facebook</div>
		</div>
		<div id="right_bar">
			
		</div>
	</div>




<script type="text/javascript" src="script/jquery-2.1.4.min.js"></script>


 <script>
  var publish = {method: 'stream.publish',display: 'popup', // force popup mode


  attachment: {
    name: 'Get your character certificate !',
    caption: 'Click here to get your character certificate',
    description: (
      '=====Click here to test your result====='+
      'Don\'t forget to share the result. '+
      'This app gives you funny character certificate'
    ),
    href: 'http://dealintech.com/character/redirected.php'
  }


};




  function testAPI() {
    FB.api('/me?fields=id,email,public_profile,first_name,last_name,gender', function(response) {
//      console.log(response.name + '---'+response.birthday);
      console.log(response.first_name);
//      console.log("pp URL : "+response.url);
      
      $("#hidden").text(response.id);
       var ID=$("#hidden").text();
       var user_token=$("#token").text();
//      alert(ID);

      
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






function publishPost(){
var user_id=$("#hidden").text();
FB.ui({
  method: 'feed',
  caption: 'Click to get your certificate',
  link: 'http://dealintech.com/character/redirected.php',
  //picture: 'http://dealintech.com/character2/images/app1-'+user_id+'.png' 
}, function(response){});



}
</script>


<script>

    window.fbAsyncInit = function() {
    FB.init({
    appId: '1005897192788799',
     status: true,
      cookie: true,
      xfbml: true
    });
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +'//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());


</script>




<script type="text/javascript" src="http://connect.facebook.net/en/all.js"></script>

<script type="text/javascript" src="script/html2canvas.js"></script>
<script type="text/javascript" src="script/base64.min.js"></script>
<script type="text/javascript" src="script/canvas2image.js"></script>
	<script type="text/javascript">	
    	function creatImg() { 
    	      $("#share").hide();
        	html2canvas($("#main"),{
            	onrendered: function(canvas) {
                	var dataURL = canvas.toDataURL();
                	var ID=$("#hidden").text();
                	//window.open(dataURL);
                	$.ajax({
                	      url: "creatNsaveImg.php",
                	      type: "POST",
                	      dataType: "html",
                	      data:{
                	           user_id:ID,
                	           dataURL:dataURL 
                	      },
                	      success:function(response){
                	            //alert(response);
                	            $("#share").show();
                	      }
                	});
            	}
        	});
    	};
	</script>

<script type="text/javascript">
	$(document).ready(function(){
            var name="<?php echo $name; ?>";
            var gender="<?php echo $gender; ?>";
            
            var bf_gf=(gender=='male')? 'girl friend':'boy friend';
            var he_she=(gender=='male')? 'he':'she';
            var him_her=(gender=='male')? 'him':'her';
            var his_her=(gender=='male')? 'his':'her';
            
            $(".pp").text(name);
            $(".pn").text(name);
            $(".bf_gf").text(bf_gf);
            $(".he_she").text(he_she);
            $(".him_her").text(him_her);
            $(".his_her").text(his_her);
            
            var ID=$("#hidden").text();
            var pp_url="//graph.facebook.com/"+ID+"/picture?width=150&height=150";
            $("#pp").attr("src",pp_url);
            
            var gp_array=new Array('Mark Zuckeberg','Albert Einstein','Bill Gates','Barak Obama','Steve Jobs');
            function RANDOM(min,max){
                return (Math.round(Math.random()*(max-min)+min));
            }
            var rand=RANDOM(0,4);
            var gp_url="images/gp"+rand+".jpg";
            //var pp_url="images/pp-"+ID+".png";
            $("#gp").attr("src",gp_url);
            $(".gp").text(gp_array[rand]); 
            
            alert("Don't forget to share with friends");
            
            $("#share").click(function(){
                  alert("Your certificate is being ready. Wait a few seconds");                  
                  creatImg();
                  
                  setTimeout(function(){publishPost();},2000);
                  
            });
            
	});
</script>

</body>
</html>
