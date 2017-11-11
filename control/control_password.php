<?php

if (!logged()) {
	redir('/');
}

$set = $db->query("SELECT * FROM varo_users WHERE id = ".$logged['id'])->fetch_assoc();

$site = array(
'title' => 'Setting - Password'
);

require_once './view/view_header.php';
require_once './view/view_password.php';
require_once './view/view_footer.php';