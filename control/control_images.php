<?php

if (!logged()) {
	redir('/');
}

$site = array(
'title' => 'View Image'
);

$id = isset($_GET['id']) ? (int)$_GET['id']:'';

$sql = $db->query("SELECT * FROM varo_images WHERE id = ".$id);

if (!$sql->num_rows) {
	redir('/?v=404');
}

$r = $sql->fetch_assoc();

$gallery = $db->query("SELECT * FROM varo_gallery WHERE id = ".$r['gallery_id'])->fetch_assoc();

require_once './view/view_header.php';
require_once './view/view_image.php';
require_once './view/view_footer.php';