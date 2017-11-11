<?php

require_once '../database.php';
require_once '../function.php';

if (!isset($_POST['mail'])) {
	header('location: /');
}

// variable
$key = md5(md5(microtime()));
$user = rand(0001111111, 9999999999);
$mail = filter($_POST['mail']);
$first = filter($_POST['first']);
$last = filter($_POST['last']);
$pass = $_POST['pass'];
$repass = $_POST['repass'];
$chk_mail = $db->query("SELECT * FROM varo_users WHERE email = '$mail'")->num_rows;
$n = 0;

// validation
if (empty($mail) OR empty($pass) OR empty($repass) OR empty($first) OR empty($last)) {
	$n = 1;
	$warning = 'Input valid account.';
} elseif (strlen($first) < 1) {
	$n = 1;
	$warning = 'First name minimum is 3 characters';
} elseif (strlen($first) > 10) {
	$n = 1;
	$warning = 'First name maximum is 10 characters';
} elseif (strlen($last) < 1) {
	$n = 1;
	$warning = 'Last name minimum is 3 characters';
} elseif (strlen($last) > 10) {
	$n = 1;
	$warning = 'Last name maximum is 10 characters';
} elseif ($chk_mail > 0) {
	$n = 1;
	$error = 'Email already exists.';
} elseif ($pass != $repass) {
	$n = 1;
	$error = 'Password do not match.';
} elseif (!$n) {
	$pass = md5(md5(md5($pass)));
	
	$db->query("INSERT INTO varo_users SET first = '$first', last = '$last', email = '$mail', user = '$user', pass = '$pass', `key` = '$key'");
	
	copy('../picture.jpg','../files/'.$user.'.jpg');
	
	$success = 'Registration compete, redirecting to login page ...';
}

// notification
if (isset($error)) {
	echo '<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> '.$error.'</div>';
}
if (isset($success)) {
	echo '
	<meta http-equiv="refresh" content="2; url=/?v=login">
	<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> '.$success.'</div>
	';
}
if (isset($warning)) {
	echo '<div class="warning"><span class="oi" data-glyph="warning" title="warning" aria-hidden="true"></span> '.$warning.'</div>';
}