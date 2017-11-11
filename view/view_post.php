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

<div class="row">
<a style="float:left" href="/?v=forum&id=<?=$r['forum_id']?>">
<button><span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Forum</button></a>

<a style="float:right" href="/">
&nbsp; <button><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</button></a>

<?php
if (logged() && $logged['level'] < 2 OR logged() && $r['author'] == $logged['id']) {
?>

<a style="float:right" onclick="xPopup('#delConfirm')">
&nbsp; <button><span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span> Delete Post</button></a>

<div id="delConfirm" class="popup" style="display: none">
<div class="popup-content">
Delete this post and all comment inside?<br/>
<span style="float: right">
<a onclick="xPopup('#delConfirm')"><button><span class="oi" data-glyph="x"></span> Cancel</button></a> &nbsp; <a href="/?v=post&id=<?=$id?>&del=<?=$r['id']?>"><button><span class="oi" data-glyph="trash"></span> Ok</button></a>
</span>
</div>
</div>

<a style="float:right" href="/?v=editPost&id=<?=$id?>">
&nbsp; <button><span class="oi" data-glyph="pencil" title="pencil" aria-hidden="true"></span> Edit Post</button></a>

<?php
}
?>

</div>
<hr>

<?php
if ($page < 2) {
?>

<div class="title row" style="padding: 10px">
<a href="/?v=profile&user=<?=userUser($r['author'])?>">
	<div class="profile_thumb" style="background:url(/files/<?=userUser($r['author'])?>.jpg)no-repeat center center; background-size: cover;float:left;margin-right:10px;border:none"></div>
	<div style="display:inline-block;float:left"><?=userName($r['author'])?></div>
</a>
</div>

<div class="box">
<div class="item text post">
<?=nl2br(setText($r['text']))?>
</div>

<?php
// post is edited
if (!empty($r['edit_time'])) {
?>

<div class="item"><span class="oi" data-glyph="pencil"></span> Edited by <a href="/?v=profile&user=<?=userUser($r['edit_author'])?>"><?=userName($r['edit_author'])?></a> on <?=date('d.m.Y',$r['edit_time'])?></div>

<?php
}
?>

</div>

<?php
} else {
?>

<div class="title row"><a href="/?v=post&id=<?=$r['id']?>" class="static"><span class="oi" data-glyph="document"></span> <?=$title?></a></div>

<?php
}
?>

<hr/>

<!-- comments -->

<?php
$comment = $db->query("SELECT * FROM varo_comment WHERE post_id = ".$r['id']." ORDER BY id LIMIT $start,$offset");
if ($comment->num_rows > 0) {
	while ($c = $comment->fetch_assoc()) {
?>

<a name="<?=$c['id']?>"></a>
<div class="title row" style="padding: 10px">
<a href="/?v=profile&user=<?=userUser($c['author'])?>">
	<div class="profile_thumb" style="background:url(/files/<?=userUser($c['author'])?>.jpg)no-repeat center center; background-size: cover;float:left;margin-right:10px;border:none"></div>
	<div style="display:inline-block;float:left"><?=userName($c['author'])?></div>
</a>

<?php
if (logged() && $logged['level'] < 2 OR logged() && $c['author'] == $logged['id']) {
?>

<a onclick="picu('<?=$c['id']?>')" style="float:right"> &nbsp; <span class="oi" data-glyph="trash"></span> Delete</a>

<a href="/?v=editComment&id=<?=$c['id']?>&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" style="float:right"><span class="oi" data-glyph="pencil"></span> Edit &#183; </a>

<div id="terpicu<?=$c['id']?>" class="popup" style="display: none">
<div class="popup-content">
Delete this comment?<br/>
<span style="float: right">
<a onclick="xPopup('#terpicu<?=$c['id']?>')"><button><span class="oi" data-glyph="x"></span> Cancel</button></a> &nbsp; <a href="/?v=deleteComment&id=<?=$c['id']?>&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>"><button><span class="oi" data-glyph="trash"></span> Ok</button></a>
</span>
</div>
</div>

<?php
}
?>

</div>

<div class="box">
<div class="item text">
<div class="row">

<?php
if (logged()) {
?>

<div align="right" style="float:right; width: 20%">

<a onclick="reply('<?=$c['id']?>')" style="font-size: xx-small"><span class="oi" data-glyph="share-boxed"></span> Reply</a>
<div id="text<?=$c['id']?>" data-reply="[q]<?=readmore(strip_tags(nl2br(strip_tags(no_quote($c['text'])))), 160)?>[/q]"></div>

</div>

<?php
} else {
?>

<div></div>

<?php
}
?>

<div class="post" style="float:left; width:80%">
<?=nl2br(setText($c['text']))?>
</div>

</div>
</div>

<?php
// comment is edited
if (!empty($c['edit_time'])) {
?>

<div class="item"><span class="oi" data-glyph="pencil"></span> Edited by <a href="/?v=profile&user=<?=userUser($c['edit_author'])?>"><?=userName($c['edit_author'])?></a> on <?=date('d.m.Y',$c['edit_time'])?></div>

<?php
}
?>

</div>
<hr/>

<?php
	} // end while
?>

<?php
// pagination
if ($total > $offset) {
?>

<div class="row">

<?php
// previous
if ($page <= $sum && $page >= 2) {
?>

<a style="float:left" href="<?=$ref?>&page=<?=($page-1)?>"><button><span class="oi" data-glyph="chevron-left"></span> Previous</button></a>

<?php
}
// next
if ($page < $sum) {
?>

<a style="float:right" href="<?=$ref?>&page=<?=($page+1)?>"><button>Next <span class="oi" data-glyph="chevron-right"></span></button></a>
</div>

<?php
	}
}
// pagination
?>

</div> <!-- .row -->

<?php
} // endif comment exists
if (logged()) {
?>

<div id="commentNot"></div>
<form id="messageForm">
<input type="hidden" name="post_id" value="<?=$r['id']?>">
<input type="hidden" name="ref" value="<?=$_SERVER['REQUEST_URI']?>">
<div class="row">
<div class="msgInp">
<textarea id="message" name="text"></textarea>
</div>
<div class="msgBtn">
<button>Post</button>
</div>
</div>
</form>

<script>
function reply(Id) {
	$('html, body').scrollTop($(document).height());
	var txt = $('#text'+Id).attr('data-reply');
	$('#message').val(txt);
}
function xPopup(Id) {
	$(Id).toggle();
}
function picu(Id) {
		$('#terpicu'+Id).toggle();
	}
$(document).ready(function(){
	$('#messageForm').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_comment.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(data){
				$('html, body').animate({
					scrollTop: $(document).height()
				}, 300);
				$('#commentNot').html(data);
			}
		});
	});
});</script>

<?php
}