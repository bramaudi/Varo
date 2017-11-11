<?php

$forum_id = isset($_GET['id']) ? (int)$_GET['id']:'';

$forum = $db->query("SELECT * FROM varo_forum WHERE id = ".$forum_id);

if (!$forum->num_rows) {
	
	redir('/?v=404');
	
} else {

// forum post pagination
$offset = 20;
$page = isset($_GET['page']) ? trim($_GET['page']):'1';
$start = $offset * $page - $offset;
$total = $db->query("SELECT * FROM varo_post WHERE forum_id = ".$forum_id)->num_rows;
$sum = ceil($total/$offset);
$ref = preg_replace('/&page=(.+)/','',$_SERVER['REQUEST_URI']);

$r = $forum->fetch_assoc();

$site = array(
'title' => $r['name']
);

require_once './view/view_header.php';

require_once './view/view_forum.php';

}

require_once './view/view_footer.php';