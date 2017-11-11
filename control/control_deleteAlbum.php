<?php

require_once './database.php';
require_once './function.php';
require_once './re_check.php';

if (!logged()) {
	redir('/');
} else {
	if ($logged['level'] > 2) {
		redir('/?v=404');
	}
}

$id = isset($_GET['id']) ? (int)$_GET['id']:'';

$sql = $db->query("DELETE FROM varo_gallery WHERE id = ".$id);

// delete linked images
$img = $db->query("SELECT * FROM varo_images WHERE gallery_id = ".$id);

while ($r = $img->fetch_assoc()) {
	unlink('./images/'.$r['id'].'.jpg');
}

$img->close();
$db->query("DELETE FROM varo_images WHERE gallery_id = ".$id);

redir('/?v=gallery');