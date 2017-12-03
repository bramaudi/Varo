<div class="row">
<span class="link" style="float:left" data-target="/?v=forum&id=<?=$r['forum_id']?>">
<span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Forum</span>

<span class="link" style="float:right" data-target="/">
&nbsp; <span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</span>

<?php
if (logged() && $logged['level'] < 2 OR logged() && $r['author'] == $logged['id']) {
?>

<span style="float:right" onclick="xPopup('#delConfirm')">
&nbsp; <span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span> &nbsp;</span>

<div id="delConfirm" class="popup" style="display: none">
<div class="popup-content">
Delete this post and all comment inside?<br/>
<span style="float: right">
<a onclick="xPopup('#delConfirm')"><button><span class="oi" data-glyph="x"></span> Cancel</button></a> &nbsp; <a href="/?v=post&id=<?=$id?>&del=<?=$r['id']?>"><button><span class="oi" data-glyph="trash"></span> Ok</button></a>
</span>
</div>
</div>

<span class="link" style="float:right" data-target="/?v=editPost&id=<?=$id?>">
&nbsp; <span class="oi" data-glyph="pencil" title="pencil" aria-hidden="true"></span> &nbsp;</span>

<?php
}
?>

</div>
<hr>

<?php
if ($page < 2) {
?>

<div class="box">

<div class="row" style="background: #f5f5f5; border-bottom: 1px solid #e1e1e1; border-top-left-radius: 3px; border-top-right-radius: 3px">
<span class="link" data-target="/?v=profile&user=<?=userUser($r['author'])?>">
	<span class="avatar-md" style="background:url(/files/<?=userUser($r['author'])?>.jpg)no-repeat center center; background-size: cover;	border-top-left-radius: 2px; float: left;"></span>
<span style="margin: 10px auto; float: left"><?=userName($r['author'])?></span>
</span>
</div>

<div class="box-item">
<?=nl2br(setText($r['text']))?>
</div>

<?php
// post is edited
if (!empty($r['edit_time'])) {
?>

<div class="box-item" style="font-size: x-small"><span class="oi" data-glyph="clock"></span> <?=timeago($r['time'])?> &#183; <span class="oi" data-glyph="pencil"></span> <span class="link" data-target="/?v=profile&user=<?=userUser($r['edit_author'])?>"><?=userName($r['edit_author'])?></span> / <?=date('d.m.Y',$r['edit_time'])?></div>

<?php } else { ?>

<div class="box-item" style="font-size: x-small"><span class="oi" data-glyph="clock"></span> <?=timeago($r['time'])?></div>

<?php } ?>

</div>

<?php
} else {
?>

<div class="title row"><span class="link" data-target="/?v=post&id=<?=$r['id']?>" class="static"><span class="oi" data-glyph="document"></span> <?=$title?></span></div>

<?php
}
?>

<!-- comments -->

<?php
$comment = $db->query("SELECT * FROM varo_comment WHERE post_id = ".$r['id']." ORDER BY id LIMIT $start,$offset");
if ($comment->num_rows > 0) {
	while ($c = $comment->fetch_assoc()) {
?>

<a name="<?=$c['id']?>"></a>

<div class="box">

<div class="row" style="background: #f5f5f5; border-bottom: 1px solid #e1e1e1; border-top-left-radius: 3px; border-top-right-radius: 3px">
<span class="link" data-target="/?v=profile&user=<?=userUser($c['author'])?>">
	<span class="avatar-md" style="background:url(/files/<?=userUser($c['author'])?>.jpg)no-repeat center center; background-size: cover;	border-top-left-radius: 2px; float: left;"></span>
<span style="margin: 10px auto; float: left"><?=userName($c['author'])?></span>
</span>

<?php
if (logged() && $logged['level'] < 2 OR logged() && $c['author'] == $logged['id']) {
?>

<span onclick="picu('<?=$c['id']?>')" style="margin: 10px 10px 0 0; float:right"> &nbsp; <span class="oi" data-glyph="trash"></span></span>

<span class="link" data-target="/?v=editComment&id=<?=$c['id']?>&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" style="margin-top: 10px; float:right"><span class="oi" data-glyph="pencil"></span> &#183; </span>

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

<div class="box-item">
<div class="row">

<?php
if (logged()) {
?>

<div align="right" style="float:right; width: 20%">

<span onclick="reply('<?=$c['id']?>')" style="font-size: xx-small"><span class="oi" data-glyph="double-quote-serif-left"></span> Quote</span>
<div id="text<?=$c['id']?>" data-reply="[q]<?=readmore(strip_tags(nl2br(strip_tags(no_quote($c['text'])))), 160)?>[/q]"></div>

</div>

<?php
} else {
?>

<div></div>

<?php
}
?>

<div style="float:left; width:80%">
<?=nl2br(setText($c['text']))?>
</div>

</div>
</div>

<?php
// comment is edited
if (!empty($c['edit_time'])) {
?>

<div class="box-item" style="font-size: x-small"><span class="oi" data-glyph="clock"></span> <?=timeago($c['time'])?> &#183; <span class="oi" data-glyph="pencil"></span> <span class="link" data-target="/?v=profile&user=<?=userUser($c['edit_author'])?>"><?=userName($c['edit_author'])?></span> / <?=date('d.m.Y',$c['edit_time'])?></div>

<?php } else { ?>

<div class="box-item" style="font-size: x-small"><span class="oi" data-glyph="clock"></span> <?=timeago($c['time'])?></div>

<?php } ?>

</div>

<?php
	} // end while
?>

<div class="row">

<?php
// pagination
if ($total > $offset) {
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

<div id="notify"></div>

<form id="form">
<input type="hidden" name="post_id" value="<?=$r['id']?>">
<input type="hidden" name="ref" value="<?=$_SERVER['REQUEST_URI']?>">
<label>Write reply:</label>
<textarea id="message" name="text"></textarea>
<button id="btn" class="btn-full">Post</button>
</form>

<script>
function reply(Id) {
	$('html, body').scrollTop($(document).height());
	var txt = $('#text'+Id).attr('data-reply');
	var msg = $('#message').val();
	$('#message').val(txt+' '+msg);
}
function xPopup(Id) {
	$(Id).toggle();
}
function picu(Id) {
		$('#terpicu'+Id).toggle();
	}
$(document).ready(function(){
	$('#form').submit(function(x){
		x.preventDefault();
		$('#btn').html('<span class="spin"></span>');
		$.ajax ({
			url: '/ajax/ajax_comment.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(data){
				$('#btn').html('Post');
				$('html, body').animate({
					scrollTop: $(document).height()
				}, 300);
				$('#notify').html(data);
			}
		});
	});
});</script>

<?php
}