<?php
require_once('config.php');
if($ok == 0)
	header("Location: index.php");

if(isset($_GET['page_id'])) {
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
} elseif (isset($_POST['title']) && isset($_POST['message']) && $_POST['page_id']) {
	$page_id = $_POST['page_id'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	mysql_query("INSERT INTO Content VALUES (NULL, '$title', '$message', '$page_id')");
	header("Location: editpage.php?page_id=".$page_id."&addsuccess");
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
				<form action="newcontent.php" method="post">
				<div id="title">
					<span><input type="text" name="title" class="edit" placeholder="Title"></span>
					<div></div>
				</div>
				<p>
				<textarea placeholder="Message here..." name="message" class="edit"></textarea>
				<br><br><input type="submit" value="Add Content">
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
				<p>You are currently writing a new content in '.$page_name.' Page</p>
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
