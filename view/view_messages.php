<div class="no-padding">

<div class="row sub-item">
<span class="link sub-active" data-target="/?v=inbox"><span class="oi" data-glyph="chevron-left"></span> Back</span>
<span class="sub-current"><span class="oi" data-glyph="envelope-closed"></span> Inbox</span>
<span class="link sub-active" data-target="/?v=sent"><span class="oi" data-glyph="task"></span> Sent</span>
</div>

<div class="link row sub-item" data-target="/?v=profile&user=<?=userUser($from_id)?>">
<div class="avatar-lg" style="display:inline-block;background:url(/files/<?=userUser($from_id)?>.jpg)no-repeat center center; background-size: cover;border:none;float:left;margin: 0 10px 0 0"></div>
<b><?=userName($from_id)?></b>
<br>
<span id="onlineStats"></span>
</div>

<?php
if ($page < $sum) {
?>

<center>
<a href="/?v=messages&from_id=<?=$from_id?>&page=<?=($page+1)?>"><span class="oi" data-glyph="eye" title="eye" aria-hidden="true"></span> See older message</a>
</center>

<?php
}
?>

<div id="messagesShow" data-slideout-ignore>
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

<div id="messageNot"></div>
<form id="messageForm">
<input type="hidden" name="to_id" value="<?=$from_id?>">
<input type="hidden" name="from_id" value="<?=$logged['id']?>">
<textarea class="chat-inp" id="message" name="message"></textarea>
<button class="chat-btn">Send</button>
</form>

</div>

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