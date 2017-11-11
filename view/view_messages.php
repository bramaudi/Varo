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
	<a href="/" class="static"><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span></a>
	<a href="/?v=friend" class="static"><span class="oi" data-glyph="people" title="people" aria-hidden="true"></span></a>
	<a class="active"><span class="oi" data-glyph="envelope-closed" title="envelope-closed" aria-hidden="true"></span></a>
	<a href="/?v=setting" class="static"><span class="oi" data-glyph="cog" title="cog" aria-hidden="true"></span></a>
	<a class="static" style="float:right" href="/?v=cookie"><span class="oi" data-glyph="account-logout" title="account-logout-open" aria-hidden="true"></span></a>
</div>

<div class="row">
<a style="float:left" href="/?v=inbox"><button><span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Inbox</button></a>

<a style="float:right" href="/?v=profile&user=<?=userUser($from_id)?>">
<div style="margin: 10px 0 0 0">
	<div style="display:inline-block;float:left"><span id="onlineStats"></span> <?=userName($from_id)?></div>
</div>
</a>
</div>

<hr>

<?php
if ($page < $sum) {
?>

<center>
<a href="/?v=messages&from_id=<?=$from_id?>&page=<?=($page+1)?>"><span class="oi" data-glyph="eye" title="eye" aria-hidden="true"></span> See older message</a>
</center>

<?php
}
?>

<div id="messagesShow">
</div>

<?php
if ($page <= $sum && $page >= 2) {
?>

<br>
<center>
<a href="/?v=messages&from_id=<?=$from_id?>&page=<?=($page-1)?>">See latest message</a>
</center>

<?php
}
if ($page < 2) {
?>

<br>
<div id="messageNot"></div>
<form id="messageForm">
<input type="hidden" name="to_id" value="<?=$from_id?>">
<input type="hidden" name="from_id" value="<?=$logged['id']?>">
<div class="row">
<div class="msgInp">
<textarea id="message" name="message"></textarea>
</div>
<div class="msgBtn">
<button>Send</button>
</div>
</div>
</form>

<script>$('html, body').animate({
	scrollTop: '9999'
}, 300);</script>

<?php
}
?>

<a name="bottom"></a>

<script>
$('#messagesShow').load('/ajax/ajax_messages.php?from_id=<?=$from_id?>&page=<?=$page?>');

	setInterval(function(){
		$('#messagesShow').load('/ajax/ajax_messages.php?from_id=<?=$from_id?>&page=<?=$page?>');
		$('#onlineStats').load('/ajax/ajax_onlineStats.php?user_id=<?=$from_id?>');
		}, 1000);
		
$(document).ready(function(){
	$('#messageForm').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_writeMsg.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function (html){
				$('#messageNot').html(html);
				$('#messagesShow').load('/ajax/ajax_messages.php?from_id=<?=$from_id?>&page=<?=$page?>');
				$(document).ready(function(){
					$('#message').val('');
				});
			}
		});
	});
});
</script>