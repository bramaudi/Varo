<?php

require_once './view/view_header.php';
	
$forum = $db->query("SELECT * FROM varo_forum ORDER BY name");

// gallery stats
$albums = $db->query("SELECT id FROM varo_gallery")->num_rows;
$images = $db->query("SELECT id FROM varo_images")->num_rows;

// member stats
$member = $db->query("SELECT * FROM varo_users")->num_rows;
$new_member = $db->query("SELECT id FROM varo_users ORDER BY id DESC")->fetch_assoc();
$on_member = $db->query("SELECT * FROM varo_users WHERE online >= ".(time()-120))->num_rows;

require_once './view/view_home.php';

require_once './view/view_footer.php';