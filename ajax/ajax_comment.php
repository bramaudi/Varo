<?php

require_once '../database.php';
require_once '../function.php';
require_once '../re_check.php';

if (!logged()) {
	redir('/');
}

// variables
$post_id = (int)$_POST['post_id'];
$text = filter($_POST['text']);
$n = 0;

// validation
if (empty($post_id)) {
	redir('/?v=404');
}

if (empty($text)) {
	$n = 1;
	$error = 'Cannot send empty text.';
} elseif (strlen($text) < 1) {
	$n = 1;
	$warning = 'Title length cannot be less then 1 characters';
} 

elseif (!$n) {
	
	$db->query("INSERT INTO varo_comment SET post_id = $post_id, text = '$text', author = ".$logged['id']);
	
	$db->query("UPDATE varo_post SET last = ".time()." WHERE id = ".$post_id);
	
	$success = 'Loading content ...';
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
	<meta http-equiv="refresh" content="1; url=">
	
	<div class="title row" style="padding: 10px">
<a href="/?v=profile&user='.userUser($logged['id']).'">
	<div class="profile_thumb" style="background:url(/files/'.userUser($logged['id']).'.jpg)no-repeat center center; background-size: cover;float:left;margin-right:10px;border:none"></div>
	<div style="display:inline-block;float:left">'.userName($logged['id']).'</div>
</a>
</div>
<div class="box item" align="center"><span class="oi" data-glyph="loop-circular" title="loop-circular" aria-hidden="true"></span> '.$success.'</div>
<hr>

	';
}