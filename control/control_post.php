<?php

$id = isset($_GET['id']) ? (int)$_GET['id']:'';

$sql = $db->query("SELECT * FROM varo_post WHERE id = ".$id);

if (!$id) {
	redir('/?v=404');
}

if (!$sql->num_rows) {
	redir('/?v=404');
}

// post comment pagination
$offset = 27;
$page = isset($_GET['page']) ? trim($_GET['page']):'1';
$start = $offset * $page - $offset;
$total = $db->query("SELECT * FROM varo_comment WHERE post_id = ".$id)->num_rows;
$sum = ceil($total/$offset);
$ref = preg_replace('/&page=(.+)/','',$_SERVER['REQUEST_URI']);

$r = $sql->fetch_assoc();

// delete post
if (logged() && isset($_GET['del'])) {
	if ($logged['level'] < 2 OR $r['author'] == $logged['id']) {
	$forum_id = $r['forum_id'];
	$del = $db->query("DELETE FROM varo_post WHERE id = ".$_GET['del']);
	if ($del) {
		redir('/?v=forum&id='.$forum_id);
	} else {
		redir('#');
	}
	} else { // endif admin/author
		redir('#');
	}
}

$title = trim(htmlentities($r['title']));

$site = array(
'title' => $title
);

require_once './view/view_header.php';
require_once './view/view_post.php';
require_once './view/view_footer.php';