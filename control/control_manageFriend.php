<?php

if (!isset($_COOKIE['logged'])) {
	header('location: /');
}

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

$a = isset($_GET['a']) ? trim($_GET['a']):'';
$req = isset($_GET['req']) ? (int)$_GET['req']:'';
$rec = isset($_GET['rec']) ? (int)$_GET['rec']:'';
$ref = isset($_GET['ref']) ? rawurldecode($_GET['ref']):'';

if (empty($req) OR empty($rec) OR empty($ref)) {
	redir('/');
}

switch ($a) {
	
	default:
	redir('/');
	break;
	
	case 'add':
	$db->query("INSERT INTO varo_friend SET req_id = ".$req.", rec_id = ".$rec);
	redir($ref);
	break;
	
	case 'del':
	$db->query("DELETE FROM varo_friend WHERE req_id = ".$req." AND rec_id = ".$rec);
	redir($ref);
	break;
	
}