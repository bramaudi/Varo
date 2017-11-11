<?php

require_once './database.php';
require_once './function.php';
require_once './re_check.php';

$id = isset($_GET['id']) ? (int)$_GET['id']:'';

if (!logged()) {
	redir('/');
}

if ($logged['level'] < 2) {
	
	// delete forum
	$db->query("DELETE FROM varo_forum WHERE id = ".$id);
	
	// loop post
	$post = $db->query("SELECT id FROM varo_post WHERE forum_id = ".$id);
	while ($post_r = $post->fetch_assoc()) {
		
		// loop comment
		$comment = $db->query("SELECT id FROM varo_comment WHERE post_id = ".$post_r['id']);
		while ($cmt_r = $comment->fetch_assoc()) {
			
			// delete comment
			$db->query("DELETE FROM varo_comment WHERE id = ".$cmt_r['id']);
			
		}
		
		// delete post
		$db->query("DELETE FROM varo_post WHERE id = ".$post_r['id']);
		
	}
	
	redir('/');
	
} else {
	redir('/?v=404');
}