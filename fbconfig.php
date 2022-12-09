<?php
@session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1469420483354892','5b8fa54a12a4af3ac52419125ae3230d' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://dealintech.com/fb_api/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  
  
  
/*---------------------------------------------------------------------------------*/

  // Get the response typed as a GraphUser
            //$user = $response->getGraphObject(GraphUser::className());
// or convert the base object previously accessed
// $user = $object->cast(GraphUser::className());

// Get the response typed as a GraphLocation
//$loc = $response->getGraphObject(GraphLocation::className());
// or convert the base object previously accessed
// $loc = $object->cast(GraphLocation::className());

// User example
echo $graphObject->getProperty('name');
$email=$graphObject->getProperty('email');
echo __LINE__ .$email.__LINE__ ;
//echo $user->getName();

// Location example
//echo $graphObject->getProperty('country');
//echo $loc->getCountry();

/*---------------------------------------------------------------------------------*/
  

  
  
//  var_dump($graphObject);
  //var_dump($graphObject);
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
     	//var_dump($fbid);
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
 	    //var_dump($fbfullname);
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;          
	    //echo "---".$_SESSION['FBID']."----"; 
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
	    
//	    require 'functions.php'; 
//	    checkuser($fbid,$fbfullname,$femail);
	    
	    require ('dbconfig.php');
	    if(!$connection) echo "not connected";
	    else{
	      $query="INSERT INTO `Users` (`Fuid`, `Ffname`, `Femail`) ".
	      " VALUES('$fbid','$fbfullname','$femail')";
	      $result=mysqli_query($connection,$query);
	      if(!$result) echo mysqli_error($connection);
	    }
	    
	    
	    
	    
	    
	    
    /* ---- header location after session ----*/
  //header("Location: redirected.php");
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>
