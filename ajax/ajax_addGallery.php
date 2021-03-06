<?php

require_once '../database.php';
require_once '../function.php';
require_once '../re_check.php';

if (!logged()) {
	redir('/');
}

if ($logged['level'] > 1) {
	header('location: /');
}

// variables
$name = filter($_POST['name']);
$n = 0;

// validation
if (empty($name)) {
	$n = 1;
	$error = 'Empty name not allowed';
} elseif (strlen($name) < 2) {
	$n = 1;
	$error = 'Min 2 character';
} elseif (strlen($name) > 255) {
	$n = 1;
	$error = 'Max 50 character';
} elseif (!$n) {
	
	$db->query("INSERT INTO varo_gallery SET name = '$name'");
	
	$success = 'Done, refreshing ...';
}

// notification
if (isset($error)) {
	echo '<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> '.$error.'</div>';
}
if (isset($success)) {
	echo '
	<meta http-equiv="refresh" content="1; url=/?v=gallery">
	<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> '.$success.'</div>
	';
}