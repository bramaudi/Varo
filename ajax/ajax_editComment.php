<?php

require_once '../database.php';
require_once '../function.php';
require_once '../re_check.php';

if (!logged()) {
	redir('/');
}

// variables
$id = (int)$_POST['id'];
$text = filter($_POST['text']);
$ref = rawurldecode($_POST['ref']);
$n = 0;

// validation
if (empty($id)) {
	redir('/?v=404');
}

if (empty($text)) {
	$n = 1;
	$error = 'Cannot send empty comment.';
} elseif (strlen($text) < 1) {
	$n = 1;
	$warning = 'Text length cannot be less then 1 characters';
} elseif (!$n) {
	
	$db->query("UPDATE varo_comment SET text = '$text', edit_time = ".time().", edit_author = ".$logged['id']." WHERE id = ".$id);
	
	$success = 'Saved, redirecting ...';
}

// notification
if (isset($error)) {
	echo '<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> '.$error.'</div>';
}
if (isset($warning)) {
	echo '<div class="warning"><span class="oi" data-glyph="warning" title="warning" aria-hidden="true"></span> '.$warning.'</div>';
}
if (isset($success)) {
	echo '
	<meta http-equiv="refresh" content="1; url='.$ref.'#'.$id.'">
	<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> '.$success.'</div>';
}