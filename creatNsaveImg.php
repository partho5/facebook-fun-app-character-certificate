<?php

$user_id=$_POST['user_id'];
$dataURL=$_POST['dataURL'];

$data=$dataURL;

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

file_put_contents('images/app1-'.$user_id.'.png' ,$data);


$profile_picture=file_get_contents("//graph.facebook.com/".$user_id."/picture?width=150&height=150");
file_put_contents("images/pp-".$user_id.".png" , $profile_picture);


?>
