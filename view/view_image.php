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
<a style="float:left" href="/?v=album&id=<?=$r['gallery_id']?>">
<button><span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Album</button></a>

<a style="float:left" href="/?v=gallery">
 &nbsp; <button><span class="oi" data-glyph="image" title="image" aria-hidden="true"></span> Gallery</button></a>

<a style="float:right" href="/">
&nbsp; <button><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</button></a>

<?php
if (logged() && $logged['level'] < 2 OR logged() && $r['author'] == $logged['id']) {
?>

<a style="float:right" onclick="xPopup('#delConfirm')">
&nbsp; <button><span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span> Delete</button></a>

<div id="delConfirm" class="popup" style="display: none">
<div class="popup-content">
Delete this image?<br/>
<span style="float: right">
<a onclick="xPopup('#delConfirm')"><button><span class="oi" data-glyph="x"></span> Cancel</button></a> &nbsp; <a href="/?v=deleteImages&id=<?=$id?>"><button><span class="oi" data-glyph="trash"></span> Ok</button></a>
</span>
</div>
</div>

<?php
}
?>

</div>
<hr>

<a href="/images/<?=$r['id']?>.jpg" title="Direct image"><img alt="Image" title="Image" src="/images/<?=$r['id']?>.jpg"/></a>

<div class="title row">
<a class="static">Details</a>
</div>
<div class="box">
<div class="item">
- <strong>Uploaded by:</strong> <a href="/?v=profile&user=<?=userUser($r['author'])?>"><?=userName($r['author'])?></a>
</div>
<div class="item">
- <strong>Uploaded at:</strong> <?=date('d.m.Y H:i A',$r['id'])?>
</div>
<div class="item">
- <strong>Album:</strong> <?=$gallery['name']?>
</div>
<div class="item">
- <strong>Size:</strong> <?=filesize('./images/'.$r['id'].'.jpg')?> Bytes (80% Compressed)
</div>
<div class="item">
- <strong>Forum code:</strong><br>
<input type="text" value="[img=<?=$r['id']?>]">
</div>
</div>

<script>function xPopup(Id) {
	$(Id).toggle();
}</script>