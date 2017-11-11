<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

$userId = isset($_GET['user_id']) ? (int)$_GET['user_id']:'';

$data = $db->query("SELECT * FROM varo_users WHERE id = ".$userId);

if ($data->num_rows > 0) {
	$row = $data->fetch_assoc();
	echo online($row['online']);
} else {
	echo 'unknown';
}