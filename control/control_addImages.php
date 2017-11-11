<?php

if (!logged()) {
	redir('/');
}

$site = array(
'title' => 'Upload Images'
);

$gallery_id = isset($_GET['gallery_id']) ? (int)$_GET['gallery_id']:'';

$sql = $db->query("SELECT * FROM varo_gallery WHERE id = ".$gallery_id);

if (!$sql->num_rows) {
	redir('/?v=404');
}

$gallery = $sql->fetch_assoc();

require_once './view/view_header.php';
require_once './view/view_addImages.php';
require_once './view/view_footer.php';