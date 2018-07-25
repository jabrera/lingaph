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
				$directory = "images/resources/gallery/";
				if(file_exists($directory)) {
					$n = 0;
					foreach (glob("*".$directory."*.jpg") as $filename) {
						$filename2 = str_replace($directory, '', $filename);
						$filename2 = str_replace('.jpg', '', $filename2);
						$photoDesc = $directory.$filename2.'.txt';
						$fh = fopen($photoDesc, 'r');
						$photoDesc = fread($fh, filesize($photoDesc));
						fclose($fh);
						$photoDesc = explode('||', $photoDesc);
						if($photoDesc[0] == "") {
							$photoDesc[0] = "Untitled";
						}
						if($photoDesc[1] == "") {
							$photoDesc[1] = "Description unavailable.";
						}
						$n++;
						echo '
				<div id="title">
					<span>'.$photoDesc[0].'</span>
				</div>
				<p>
				<img src="'.$filename.'" width="100%" class="gallery"><hr>'.nl2br($photoDesc[1]);
					}
					if($n == 0) {
						echo '
					<a style="display:block;background:#017b0e;border-bottom:4px solid #004f08;text-align:center;padding:100px 0px 100px 0px;">There are no photos posted in this page.</a>';
					}
				}
				?>
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
