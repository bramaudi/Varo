<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

if (!isset($_GET['from_id'])) {
	header('location: /');
}

$from_id = (int)$_GET['from_id'];

// pagination
$page = isset($_GET['page']) ? (int)$_GET['page']:'1';
$offset = 20;
$start = $offset * $page - $offset;

// seen
$db->query("UPDATE varo_messages SET seen = 1 WHERE from_id = ".$from_id." AND to_id = ".$logged['id']);

$sql = $db->query("SELECT * FROM (SELECT * FROM varo_messages WHERE from_id = ".$from_id." AND to_id = ".$logged['id']." OR to_id = ".$from_id." AND from_id = ".$logged['id']." ORDER BY id DESC LIMIT $start, $offset) s ORDER BY id ASC");

if ($sql->num_rows > 0){
while ($r = $sql->fetch_assoc()) {
// set seen notify
if ($r['seen']) {
	$seen = '<span class="seen">&radic;</span>';
} else {
	$seen = '&radic;';
}
// set selector
if ($r['from_id'] == $logged['id']) {
	// my messages
	$float = 'right';
	$class = 'from_me';
	$avatar_css = 'float:right;margin: 10px 0 0 10px';
} else {
	$float = 'left';
	$class = '';
	$avatar_css = 'float:left;margin: 10px 10px 0 0';
}

// date
$date_div = $db->query("SELECT id FROM varo_messages WHERE from_id = ".$from_id." AND to_id = ".$logged['id']." AND DATE(time) = DATE('".$r['time']."') OR to_id = ".$from_id." AND from_id = ".$logged['id']." AND DATE(time) = DATE('".$r['time']."') ORDER BY id LIMIT 1")->fetch_assoc();

if ($date_div['id'] == $r['id']) {
?>

<div class="row" align="center">
<div class="messages info" style="display: inline-block">
<?=timeFormat(timeSet($r['time'],'d F Y'))?>
</div>
</div>

<?php
}
?>

<div class="row">
<div class="messages <?=$class?>" style="float:<?=$float?>">
<?=nl2br($r['text'])?> &nbsp; <span class="messages-info">
 &nbsp; <?=timeSet($r['time'],'h:i A').' '.$seen?>
</span>
</div>
</div>

<?php
} //end while
} else {
?>

<div class="box" align="center">
<br><br>
<h4><span class="oi" data-glyph="envelope-open" title="envelope-open" aria-hidden="true"></span> No messages.</h4>
<br><br>
</div>

<?php
}