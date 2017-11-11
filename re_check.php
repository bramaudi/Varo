<?php

// user logged verify
$key = isset($_COOKIE['logged']) ? $db->real_escape_string($_COOKIE['logged']):'';
$logged_sql = $db->query("SELECT * FROM varo_users WHERE `key` = '$key'");

if (isset($_COOKIE['logged'])) {
if ($logged_sql->num_rows == 0) {
	setcookie('logged','',time()-(3600*720));
	redir('/');
} else {
	$logged = $logged_sql->fetch_assoc();
	if ($logged['ban']) {
		setcookie('logged','',time()-(3600*720));
	redir('/');
	}
}
}