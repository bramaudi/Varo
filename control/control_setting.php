<?php

if (!logged()) {
	redir('/');
}

$set = $db->query("SELECT * FROM varo_users WHERE id = ".$logged['id'])->fetch_assoc();

$site = array(
'title' => 'Setting - Profile'
);

require_once './view/view_header.php';
require_once './view/view_setting.php';
require_once './view/view_footer.php';