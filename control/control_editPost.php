<?php

if (!logged()) {
	redir('/');
}

$site = array(
'title' => 'Edit Post'
);

$id = isset($_GET['id']) ? (int)$_GET['id']:'';
$post = $db->query("SELECT * FROM varo_post WHERE id = ".$id);

if (!$post->num_rows) {
	redir('/?v=404');
} else {
	$r = $post->fetch_assoc();
	if ($logged['id'] == $r['author'] OR $logged['level'] < 2) {
		// return true
		} else {
			redir('/?v=404');
		}
}

require_once './view/view_header.php';
require_once './view/view_editPost.php';
require_once './view/view_footer.php';