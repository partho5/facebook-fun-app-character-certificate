<?php
define('DB_SERVER', '108.61.83.50');
define('DB_USERNAME', 'dealinte_partho');    // DB username
define('DB_PASSWORD', 'User123!!');    // DB password
define('DB_DATABASE', 'dealinte_fb_api');      // DB name
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE) or die( "Unable to connect");
?>
