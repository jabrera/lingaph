<?php
require_once('config.php');
if($ok == 0)
	header("Location: index.php");

if(isset($_GET['page_id']) && isset($_GET['content_id'])) {
	$page_id = $_GET['page_id'];
	$page_name = "";
	$page_link = "";
	$page_editable = 0;
	$query = mysql_query("SELECT * FROM Navigation WHERE ID = '$page_id'");
	while($row = mysql_fetch_array($query)) {
		$page_name = $row['Text'];
		$page_link = $row['Link'];
		$page_editable = $row['Editable'];
	}
	$content_id = $_GET['content_id'];
	$content_title = "";
	$content_message = "";
	$query = mysql_query("SELECT * FROM Content WHERE ID = '$content_id'");
	while($row = mysql_fetch_array($query)) {
		$content_title = $row['Title'];
		$content_message = $row['Message'];
	}
} elseif (isset($_POST['content_id']) && isset($_POST['title']) && isset($_POST['message']) && $_POST['page_id']) {
	$page_id = $_POST['page_id'];
	$content_id = $_POST['content_id'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	mysql_query("UPDATE Content SET Title = '$title', Message = '$message' WHERE ID='$content_id' LIMIT 1");
	header("Location: editpage.php?page_id=".$page_id."&editsuccess");
}
?>
<html>
<head>
	<title>LINGHAP</title>
	<link rel="stylesheet" href="../styles/style.css"/>
</head>
<body>
<center>
<div id="container">
	<div id="top">
		<div id="top_base">
			<div id="cover_photo"></div>
			<div id="text"></div>
			<div id="logo"></div>
		</div>
	</div>
	<div id="nav">
		<div id="nav_base">
		&nbsp;
		</div>
	</div>
	<div id="content">
		<div id="content_base">
			<div id="center"><div id="pad">
				<form action="editcontent.php" method="post">
				<div id="title">
					<span><input type="text" name="title" class="edit" value="<?php echo $content_title; ?>" placeholder="Title"></span>
					<div><a href="deletecontent.php?content_id=<?php echo $content_id; ?>&page_id=<?php echo $page_id; ?>"><img src="../images/skin/default/bg/delete.png" alt="Delete" title="Delete"></a></div>
				</div>
				<p>
				<textarea placeholder="Message here..." name="message" class="edit"><?php echo $content_message; ?></textarea>
				<br><br><input type="submit" value="Update Content">
				<input type="hidden" name="content_id" value="<?php echo $content_id; ?>">
				<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
				</form>
				</p>
			</div></div>
			<div id="sidebar"><div id="pad">
				<?php
					echo '<div id="title"><span>Welcome</span></div>
				<p>Hello, '.$loggeduser.'!</p>
				<span class="button"><a href="logout.php" class="button">Logout</a></span>
				<div id="title"><span>Message</span></div>
				<p>You are currently editing a content in '.$page_name.' Page</p>
				<span class="button"><a href="editpage.php?page_id='.$page_id.'" class="button">Cancel Edit</a></span>
';
				?>
			</div></div>
		</div>
	</div>
	<div id="content_bottom">
	
	</div>
	<div id="footer">
	<table>
		<tr>
			<td>&copy; 2014 Lasallian Individual Nurses Guild<br>Advocating for Humanitarian Programs
</td>
			<td align="right">Web Design by <a href="#">Juvar Abrera</a></td>
		</tr>
	</table>
	</div>
</div>
</center>
</body>
</html>
