<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!isset($_POST['mail'])) {
	header('location: /');
}

// variables
$mail = filter($_POST['mail']);
$first = filter($_POST['first']);
$last = filter($_POST['last']);
$about = filter($_POST['about']);
$n = 0;

// validation
if (empty($mail) OR empty($first) OR empty($last)) {
	$n = 1;
	$error = 'Data is not valid';
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
} elseif (strlen($about) > 255) {
	$n = 1;
	$warning = 'About content maximum 255 is characters';
} elseif (!$n) {
	
	$db->query("UPDATE varo_users SET first = '$first', last = '$last', about = '$about', email = '$mail' WHERE `key` = '".$_COOKIE['logged']."'");
	
	$success = 'Setting was saved successfully, resfresh automatically ...';
}

// notification
if (isset($error)) {
	echo '<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> '.$error.'</div>';
}
if (isset($success)) {
	echo '
	<meta http-equiv="refresh" content="1; url=/?v=setting">
	<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> '.$success.'</div>
	';
}
if (isset($warning)) {
	echo '<div class="warning"><span class="oi" data-glyph="warning" title="warning" aria-hidden="true"></span> '.$warning.'</div>';
}