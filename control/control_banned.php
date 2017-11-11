<?php

if (!logged() OR logged() && $logged['id'] > 1) {
	redir('/');
}


// mark as banned
if (isset($_GET['unmark'])) {
	
	$id = (int)$_GET['unmark'];
	
	$sql = $db->query("SELECT * FROM varo_users WHERE id = ".$id);
	if (!$sql->num_rows) {
		redir('/?v=404');
	} else {
		
		$row = $sql->fetch_assoc();
		if ($row['level'] < 2) {
			redir('/?v=404');
		} else {
			$db->query("UPDATE varo_users SET ban = 0 WHERE id = ".$id);
			redir('/?v=profile&user='.$row['user']);
		}
		
	}
	
} elseif (isset($_GET['mark'])) {
	
	// remove banned
	
	$id = (int)$_GET['mark'];
	
	$sql = $db->query("SELECT * FROM varo_users WHERE id = ".$id);
	if (!$sql->num_rows) {
		redir('/?v=404');
	} else {
		
		$row = $sql->fetch_assoc();
		if ($row['level'] < 2) {
			redir('/?v=404');
		} else {
			$db->query("UPDATE varo_users SET ban = 1 WHERE id = ".$id);
			redir('/?v=profile&user='.$row['user']);
		}
		
	}
	
}