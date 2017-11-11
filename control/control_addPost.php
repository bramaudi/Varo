<?php

if (!logged()) {
	redir('/');
}

$site = array(
'title' => 'Add Post'
);

$forum_id = isset($_GET['forum_id']) ? (int)$_GET['forum_id']:'';
$forum = $db->query("SELECT * FROM varo_forum WHERE id = ".$forum_id)->num_rows;

if (!$forum) {
	redir('/?v=404');
}

require_once './view/view_header.php';
require_once './view/view_addPost.php';
require_once './view/view_footer.php';