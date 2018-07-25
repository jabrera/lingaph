<?php
require_once('config.php');
$filename = basename($_SERVER['PHP_SELF']);

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$searchEmailAt = strpos($email, '@');
	$searchEmailDot = strpos($email, '.');
	$message = mysql_real_escape_string($_POST['message']);
	$message2 = nl2br($_POST['message']);
	if (!$name || !$email || !$message) {
		header("Location: contact.php?error=1&name=".$name."&email=".$email);
	} elseif ($searchEmailAt == 0 || $searchEmailDot == 0) {
		header("Location: contact.php?error=2&name=".$name);
	} else {
		$date = date('F d Y - h:i:s A');
		$emailMessage = nl2br($message);
		$emailSubject = "DLSHSI LINGHAP - Form Message";
		$webmaster = 'juvar.abrera2@gmail.com';
		$emailStyle = '<style type="text/css">table {font-family:trebuchet ms;background:#222;color:white;} table tr td:first-child {font-weight:bold;}</style>';
		$emailContent = '<table cellpadding="10px"><tr><td>Name:</td><td>'.$name.'</td></tr><tr><td>Email:</td><td>'.$email.'</td></tr><tr valign="top"><td>Message:</td><td>'.$emailMessage.'</td></tr></table>';
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: ".$name." <".$email.">\r\n"; 
		mail($webmaster, $emailSubject, $emailStyle.$emailContent, $headers);
		header("Location: contact.php?success");
	}
}
?>
<html>
<head>
	<title>LINGHAP</title>
	<link rel="stylesheet" href="styles/style.css"/>
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
			<?php
			$query = mysql_query("SELECT * FROM Navigation ORDER BY ID ASC");
			while($row=mysql_fetch_array($query)) {
				$selected = ' href="'.$row['Link'].'"';
				if($filename == $row['Link'])
					$selected = ' class="selected"';
				echo '<a'.$selected.'>'.$row['Text'].'</a>
			';
			}
			?>
		</div>
	</div>
	<div id="content">
		<div id="content_base">
			<div id="center"><div id="pad">
				<div id="title">
					<span>Message</span>
				</div>
				<p>
				<?php
				if(isset($_GET['error'])) {
					if($_GET['error'] == 1) 
						echo 'Please fill up the form properly.';
					elseif($_GET['error'] == 2)
						echo 'Invalid format of email.';
					else
						echo 'Unknown error.';
				} elseif (isset($_GET['success'])) {
						echo 'You message has been successfully sent.';
				} else {
					echo 'Fill up the form to send a message';
				}
				?>
				</p>
				<div id="title">
					<span>Contact</span>
				</div>
				<p>
				<form action="contact.php" method="post">
				<table width="100%" cellpadding="10px" cellspacing="0px">
					<tr>
						<td width="100px">Name:</td><td><input type="text" class="custom" placeholder="Name" name="name"<?php if(isset($_GET['name'])) echo ' value="'.$_GET['name'].'"';?>></td>
					</tr>
					<tr>
						<td>Email:</td><td><input type="text" class="custom" placeholder="example@xxx.yyy" name="email"<?php if(isset($_GET['email'])) echo ' value="'.$_GET['email'].'"';?>></td>
					</tr>
					<tr valign="top">
						<td>Message:</td><td><textarea class="custom" placeholder="Your message here..." name="message"><?php if(isset($_GET['message'])) echo nl2br($_GET['message']);?></textarea></td>
					</tr>
					<tr valign="top">
						<td></td><td><input type="submit" value="Send"></td>
					</tr>
				</table>
				</form>
				</p>
			</div></div>
			<div id="sidebar"><div id="pad">
				<div id="title"><span>Latest News</span></div>
				<?php
				$query = mysql_query("SELECT * FROM News ORDER BY id DESC LIMIT 3");
				$n = 0;
				while ($row=mysql_fetch_array($query)) {
					$id = $row['ID'];
					$title = $row['Title'];
					$date = $row['DatePosted'];
					if(strlen($title) > 35) {
						$title2 = substr($title,0,35);
						$title2 = $title2.'...';
					} else {
						$title2 = $title;
					}
					echo '<p>
				'.$date.' | '.$title2.'
				</p>
				<span class="button"><a href="news.php?read='.$id.'" class="button">View Full Article</a></span>';
					echo '
				<hr>
';
					$n = 1;
				}
				if($n == 0) {
					echo '<p>No news posted in this website.</p>';
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
			<td align="right">Web Design by <a href="#">Juvar Abrera</a><br><a href="admin/">Administrator Login</a></td>
		</tr>
	</table>
	</div>
</div>
</center>
</body>
</html>
