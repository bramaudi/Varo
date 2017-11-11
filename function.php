<?php
date_default_timezone_set('Asia/Jakarta');

// redirection
function redir($url) {
	header('location: '.$url);
	exit;
}

// logged
function logged() {
	if (isset($_COOKIE['logged'])) {
		return true;
	} else {
		return false;
	}
}

// filter input
function filter($n) {
	
	require 'database.php';
	
	$n = $db->real_escape_string($n);
	$n = trim($n);
	$n = htmlentities($n);
	return $n;
}

// compress image
function compress($source, $destination, $quality) {
	
	$info = getimagesize($source);
	if ($info['mime'] == 'image/jpeg') {
	$image = imagecreatefromjpeg($source);
	} elseif ($info['mime'] == 'image/gif') {
	$image = imagecreatefromgif($source);
	} elseif ($info['mime'] == 'image/png') {
	$image = imagecreatefrompng($source);
	}
	imagejpeg($image, $destination, $quality);
	return $destination;
}

// get user username
function userUser($userId) {
	require 'database.php';
	$data = $db->query("SELECT * FROM varo_users WHERE id = ".$userId);
	if ($data->num_rows > 0) {
		$row = $data->fetch_assoc();
		return $row['user'];
	} else {
		return 'unknown';
	}
}

// get user first + last name
function userName($userId) {
	require 'database.php';
	$data = $db->query("SELECT * FROM varo_users WHERE id = ".$userId);
	if ($data->num_rows > 0) {
		$row = $data->fetch_assoc();
		if (!$row['ban']) {
			return '<strong>'.$row['first'].' '.$row['last'].'</strong>';
			} else {
			return '<s>'.$row['first'].' '.$row['last'].'</s>';
			}
	} else {
		return 'unknown';
	}
}

// readmore
function readmore($text, $num) {
if (strlen($text) > $num) {
$kata = trim(strip_tags($text));
$kata = substr($kata,0,($num+1));
$kata = substr($kata,0,strrpos($kata,' '));
return $kata.' ...';
} else {
return $text;
}
}

// format time
function timeSet($timestamp, $format) {
// set default timezones in mysql
// gmt+7
$time = strtotime($timestamp)+(60*60*7);
return gmdate($format, $time);
}

// re format time
function timeFormat($time) {
	$date = date('d', strtotime($time));
	if ($date == date('d')) {
		return 'Today';
	} elseif ($date == (date('d')-1)) {
		return 'Yesterday';
	} else {
		return $time;
	}
}

// text system
function setText($n) {
	$array = array(
"'\[q\](.+?)\[/q\]'is"=>" <div class='quote'>$1</div> ",
"'\[red\](.*?)\[/red\]'is"=>" <font color='red'>$1</font> ",
"'\[green\](.*?)\[/green\]'is"=>" <font color='green'>$1</font> ",
"'\[blue\](.*?)\[/blue\]'is"=>" <font color='blue'>$1</font> ",
"'\*(.*?)\*'is"=>" <b>$1</b> ",
"'_(.*?)_'is"=>" <i>$1</i> ",
"'\[u\](.*?)\[/u\]'is"=>" <u>$1</u> ",
"'\[img=(.*?)\]'is"=>" <a href='/?v=images&id=$1'><img src='/images/$1.jpg' alt='image' title='Image'/></a> ",
"'\[code\](.*?)\[/code\]'is"=>" <textarea rows='2'>$1</textarea> ",
"/(\R){2,}/"=>"<br/><br/>"
);
	$so = preg_replace_callback('~\\[url=(https?://.+?)\\](.+?)\\[/url\\]|(https?://(www.)?[0-9a-z\.-]+\.[0-9a-z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', function ($anu)
{
if (!isset($anu[3])) {
return '<a href="'.$anu[1].'" rel="nofollow" target="_blank">'.$anu[2].'</a>';
} else {
return '<a href="'.$anu[3].'" rel="nofollow" target="_blank">'.$anu[3].'</a>';
}
}, $n);
	$so = preg_replace(array_keys($array), array_values($array), $so);
	return $so;
}

function no_quote($n) {
	return preg_replace('/\[q\](.+?)\[\/q\]/is','',$n);
}

// onlineStats
function online($time) {
	// 120 sec = 2 minute
	if (time() - $time <= 120) {
		echo '<span style="color:green; font-size: x-small;">(online)</span>';
	} else {
		echo '<span style="color: #aaa; font-size: x-small;">(offline)</span>';
	}
}