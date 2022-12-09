<?php

$con=mysqli_connect('108.61.83.50','dealinte_partho','User123!!','dealinte_fb_api') or die("error!");


$fUid=$_POST['fUid'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$gender=$_POST['gender'];

$q="INSERT INTO `Users`(`fUid`, `fname`, `lname`, `email`, `gender`) ".
" VALUES('$fUid','$fname','$lname','$email','$gender') ";

$q="INSERT INTO Users( `fUid` , `fname`,`lname`, `email`, `gender` ) SELECT * FROM (SELECT ". " '$fUid', '$fname','$lname','$email','$gender') AS tmp WHERE NOT EXISTS ( SELECT fUid FROM ". " Users WHERE fUid = '$fUid') LIMIT 1";

$r=mysqli_query($con,$q);

?>
