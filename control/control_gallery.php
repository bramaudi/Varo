<?php

if (!logged()) {
	redir('/');
}

$site = array(
'title' => 'Gallery'
);

$sql = $db->query("SELECT * FROM varo_gallery ORDER BY name");

// new upload
$img = $db->query("SELECT * FROM varo_images ORDER BY id DESC LIMIT 9");

require_once './view/view_header.php';
require_once './view/view_gallery.php';
require_once './view/view_footer.php';