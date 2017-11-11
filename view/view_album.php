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
<a style="float:left" href="/?v=gallery">
<button><span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Gallery</button></a>

<a style="float:right" href="/">
&nbsp; <button><span class="oi" data-glyph="home" title="hone" aria-hidden="true"></span> Home</button></a>

<?php
if (logged() && $logged['level'] < 2) {
?>

<a style="float:right" onclick="xPopup('#delConfirm')">
&nbsp; <button><span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span> Delete Album</button></a>

<div id="delConfirm" class="popup" style="display: none">
<div class="popup-content">
Delete this album and all images inside?<br/>
<span style="float: right">
<a onclick="xPopup('#delConfirm')"><button><span class="oi" data-glyph="x"></span> Cancel</button></a> &nbsp; <a href="/?v=deleteAlbum&id=<?=$r['id']?>"><button><span class="oi" data-glyph="trash"></span> Ok</button></a>
</span>
</div>
</div>

<?php
}
if (logged()) {
?>

<a style="float:right" href="/?v=addImages&gallery_id=<?=$r['id']?>">
<button><span class="oi" data-glyph="plus" title="plus" aria-hidden="true"></span> Upload</button></a>

<?php
}
?>

</div>
<hr>

<?php
if (logged() && $logged['level'] < 2) {
?>

Rename Album:
<div id="not"></div>
<form id="edit">
<div class="row">
<div class="msgInp">
<input type="hidden" name="id" value="<?=$r['id']?>">
<input type="text" value="<?=$r['name']?>" name="name" required>
</div>
<div class="msgBtn">
<button>Set</button>
</div>
</div>
</form>
<hr>

<?php
}
?>

<div class="title row">
<a class="static">
<span class="oi" data-glyph="image"></span>
<?=$r['name']?>
</a>
</div>

<div class="row">

<?php
if (!$images->num_rows) {
?>

<div class="box" align="center">No post.</div>

<?php
} else {
	while ($img = $images->fetch_assoc()) {
?>

<a href="/?v=images&id=<?=$img['id']?>">
<div class="images" style="background: url(/images/<?=$img['id']?>.jpg);"></div>
</a>

<?php
	}
}
?>

</div>

<?php
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
if (logged()) {
?>

<script>function xPopup(Id) {
	$(Id).toggle();
}
$(document).ready(function(){
	$('#edit').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_editAlbum.php',
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