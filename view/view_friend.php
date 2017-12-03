<h3>My friends</h3>
<div class="box">

<?php
if ($my_friend->num_rows > 0) {
	while ($row = $my_friend->fetch_assoc()) {
		$r = $db->query("SELECT * FROM varo_users WHERE id = ".$row['rec_id'])->fetch_assoc();
?>

		<div class="box-item row" style="padding: 5px 10px">
		<span class="link" data-target="/?v=profile&user=<?=$r['user']?>">
	<div class="avatar-sm" style="background:url(/files/<?=$r['user']?>.jpg)no-repeat center center; background-size: cover;float:left;margin-right:10px; border:none"></div>
	<div style="float:left"><?=userName($r['id'])?> <?=online($r['online'])?></div>
	</span>
	<span class="link" data-target="/control/control_manageFriend.php?a=del&req=<?=$logged['id']?>&rec=<?=$r['id']?>&ref=<?=rawurlencode('/?v=friend')?>">
	<div style="float:right; margin: 8px 8px 0 0"><span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span></div>
	</span>
</div>

<?php
	}
} else {
?>

<div class="box-item" align="center">No friend</div>

<?php
}
?>

</div><br>

<form id="friendForm">
<input id="friend" placeholder="First Name / Last Name" type="text" value="" name="name" required>
<button>Search</button>
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