<?php
require_once('config.php');
if($ok == 0)
	header("Location: index.php");
if(isset($_POST['status'])) {
	$status = $_POST['status'];
	$fn = "../webstatus.txt";
    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
    fputs($fp,$status);
    fclose($fp) or die ("Error closing file!");
	header("Location: webstatus.php");
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
			<div id="logo"><a href="index.php"></a></div>
		</div>
	</div>
	<div id="nav">
		<div id="nav_base">
		</div>
	</div>
	<div id="content">
		<div id="content_base">
			<div id="center"><div id="pad">
				<div id="title">
					<span>Change Web Status</span>
				</div>
				<p>
				Your website is currently <?php
				$file = "../webstatus.txt";
				$fh = fopen($file, 'r');
				$xd = fread($fh, filesize($file));
				if($xd == 0) {
					echo 'offline.<br><br><form action="webstatus.php" method="post"><input type="hidden" name="status" value="1"><input type="submit" value="Turn on website"></form>';
				} else {
					echo 'online.<br><br><form action="webstatus.php" method="post"><input type="hidden" name="status" value="0"><input type="submit" value="Turn off website"></form>';
				}
				?>
				</p>
			</div></div>
			<div id="sidebar"><div id="pad">
				<?php
					echo '<div id="title"><span>Welcome</span></div>
				<p>Hello, '.$loggeduser.'!</p>
				<span class="button"><a href="logout.php" class="button">Logout</a></span>
				<div id="title"><span>Message</span></div>
				<p>You are currently editing your website\'s status</p>
				<span class="button"><a href="index.php" class="button">Cancel Edit</a></span>
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
			<td align="right">Web Design by <a href="#">Juvar Abrera</a><br><a href="admin/">Administrator Login</a></td>
		</tr>
	</table>
	</div>
</div>
</center>
</body>
</html>
