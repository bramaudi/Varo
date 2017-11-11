<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

if (!isset($_POST['message'])) {
	header('location: /');
}

// variables
$to_id = (int)$_POST['to_id'];
$from_id = (int)$_POST['from_id'];
$text = filter($_POST['message']);
$n = 0;

if (empty($text)) {
	$n = 1;
	$error = 'Cannot send empty message';
} elseif (empty($from_id) OR empty($to_id)) {
	$n = 1;
	$error = 'Error: no response';
} elseif (!$n) {
	$text = preg_replace("/(\R){2,}/", "<br/><br/>", $text);
	$db->query("INSERT INTO varo_messages SET to_id = $to_id, from_id = $from_id, text = '$text'");
}

// notification
if (isset($error)) {
	echo '<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> '.$error.'</div>';
}