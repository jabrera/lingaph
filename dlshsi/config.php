<?php
$file = "webstatus.txt";
$fh = fopen($file, 'r');
$xd = fread($fh, filesize($file));
if($xd == 0) {
	header("Location: unavailable.php"); 
}
ini_set('display_errors', 0);
error_reporting(0);

/*$mysql_host = "localhost";
$mysql_database = "dlshsi";
$mysql_user = "root";
$mysql_password = "";
*/
$mysql_host = "mysql3.000webhost.com";
$mysql_database = "a5247511_linghap";
$mysql_user = "a5247511_linghap";
$mysql_password = "uz0TheQzN0";
mysql_connect($mysql_host, $mysql_user, $mysql_password);
mysql_select_db($mysql_database);
date_default_timezone_set('Asia/Manila');
//uz0TheQzN0
?>