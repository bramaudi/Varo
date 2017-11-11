<?php

require_once '../database.php';
require_once '../function.php';
require_once '../re_check.php';

if (!logged()) {
	redir('/');
}

// variables
$forum_id = (int)$_POST['forum_id'];
$title = filter($_POST['title']);
$text = filter($_POST['text']);
$n = 0;

// validation
if (empty($forum_id)) {
	redir('/?v=404');
}

if (empty($title) OR empty($text)) {
	$n = 1;
	$error = 'Fill all the form.';
} elseif (strlen($title) < 3) {
	$n = 1;
	$warning = 'Title length cannot be less then 3 characters';
} elseif (strlen($title) > 255) {
	$n = 1;
	$warning = 'Title length cannot be more then 255 characters';
} elseif (strlen($text) < 5) {
	$n = 1;
	$warning = 'Text length cannot be less then 5 characters';
} elseif (!$n) {
	
	$db->query("INSERT INTO varo_post SET forum_id = $forum_id, title = '$title', text = '$text', author = ".$logged['id']);
	
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
	<meta http-equiv="refresh" content="1; url=/?v=post&id='.$db->insert_id.'">
	<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> '.$success.'</div>';
}