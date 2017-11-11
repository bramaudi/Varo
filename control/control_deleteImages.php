<?php

if (!logged()) {
	redir('/');
}

$id = isset($_GET['id']) ? (int)$_GET['id']:'';

$sql = $db->query("SELECT * FROM varo_images WHERE id = ".$id);

if (!$sql->num_rows) {
	redir('/?v=404');
}

$r = $sql->fetch_assoc();
$gallery = $r['gallery_id'];

if ($logged['level'] < 2 OR $logged['id'] == $r['author']) {
	
	$db->query("DELETE FROM varo_images WHERE id = ".$id);
	unlink('./images/'.$id.'.jpg');
	redir('/?v=album&id='.$gallery);
	
} else {
	redir('/?v=404');
}