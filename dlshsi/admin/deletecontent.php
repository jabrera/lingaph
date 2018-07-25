<?php
require_once('config.php');
if($ok == 0)
	header("Location: index.php");

if (isset($_GET['content_id']) && isset($_GET['page_id'])) {
	$content_id = $_GET['content_id'];
	$page_id = $_GET['page_id'];
	mysql_query("DELETE FROM Content WHERE ID='$content_id'");
	header("Location: editpage.php?page_id=".$page_id."&deletesuccess");
}
?>