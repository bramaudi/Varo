<div class="row">

<span style="float:left" class="link" data-target="/?v=album&id=<?=$r['gallery_id']?>">
<span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Album</span>

<span style="float:left" class="link" data-target="/?v=gallery">
 &nbsp; <span class="oi" data-glyph="image" title="image" aria-hidden="true"></span> Gallery</span>

<span style="float:right" class="link" data-target="/">
&nbsp; <span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</span>

<?php
if (logged() && $logged['level'] < 2 OR logged() && $r['author'] == $logged['id']) {
?>

<span style="float:right" onclick="xPopup('#delConfirm')">
&nbsp; <span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span></span>

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

<span class="link" data-target="/images/<?=$r['id']?>.jpg" title="Direct image"><img class="lazy" alt="Image" title="Image" data-original="/images/<?=$r['id']?>.jpg" style="background-image: url(/assets/lazy.png)"/></span>

<hr>

<div class="box">
<div class="box-title">Details</div>
<div class="box-item">
- <strong>Uploaded by:</strong> <a href="/?v=profile&user=<?=userUser($r['author'])?>"><?=userName($r['author'])?></a>
</div>
<div class="box-item">
- <strong>Uploaded at:</strong> <?=date('d.m.Y H:i A',$r['id'])?>
</div>
<div class="box-item">
- <strong>Album:</strong> <?=$gallery['name']?>
</div>
<div class="box-item">
- <strong>Size:</strong> <?=filesize('./images/'.$r['id'].'.jpg')?> Bytes (80% Compressed)
</div>
<div class="box-item">
- <strong>Forum code:</strong>
</div>
<input type="text" value="[img=<?=$r['id']?>]">
</div>

<script>function xPopup(Id) {
	$(Id).toggle();
}</script>