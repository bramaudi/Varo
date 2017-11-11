<?php

require_once './database.php';

$key = isset($_GET['key']) ? trim($_GET['key']):'';
$data = $db->query("SELECT * FROM varo_users WHERE `key` = '$key'");

if (empty($key) OR $data->num_rows == '0') {
	setcookie('logged','',time()-(3600*720),'/');
	redir('/');
} else {
	// give a new key
	$new_key = md5(time());
	$db->query("UPDATE varo_users SET `key` = '$new_key' WHERE `key` = '$key'");
	setcookie('logged',$new_key,time()+(3600*720),'/');
	redir('/');
}