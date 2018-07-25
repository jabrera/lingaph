<?php
require_once('config.php');
if($ok == 0)
	header("Location: index.php");

if(isset($_GET['news_id'])) {
	$news_id = $_GET['news_id'];
	$news_title = "";
	$news_message = "";
	$query = mysql_query("SELECT * FROM News WHERE ID = '$news_id'");
	$n = 0;
	while($row = mysql_fetch_array($query)) {
		$news_title = $row['Title'];
		$news_message = $row['Message'];
		$n = 1;
	}
	if ($n == 0)
		header("Location: index.php?edit=news");
} elseif (isset($_POST['news_id']) && isset($_POST['title']) && isset($_POST['message'])) {
	$news_id = $_POST['news_id'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	mysql_query("UPDATE News SET Title = '$title', Message = '$message' WHERE ID='$news_id' LIMIT 1");
	header("Location: index.php?edit=news&editsuccess");
} else { 
	header("Location: index.php?edit=news");
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
				<form action="editnews.php" method="post">
				<div id="title">
					<span><input type="text" name="title" class="edit" value="<?php echo $news_title; ?>" placeholder="Title"></span>
					<div><a href="deletenews.php?news_id=<?php echo $news_id; ?>"><img src="../images/skin/default/bg/delete.png" alt="Delete" title="Delete"></a></div>
				</div>
				<p>
				<textarea placeholder="Message here..." name="message" class="edit"><?php echo $news_message; ?></textarea>
				<br><br><input type="submit" value="Update News">
				<input type="hidden" name="news_id" value="<?php echo $news_id; ?>">
				</form>
				</p>
			</div></div>
			<div id="sidebar"><div id="pad">
				<?php
					echo '<div id="title"><span>Welcome</span></div>
				<p>Hello, '.$loggeduser.'!</p>
				<span class="button"><a href="logout.php" class="button">Logout</a></span>
				<div id="title"><span>Message</span></div>
				<p>You are currently editing a news</p>
				<span class="button"><a href="index.php?edit=news" class="button">Cancel Edit</a></span>
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
