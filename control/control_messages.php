<?php

$from_id = isset($_GET['from_id']) ? (int)$_GET['from_id']:'';

$valid = $db->query("SELECT id FROM varo_users WHERE id = ".$from_id)->num_rows;
if (!$valid) {
	redir('/?v=404');
}

$site = array(
'title' => strip_tags(userName($from_id))
);

// pagination
$page = isset($_GET['page']) ? (int)$_GET['page']:'1';
$offset = 20;
$total = $db->query("SELECT * FROM varo_messages WHERE from_id = ".$from_id." AND to_id = ".$logged['id']." OR to_id = ".$from_id." AND from_id = ".$logged['id'])->num_rows;
$sum = ceil($total/$offset);

require_once './view/view_header.php';
require_once './view/view_messages.php';
require_once './view/view_footer.php';