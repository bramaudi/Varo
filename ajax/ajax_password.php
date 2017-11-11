<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

// variables
$my_key = $_COOKIE['logged'];
$old = md5(md5(md5($_POST['old'])));
$new = $_POST['new'];
$ver = $_POST['ver'];

// validation
$check = $db->query("SELECT * FROM varo_users WHERE `key` = '$my_key' AND pass = '$old'")->num_rows;
$n = 0;
	
if (empty($old) OR empty($new) OR empty($ver)) {
	$n = 1;
	$warning = 'All field cannot be empty.';
} elseif ($check == 0) {
	$n = 1;
	$error = 'Old password is wrong.';
} elseif ($new != $ver) {
	$n = 1;
	$warning = 'New password not match.';
} elseif (!$n) {
	$new_pass = md5(md5(md5($ver)));
	$sql = $db->query("UPDATE varo_users SET pass = '$new_pass' WHERE `key` = '$my_key'");
	$success = 'Saved, redirecting ...';
}

// notification
if (isset($error)) {
	echo '<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> '.$error.'</div>';
}
if (isset($success)) {
	echo '
	<meta http-equiv="refresh" content="2; url=/?v=password">
	<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> '.$success.'</div>
	';
}
if (isset($warning)) {
	echo '<div class="warning"><span class="oi" data-glyph="warning" title="warning" aria-hidden="true"></span> '.$warning.'</div>';
}