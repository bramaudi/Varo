<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

$sql = $db->query("SELECT DISTINCT to_id FROM varo_messages WHERE  from_id = ".$logged['id']." ORDER BY time DESC");
$num = $sql->num_rows;

if ($num == 0) {
?>

<div class="sub-item">
<div class="container" align="center">
No messages
</div>
</div>

<?php
} else {
while ($row = $sql->fetch_assoc()) {

$r = $db->query("SELECT * FROM varo_messages WHERE from_id = ".$row['to_id']." AND to_id = ".$logged['id']." OR from_id = ".$logged['id']." AND to_id = ".$row['to_id']." ORDER BY time DESC LIMIT 1")->fetch_assoc();

if ($r['from_id'] == $logged['id']) {
	$info = '<span class="oi" data-glyph="share" title="share" aria-hidden="true"></span> &nbsp;';
} elseif (!$r['seen']) {
	$info = '<font color="red">*</font> ';
} else {
	$info = '';
}
?>

<span class="link" data-target="/?v=messages&from_id=<?=$row['to_id']?>">
<div class="row sub-item">

<div class="avatar-lg" style="display:inline-block;background:url(/files/<?=userUser($row['to_id'])?>.jpg)no-repeat center center; background-size: cover;border:none;float:left;margin: 0 10px 0 0"></div>
<b><?=userName($row['to_id'])?></b>
<br>
<?=$info.readmore($r['text'], 20)?>
</div>
</span>

<?php
}
}
?>

<script>$('.link').click(function(){
	var url = $(this).attr('data-target');
	window.location = url;
});</script>