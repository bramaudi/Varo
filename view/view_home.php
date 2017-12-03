<h1 class="title">Forum</h1>

<?php
if (logged() && $logged['level'] < 2) {
?>

<label>Add Forum:</label>
<div id="addForumNot"></div>
<form id="addForum">
<input placeholder="Forum Name" type="text" value="" name="forum">
<button>Add</button>
</form>

<?php
}
if (!$forum->num_rows) {
?>

<div class="box" align="center">No forum.</div>

<?php
} else {
	while ($r = $forum->fetch_assoc()) {
		$post = $db->query("SELECT * FROM varo_post WHERE forum_id = ".$r['id']." LIMIT 5");
?>

<div class="box">
<div class="box-title row">
<span data-target="/?v=forum&id=<?=$r['id']?>" class="link static"><?=$r['name']?></span>
<a onclick="turtle('<?=$r['id']?>')" style="float: right" class="static">
<span class="oi turtle<?=$r['id']?>" data-glyph="caret-bottom"></span>
</a>
</div>

<div id="turtle<?=$r['id']?>">

<?php
if (!$post->num_rows) {
?>

<div class="box-item" align="center">
No Post.
</div>

<?php
} else {
	while ($post_r = $post->fetch_assoc()) {
?>

<div class="box-item">
<span class="link" data-target="/?v=post&id=<?=$post_r['id']?>">
<span class="oi" data-glyph="document" title="document" aria-hidden="true"></span> <?=$post_r['title']?>
</span>
</div>

<?php
	}
}
?>

</div>
</div> <!-- .box -->

<?php
	}
}
if (logged()) {
?>

<div class="box">
<div class="box-title">Menu</div>

<div class="box-item">
<span class="link" data-target="/?v=gallery"><span class="oi" data-glyph="image"></span> Gallery <span style="float: right">(Album: <?=$albums?> / Images: <?=$images?>)</span></a>
</div>

</div>

<?php } if (logged() && $logged['level'] < 2) { ?>

<div class="box">
<div class="box-title">Statistic</div>

<div class="box-item">
Total member: <?=$member?> | Online: <?=$on_member?></div>
<div class="box-item">
New member: <span class="link" data-target="/?v=profile&user=<?=userUser($new_member['id'])?>"><?=userName($new_member['id'])?></span>
</div>
</div>

<?php
}
?>

<script>function turtle(x){
	$('#turtle'+x).slideToggle('fast');
	var trigger = $('.turtle'+x).attr('data-glyph');
	if (trigger == 'caret-right') {
		$('.turtle'+x).attr('data-glyph','caret-bottom');
	} else {
		$('.turtle'+x).attr('data-glyph','caret-right');
	}
}</script>

<?php
if (logged() && $logged['level'] < 2) {
?>

<script>$(document).ready(function(){
	$('#addForum').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_addForum.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function (html){
				$('#addForumNot').html(html);
			}
		});
	});
});</script>

<?php
}