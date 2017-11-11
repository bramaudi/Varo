<?php

if (!logged()) {
	redir('/');
}

$site = array(
'title' => 'Friends'
);

$my_friend = $db->query("SELECT * FROM varo_friend WHERE req_id = ".$logged['id']);

require_once './view/view_header.php';
require_once './view/view_friend.php';
require_once './view/view_footer.php';