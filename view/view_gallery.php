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
<a style="float:left" href="/">
<button><span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Back</button></a>

</div>
<hr>

<?php
if (logged() && $logged['level'] < 2) {
?>

Add Gallery:
<div id="not"></div>
<form id="add">
<div class="row">
<div class="msgInp">
<input placeholder="Gallery Name" type="text" value="" name="name" required>
</div>
<div class="msgBtn">
<button>Add</button>
</div>
</div>
</form>
<br>

<?php
}
?>

<div class="title row">
<a class="static">Album</a>
</div>

<?php
if (!$sql->num_rows) {
?>

<div class="box" align="center">
No Album
</div>

<?php
} else {
?>

<div class="box">

<?php
	while ($r = $sql->fetch_assoc()) {
		$contain = $db->query("SELECT id FROM varo_images WHERE gallery_id = ".$r['id'])->num_rows;
?>

<div class="item">
<a href="/?v=album&id=<?=$r['id']?>">
<span class="oi" data-glyph="image"></span>
<?=$r['name']?> (<?=$contain?>)
</a>
</div>

<?php
	}
?>

</div> <!-- .box -->

<hr>

<div class="title row">
<a class="static">New Uploads</a>
</div>

<?php
if (!$img->num_rows) {
?>

<div class="box" align="center">
No image uploaded.
</div>

<?php
} else {
?>

<div class="row">

<?php
while ($images = $img->fetch_assoc()) {
?>

<a href="/?v=images&id=<?=$images['id']?>">
<div class="images" style="background: url(/images/<?=$images['id']?>.jpg);"></div>
</a>

<?php
}
?>

</div>

<?php
} // image exsists
}
if (logged() && $logged['level'] < 2) {
?>

<script>$(document).ready(function(){
	$('#add').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_addGallery.php',
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
?>