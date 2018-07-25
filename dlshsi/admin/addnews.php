<?php
require_once('config.php');
if($ok == 0)
	header("Location: index.php");

if (isset($_POST['title']) && isset($_POST['message'])) {
	$news_title = $_POST['page_id'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	$date = date('F d, Y');
	$time = date('h:i:s A');
	mysql_query("INSERT INTO News VALUES (NULL, '$title', '$message', '$date', '$time')");
	header("Location: index.php?edit=news&addsuccess");
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
				<form action="addnews.php" method="post">
				<div id="title">
					<span><input type="text" name="title" class="edit" placeholder="Title"></span>
					<div></div>
				</div>
				<p>
				<textarea placeholder="Message here..." name="message" class="edit"></textarea>
				<br><br><input type="submit" value="Add News">
				</form>
				</p>
			</div></div>
			<div id="sidebar"><div id="pad">
				<?php
					echo '<div id="title"><span>Welcome</span></div>
				<p>Hello, '.$loggeduser.'!</p>
				<span class="button"><a href="logout.php" class="button">Logout</a></span>
				<div id="title"><span>Message</span></div>
				<p>You are writing a news.</p>
				<span class="button"><a href="index.php?edit=news" class="button">Cancel</a></span>
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
