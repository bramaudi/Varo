<div class="row">
<span class="link" style="float:left" data-target="/">
<span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Back</span>

<?php
if (logged() && $logged['level'] < 2) {
?>

<span style="float:right" onclick="xPopup('#delConfirm')">
&nbsp; <span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span> &nbsp;</span>

<span style="float:right" onclick="xPopup('#rename')">
&nbsp; <span class="oi" data-glyph="pencil" title="pencil" aria-hidden="true"></span> &nbsp;</span>

<div id="delConfirm" class="popup" style="display: none">
<div class="popup-content">
Delete this forum and all post inside?<br/>
<span style="float: right">
<a onclick="xPopup('#delConfirm')"><button><span class="oi" data-glyph="x"></span> Cancel</button></a> &nbsp; <a href="/?v=deleteForum&id=<?=$r['id']?>"><button><span class="oi" data-glyph="trash"></span> Ok</button></a>
</span>
</div>
</div>

<?php
}
if (logged()) {
?>

<span class="link" style="float:right" data-target="/?v=addPost&&forum_id=<?=$r['id']?>">
<span class="oi" data-glyph="plus" title="plus" aria-hidden="true"></span> Post &nbsp;</span>

<?php
}
?>

</div>

<hr>

<?php
if (logged() && $logged['level'] < 2) {
?>

<div id="rename" style="display: none">
<label>Rename forum:</label>
<div id="not"></div>
<form id="edit">
<input type="hidden" name="id" value="<?=$r['id']?>"/>
<input type="text" value="<?=$r['name']?>" name="forum" required>
<button>Set</button>
</form>
</div>

<?php
}
?>

<div class="box">
<div class="box-title"><?=$r['name']?></div>

<div class="box-item">

<?php
$post = $db->query("SELECT * FROM varo_post WHERE forum_id = ".$r['id']." ORDER BY last LIMIT $start,$offset");

if (!$post->num_rows) {
?>

<center>No post.</center>

<?php
} else {
	while ($post_r = $post->fetch_assoc()) {
?>

<span class="link" data-target="?v=post&id=<?=$post_r['id']?>">
<span class="oi" data-glyph="document" title="document" aria-hidden="true"></span> <?=$post_r['title']?>
</span>

<?php
	}
}
?>

</div>
</div> <!-- .box -->

<?php
if ($total > $offset) {
?>

<div class="row">

<?php
// previous
if ($page <= $sum && $page >= 2) {
?>

<span class="link" style="float:left" data-target="<?=$ref?>&page=<?=($page-1)?>"><button><span class="oi" data-glyph="chevron-left"></span> Newer</button></span>

<?php
}
// next
if ($page < $sum) {
?>

<span class="link" style="float:right" data-target="<?=$ref?>&page=<?=($page+1)?>"><button>Older &nbsp; <span class="oi" data-glyph="chevron-right"></span></button></span>

<?php
	}
} ?>

</div>

<?php
if (logged()) {
?>

<script>function xPopup(Id) {
	$(Id).toggle();
}
$(document).ready(function(){
	$('#edit').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_editForum.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(data){
				$('#not').html(data);
			}
		});
	});
});</script>

<?php
}