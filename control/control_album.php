<?php

if (!logged()) {
	redir('/');
}

$id = isset($_GET['id']) ? (int)$_GET['id']:'';

$album = $db->query("SELECT * FROM varo_gallery WHERE id = ".$id);

if (!$album->num_rows) {
	
	redir('/?v=404');
	
}

// forum post pagination
$offset = 15;
$page = isset($_GET['page']) ? trim($_GET['page']):'1';
$start = $offset * $page - $offset;
$total = $db->query("SELECT * FROM varo_images WHERE gallery_id = ".$id)->num_rows;
$sum = ceil($total/$offset);
$ref = preg_replace('/&page=(.+)/','',$_SERVER['REQUEST_URI']);

$r = $album->fetch_assoc();

// images
$images = $db->query("SELECT * FROM varo_images WHERE gallery_id = ".$r['id']." ORDER BY id DESC LIMIT $start,$offset");

$site = array(
'title' => $r['name']
);

require_once './view/view_header.php';
require_once './view/view_album.php';
require_once './view/view_footer.php';