<?php
if (logged()) {
?>

<div class="row" style="margin-bottom: 5px">
<a href="/?v=profile&user=<?=$logged['user']?>">
	<div class="profile_thumb" style="background:url(/files/<?=$logged['user']?>.jpg)no-repeat center center; background-size: cover;float:left;margin-right:10px;border:none"></div>
	<div style="display:inline-block;float:left"><strong><?=$logged['first']?> <?=$logged['last']?></strong></div>
</a>
<a href="/?v=inbox">
<div style="float: right">
<span class="newMessages"></span>
</div>
</a>
</div>

<div class="title row">
	<a class="active"><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span></a>
	<a href="/?v=friend" class="static"><span class="oi" data-glyph="people" title="people" aria-hidden="true"></span></a>
	<a href="/?v=inbox" class="static"><span class="oi" data-glyph="envelope-closed" title="envelope-closed" aria-hidden="true"></span></a>
	<a href="/?v=setting" class="static"><span class="oi" data-glyph="cog" title="cog" aria-hidden="true"></span></a>
	<a class="static" style="float:right" href="/?v=cookie"><span class="oi" data-glyph="account-logout" title="account-logout" aria-hidden="true"></span></a>
</div>

<?php
} else {
?>

<div class="title row">
<a class="active"><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</a>
	<a href="/?v=login" class="static"><span class="oi" data-glyph="account-login" title="account-login" aria-hidden="true"></span> Login</a>
	<a href="/?v=register" class="static"><span class="oi" data-glyph="people" title="people" aria-hidden="true"></span> Register</a>
</div>

<?php
}
?>

<hr>

<?php
if (logged() && $logged['level'] < 2) {
?>

Add Forum:
<div id="addForumNot"></div>
<form id="addForum">
<div class="row">
<div class="msgInp">
<input placeholder="Forum Name" type="text" value="" name="forum" required>
</div>
<div class="msgBtn">
<button>Add</button>
</div>
</div>
</form>
<br>

<?php
}
if (!$forum->num_rows) {
?>

<div class="box" align="center">
No forum.
</div>

<?php
} else {
	while ($r = $forum->fetch_assoc()) {
		$post = $db->query("SELECT * FROM varo_post WHERE forum_id = ".$r['id']." LIMIT 5");
?>

<div class="title row">
<a href="/?v=forum&id=<?=$r['id']?>" class="static"><?=$r['name']?></a>
<a onclick="turtle('<?=$r['id']?>')" style="float: right" class="static">
<span class="oi turtle<?=$r['id']?>" data-glyph="caret-bottom"></span>
</a>
</div>

<div class="box" id="turtle<?=$r['id']?>">

<?php
if (!$post->num_rows) {
?>

<div class="item" align="center">
No Post.
</div>

<?php
} else {
	while ($post_r = $post->fetch_assoc()) {
?>

<div class="item">
<a href="/?v=post&id=<?=$post_r['id']?>">
<span class="oi" data-glyph="document" title="document" aria-hidden="true"></span> <?=$post_r['title']?>
</a>
</div>

<?php
	}
}
?>

</div> <!-- .box -->

<?php
	}
}
if (logged()) {
?>

<hr/>

<div class="title row">
<a class="static">Menu</a>
</div>
<div class="box">
<div class="item">
<a href="/?v=gallery"><span class="oi" data-glyph="image"></span> Gallery <span style="float: right">(Album: <?=$albums?> / Images: <?=$images?>)</span></a>
</div>
</div>

<hr/>

<div class="title row">
<a class="static">Member</a>
</div>
<div class="box text">
- Total member: <?=$member?> | Online: <?=$on_member?><br/>
- New member: <a href="/?v=profile&user=<?=userUser($new_member['id'])?>"><?=userName($new_member['id'])?></a>
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