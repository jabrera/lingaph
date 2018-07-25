<?php
require_once('config.php');
if($ok == 0)
	header("Location: index.php");
	
$page_id = $_GET['page_id'];
$page_name = "";
$page_link = "";
$page_editable = 0;
$query = mysql_query("SELECT * FROM Navigation WHERE ID = '$page_id'");
$n = 0;
while($row = mysql_fetch_array($query)) {
	$page_name = $row['Text'];
	$page_link = $row['Link'];
	$page_editable = $row['Editable'];
	$n = 1;
}
if($n == 0) {
	header("Location: index.php");
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
				<div id="title">
					<span>Edit Contents in <?php echo $page_name; ?></span>
					<div><!-- date --></div>
				</div>
				<p>
				<b>Select a content to edit:</b>
				<?php
				$query = mysql_query("SELECT * FROM Content WHERE Navigation = '$page_id'");
				$n = 0;
				while($row = mysql_fetch_array($query)) {
					echo '
				<div id="newcontent">
					<div id="title">
						<span>'.$row['Title'].'</span>
					</div>
					<p>'.$row['Message'].'</p>
					<a href="editcontent.php?content_id='.$row['ID'].'&page_id='.$page_id.'" class="editcontent"></a>
				</div>';
					$n = 1;
				}
				if($n == 0) {
					echo '
				<br><center>There are no contents posted in this page. To add one, click the button below.</center>';
				}
				?></p>
				<div id="newcontent">
					<div id="title">
						<span>Example template</span>
					</div>
					<p>Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document.</p>
					<a href="newcontent.php?page_id=<?php echo $page_id; ?>" class="newcontent"></a>
				</div>
			</div></div>
			<div id="sidebar"><div id="pad">
				<?php
					echo '<div id="title"><span>Welcome</span></div>
				<p>Hello, '.$loggeduser.'!</p>
				<span class="button"><a href="logout.php" class="button">Logout</a></span>
				<div id="title"><span>Message</span></div>
				<p>You are currently editing '.$page_name.' Page</p>
				<span class="button"><a href="index.php?edit=pages" class="button">Cancel Edit</a></span>
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
<?php
if(isset($_GET['addsuccess']) || isset($_GET['editsuccess']) || isset($_GET['deletesuccess'])) {
	echo '<div id="popup_box" onClick="document.getElementById(\'popup_box\').style.display = \'none\';">
You have successfully ';
	if(isset($_GET['addsuccess']))
		echo 'added';
	elseif(isset($_GET['editsuccess']))
		echo 'edited';
	elseif(isset($_GET['deletesuccess']))
		echo 'deleted';
	echo ' a content.<br><small>Click here to close this message</small>
</div>';
}
?>
</center>
</body>
</html>
