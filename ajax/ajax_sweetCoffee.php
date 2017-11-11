<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

// user online verify
$now = time();
$db->query("UPDATE varo_users SET online = $now WHERE id = ".$logged['id']);

// messages notify
$new_msg = $db->query("SELECT DISTINCT from_id FROM varo_messages WHERE seen = 0 AND to_id = ".$logged['id'])->num_rows;
if ($new_msg > 0) {
	echo '<span class="oi" data-glyph="envelope-closed" title="envelope-closed" aria-hidden="true"></span> '.$new_msg.' messages';
} else {
	echo '';
}