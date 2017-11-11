<?php

if (!logged()) {
	redir('/');
}

$site = array(
'title' => 'Edit Comment'
);

$id = isset($_GET['id']) ? (int)$_GET['id']:'';
$comment = $db->query("SELECT * FROM varo_comment WHERE id = ".$id);

if (!$comment->num_rows) {
	redir('/?v=404');
} else {
	$r = $comment->fetch_assoc();
	if ($logged['id'] == $r['author'] OR $logged['level'] < 3) {
		// return true
	} else {
		redir('/?v=404');
	}
}

require_once './view/view_header.php';
require_once './view/view_editComment.php';
require_once './view/view_footer.php';