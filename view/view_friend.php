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
	<a class="active"><span class="oi" data-glyph="people" title="people" aria-hidden="true"></span></a>
	<a href="/?v=inbox" class="static"><span class="oi" data-glyph="envelope-closed" title="envelope-closed" aria-hidden="true"></span></a>
	<a href="/?v=setting" class="static"><span class="oi" data-glyph="cog" title="cog" aria-hidden="true"></span></a>
	<a class="static" style="float:right" href="/?v=cookie"><span class="oi" data-glyph="account-logout" title="account-logout" aria-hidden="true"></span></a>
</div>

<hr>

<div class="title row">
<a class="static">My friends list</a>
</div>
<div class="box">

<?php
if ($my_friend->num_rows > 0) {
	while ($row = $my_friend->fetch_assoc()) {
		$r = $db->query("SELECT * FROM varo_users WHERE id = ".$row['rec_id'])->fetch_assoc();
?>

		<div class="row" style="padding: 5px 10px">
		<a href="/?v=profile&user=<?=$r['user']?>">
	<div class="profile_thumb" style="background:url(/files/<?=$r['user']?>.jpg)no-repeat center center; background-size: cover;float:left;margin-right:10px;border:none"></div>
	<div style="float:left"><?=userName($r['id'])?> <?=online($r['online'])?></div>
	</a>
	<a href="/control/control_manageFriend.php?a=del&req=<?=$logged['id']?>&rec=<?=$r['id']?>&ref=<?=rawurlencode('/?v=friend')?>">
	<div style="float:right"><span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span></div>
	</a>
</div>

<?php
	}
} else {
?>

<div claas="item" align="center">No friend</div>

<?php
}
?>

</div><br>

<form id="friendForm">
<div class="row">
<div class="msgInp">
<input id="friend" placeholder="First Name / Last Name" type="text" value="" name="name" required>
</div>
<div class="msgBtn">
<button>Search</button>
</div>
</div>
</form>
<div style="margin-top:10px"></div>
<div id="friendNot"></div>

<script>$(document).ready(function(){
	$('#friend').keyup(function(){
		var name = $(this).val();
		$('#friendNot').load('/ajax/ajax_friend.php?name='+name);
		$('html, body').scrollTop($(document).height());
	});
	$('#friendForm').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_friend.php',
			type: 'GET',
			data: $(this).serialize(),
			success: function(data){
				$('#friendNot').html(data);
			}
		});
	});
});</script>