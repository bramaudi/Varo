<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

$name = filter($_GET['name']);

$sql = $db->query("SELECT * FROM varo_users WHERE first LIKE '%".$name."%' OR last LIKE '%".$name."%'");

if ($sql->num_rows > 0 && !empty($name) && strlen($name) > 1) {
	echo '
	<div class="title row">
	<a class="static">Search for "<b>'.htmlentities($name).'</b>"</a>
	</div>
	<div class="box">
	';
	while ($r = $sql->fetch_assoc()) {
		$is_friend = $db->query("SELECT id FROM varo_friend WHERE req_id = ".$logged['id']." AND rec_id = ".$r['id'])->num_rows;
		if (!$is_friend) {
			$ic = 'plus';
		} else {
			$ic = 'trash';
		}
		if ($r['id'] !== $logged['id']) {
		echo '
		<div class="row" style="padding: 5px 10px">
		<a href="/?v=profile&user='.$r['user'].'">
	<div class="profile_thumb" style="background:url(/files/'.$r['user'].'.jpg)no-repeat center center; background-size: cover;float:left;margin-right:10px;border:none"></div>
	<div style="float:left">'.userName($r['id']).'</div>
	</a>
	<a href="/control/control_manageFriend.php?a=add&req='.$logged['id'].'&rec='.$r['id'].'&ref='.rawurlencode('/?v=friend').'">
	<div style="float:right"><span class="oi" data-glyph="'.$ic.'" title="'.$ic.'" aria-hidden="true"></span></div>
	</a>
</div>
		';
		} // same id
	}
	echo '</div>'; // .box
} else {
	echo '<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> No result for "'.$name.'"</div>';
}