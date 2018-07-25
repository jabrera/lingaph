<?php
require_once('config.php');
if($ok == 0)
	header("Location: index.php");

if (isset($_GET['news_id'])) {
	$news_id = $_GET['news_id'];
	mysql_query("DELETE FROM News WHERE ID='$news_id'");
	header("Location: index.php?edit=news&deletesuccess");
}
?>