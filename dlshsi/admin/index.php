<?php
require_once('config.php');
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
				<?php
				if ($ok == 0) {
					echo '
				<div id="title">
					<span>Login</span>
					<div><!-- date --></div>
				</div>
				<p><center>
				';
					if(isset($_POST['username']) || isset($_POST['password'])) {
						$myusername = $_POST['username'];
						$mypassword = $_POST['password'];
						if((!$myusername) || (!$mypassword)) {
								echo 'Invalid username or password.
';
						} else {
							$sql = mysql_query("SELECT * FROM User WHERE Username='$myusername' AND Password='$mypassword'");
							$count = mysql_num_rows($sql);
							if($count == 1) {
								$_SESSION['username'] = $myusername;
								$_SESSION['password'] = $mypassword;
								$_SESSION['userrecord'] = mysql_fetch_assoc($sql);
								header("Location: index.php");
							} else {
								echo 'Invalid username or password.
';
							}
						}
					} else {
						echo 'Please login with your username and password.
';
					}
					echo '<br><br><form action="index.php" method="post">
				<table cellpadding="10">
					<tr>
						<td>Username:</td><td><input type="text" name="username" class="custom"></td>
					</tr>
					<tr>
						<td>Password:</td><td><input type="password" name="password" class="custom"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Login"></td>
					</tr>
				</table>
				</form>
				</center></p>
';
				} else {
					// LOGGED IN
					if(isset($_GET['edit'])) {
						$edit = $_GET['edit'];
						if($edit == "pages") {
							echo '
				<div id="title">
					<span>Edit Pages</span>
					<div><!-- date --></div>
				</div>
				<p>
				<table class="editpage" cellpadding="8px" cellspacing="0px" width="100%">';
							$query = mysql_query("SELECT * FROM Navigation WHERE Editable = 1");
							while($row = mysql_fetch_array($query)) {
								echo '
				<tr>
					<td>'.$row['Text'].'</td><td align="right"><a href="editpage.php?page_id='.$row['ID'].'"><img src="../images/skin/default/bg/edit.png" alt="Edit" title="Edit"></a></td>
				</tr>';
							}
							echo'
				</table></p>';
						} elseif ($edit == "news") {
							echo '
				<div id="title">
					<span><a name="news"></a>Edit News</span>
					<div><!-- date --></div>
				</div>
				<p>
				<table class="editpage" cellpadding="8px" cellspacing="0px" width="100%"><tr>
					<td>Add News</td><td align="right"><a href="addnews.php"><img src="../images/skin/default/bg/add.png" alt="New" title="New"></a></td>
					</tr>';
								$query = mysql_query("SELECT * FROM News ORDER BY ID DESC");
								$x = 0;
								while($row = mysql_fetch_array($query)) {
									$title = $row['Title'];
									$n = 35;
									if(strlen($title) > $n) {
										$title2 = substr($title,0,$n);
										$title2 = $title2.'...';
									} else {
										$title2 = $title;
									}
									echo '
				<tr>
					<td>'.$title2.' || <i>'.$row['DatePosted'].' - '.$row['TimePosted'].'</i></td><td align="right"><a href="editnews.php?news_id='.$row['ID'].'"><img src="../images/skin/default/bg/edit.png" alt="Edit" title="Edit"></a></td>
				</tr>';
									$x = 1;
								}
								if ($x == 0) {
									echo '
				<tr>
					<td colspan="2"><center><small><i>There are no news posted.</i></small></center></td>
				</tr>';
								}
								echo'
				</table></p>
							';
						} else {
							header("Location: index.php");
						}
					} else {
							echo '
				<div id="title">
					<span>Administrator Panel</span>
					<div><!-- date --></div>
				</div>
				<p>
				Customize the content of your website!
				</p>';
					}
				}
				?>
			</div></div>
			<div id="sidebar"><div id="pad">
				<?php
				if($ok == 1) {
					echo '<div id="title"><span>Welcome</span></div>
				<p>Hello, '.$loggeduser.'!</p>
				<span class="button"><a href="logout.php" class="button">Logout</a></span>
				<div id="title"><span>Edit</span></div>
				<a href="index.php?edit=pages" class="button block">Pages</a>
				<a href="index.php?edit=news" class="button block">News</a>
				<a href="webstatus.php" class="button block">Status</a>
';
				} else  {
					echo '<div id="title"><span>Hello, Guest</span></div>
				<p>La la la,</p>
				<span class="button"><a href="../index.php" class="button">Back to Home</a></span>
';
				}
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
if((isset($_GET['addsuccess']) || isset($_GET['editsuccess']) || isset($_GET['deletesuccess'])) && (isset($_GET['edit']))) {
	echo '<div id="popup_box" onClick="document.getElementById(\'popup_box\').style.display = \'none\';">
You have successfully ';
	if(isset($_GET['addsuccess']))
		echo 'added';
	elseif(isset($_GET['editsuccess']))
		echo 'edited';
	elseif(isset($_GET['deletesuccess']))
		echo 'deleted';
	echo ' a ';
	if($_GET['edit'] == "news")
		echo 'news';
	echo '.<br><small>Click here to close this message</small>
</div>';
}
?>
</center>
</body>
</html>
