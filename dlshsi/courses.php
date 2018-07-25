<?php
require_once('config.php');
$filename = basename($_SERVER['PHP_SELF']);
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
				<?php
				$query = mysql_query("SELECT * FROM Content, Navigation WHERE Content.Navigation = Navigation.ID AND Navigation.Link = '$filename'");
				$n = 0;
				while($row=mysql_fetch_array($query)) {
					echo '<div id="title">
					<span>'.$row['Title'].'</span>
				</div>
				<p>
				'.nl2br($row['Message']).'
				</p>
';
					$n = 1;
				}
				if($n == 0) {
					echo '<div id="title">
					<span>Error</span>
				</div>
				<p>
				No message to display.
				</p>
';
				}
				?>
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
