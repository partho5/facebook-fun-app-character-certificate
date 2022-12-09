<?php

require_once('dbconfig.php');

$q="SELECT * FROM Users ";
$r=mysqli_query($connection,$q);
if($r){
$i=0;
	echo "<table border='1'>";
	//echo "<th>No</th> <th>F name</th> <th>L name</th><th>gender</th>";
	while ($row=mysqli_fetch_array($r)) {
	      echo "</tr>";
	      echo "<td>".(++$i)."</td>";
	      echo "<td>".$row['fUid']."</td>";
		echo "<td>".$row['fname']."<td>";
		echo "<td>".$row['lname']."<td>";
		echo "<td>".$row['gender']."<td>";
		$fb_url="https://www.facebook.com/app_scoped_user_id/".$row['fUid'];
		echo "<td><a href='".$fb_url."' target='_blank'>Visit Profile</a></td>";
		echo "</tr>";
	}
	echo "</table>";
}

?>
