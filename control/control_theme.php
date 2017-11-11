<?php

if (!logged()) {
	redir('/?v=404');
}

$color = isset($_GET['color']) ? trim($_GET['color']):'';
$ref = isset($_GET['ref']) ? trim($_GET['ref']):'';

switch ($color) {
	default:
	$theme = '0';
	break;
	
	case 'blue':
	$theme = '066D97';
	break;
	
	case 'dark-blue':
	$theme = '020D45';
	break;
	
	case 'orange':
	$theme = '974413';
	break;
	
	case 'green':
	$theme = '2D5C1D';
	break;
	
	case 'chocolate':
	$theme = '68401B';
	break;
	
	case 'purple':
	$theme = '6D2281';
	break;
	
	case 'pink':
	$theme = 'CA206C';
	break;
	
	case 'gray':
	$theme = '222';
	break;
	
	case 'black':
	$theme = '000';
	break;
}

$db->query("UPDATE varo_users SET theme = '".$theme."' WHERE id = ".$logged['id']);

redir(rawurldecode($ref));