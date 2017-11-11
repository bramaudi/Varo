<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

$sql = $db->query("SELECT DISTINCT from_id FROM varo_messages WHERE to_id = ".$logged['id']." ORDER BY time DESC");
$num = $sql->num_rows;

if ($num == 0) {
?>

<div class="box" align="center">
<br>
<br>
<h4><span class="oi" data-glyph="envelope-open" title="envelope-open" aria-hidden="true"></span> No messages.</h4>
<br>
<br>
</div>

<?php
} else {
while ($row = $sql->fetch_assoc()) {

$r = $db->query("SELECT * FROM varo_messages WHERE from_id = ".$row['from_id']." AND to_id = ".$logged['id']." OR from_id = ".$logged['id']." AND to_id = ".$row['from_id']." ORDER BY time DESC LIMIT 1")->fetch_assoc();

if ($r['from_id'] == $logged['id']) {
	$info = '<span class="oi" data-glyph="share" title="share" aria-hidden="true"></span> &nbsp;';
} elseif (!$r['seen']) {
	$info = '<font color="yellow">*</font> ';
} else {
	$info = '';
}
?>

<a href="/?v=messages&from_id=<?=$row['from_id']?>">
<div class="row">
<div class="profile_thumb" style="display:inline-block;background:url(/files/<?=userUser($row['from_id'])?>.jpg)no-repeat center center; background-size: cover;border:none;float:left;margin: 15px 10px 0 0"></div>
<div class="messages" style="float:left">
<b><?=userName($row['from_id'])?></b>
<br>
<?=$info.readmore($r['text'], 20)?>
</div>
</div>
</a>

<?php
}
}