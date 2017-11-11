<?php

if (!logged()) {
	redir('/');
}

$id = isset($_GET['id']) ? (int)$_GET['id']:'';
$ref = isset($_GET['ref']) ? trim(rawurldecode($_GET['ref'])):'';

$sql = $db->query("SELECT * FROM varo_comment WHERE id = ".$id);
$row = $sql->fetch_assoc();

if ($logged['level'] < 3 OR $logged['id'] == $row['author']) {
	$db->query("DELETE FROM varo_comment WHERE id =".$id);
}

redir($ref);

$row->close();