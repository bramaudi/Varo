<?php

if (!logged()) {
	redir('/?v=login');
}

$user = isset($_GET['user']) ? trim($_GET['user']):'';
$sql = "SELECT * FROM varo_users WHERE user = '$user'";
$data = $db->query($sql);

if ($data->num_rows > 0) {

$r = $data->fetch_assoc();

// level
if ($r['level'] < 2) {
	$level = '<font color="#1185D4">Administrator</font>';
} elseif ($r['level'] < 3) {
	$level = '<font color="#AE54C8">Moderator</font>';
} else {
	$level = '<font color="#B2D4B0">Member</font>';
}

// statistic
$posts = $db->query("SELECT id FROM varo_post WHERE author = ".$r['id'])->num_rows;
$comments = $db->query("SELECT id FROM varo_comment WHERE author = ".$r['id'])->num_rows;
$last = gmdate('d M Y', $r['online'] + (60*60*7));

$site = array(
'title' => $r['first'].' '.$r['last']
);

$is_friend = $db->query("SELECT id FROM varo_friend WHERE req_id = ".$logged['id']." AND rec_id = ".$r['id'])->num_rows;

// ban button
if ($r['ban']) {
	$url_ban = '/?v=ban&unmark='.$r['id'];
	$ic_ban = 'x';
	$var_ban = 'Un-banned';
} else {
	$url_ban = '/?v=ban&mark='.$r['id'];
	$ic_ban = 'ban';
	$var_ban = 'Banned';
}

// friend button
if ($r['id'] == $logged['id']) {
	$url_fl = '/?v=friend';
	$ic_fl = 'people';
	$var_fl = 'My Friend';
} elseif (!$is_friend) {
	$url_fl = '/control/control_manageFriend.php?a=add&req='.$logged['id'].'&rec='.$r['id'].'&ref='.rawurlencode('/?v=profile&user='.$r['user']);
	$ic_fl = 'plus';
	$var_fl = 'Add Friend';
} else {
	$url_fl = '/control/control_manageFriend.php?a=del&req='.$logged['id'].'&rec='.$r['id'].'&ref='.rawurlencode('/?v=profile&user='.$r['user']);
	$ic_fl = 'trash';
	$var_fl = 'Remove Friend';
}

if (empty($r['about'])) {
	$about = '«-- This guy is very lazy to leave any description. --»';
} else {
	$about = nl2br(htmlentities($r['about']));
}

require_once './view/view_header.php';
require_once './view/view_profile.php';
require_once './view/view_footer.php';

} else {

redir('/?v=404');

}