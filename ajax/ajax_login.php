<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (logged()) {
	redir('/');
}

// variables
$mail = filter($_POST['mail']);
$pass = $_POST['pass'];

// validation
$db_mail = $db->real_escape_string($mail);

$db_pass = md5(md5(md5($pass)));

$sql = $db->query("SELECT * FROM varo_users WHERE email = '$db_mail' AND pass = '$db_pass'");

$data = $sql->fetch_assoc();
$n = 0;
	
if (empty($mail) OR empty($pass)) {
	$n = 1;
	$warning = 'Input valid account.';
} elseif (!$sql->num_rows) {
	$n = 1;
	$error = 'Account is not valid.';
} elseif ($data['ban']) {
	$n = 1;
	$error = 'Account is banned.';
} elseif (!$n) {
	$success = 'Login success, redirecting ...';
}

// notification
if (isset($error)) {
	echo '<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> '.$error.'</div>';
}
if (isset($success)) {
	echo '
	<meta http-equiv="refresh" content="1; url=/?v=cookie&key='.$data['key'].'">
	<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> '.$success.'</div>
	';
}
if (isset($warning)) {
	echo '<div class="warning"><span class="oi" data-glyph="warning" title="warning" aria-hidden="true"></span> '.$warning.'</div>';
}