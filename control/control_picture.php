<?php

if (!logged()) {
	redir('/');
}

$site = array(
'title' => 'Setting - Picture'
);

$set = $db->query("SELECT * FROM varo_users WHERE `key` = '".$_COOKIE['logged']."'")->fetch_assoc();

require_once './view/view_header.php';
require_once './view/view_picture.php';
require_once './view/view_footer.php';