<div class="row">

<span class="link" style="float:left" data-target="/?v=gallery">
<span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Gallery</span>

<span class="link" style="float:right" data-target="/">
&nbsp; <span class="oi" data-glyph="home" title="hone" aria-hidden="true"></span> Home</span>

<?php
if (logged() && $logged['level'] < 2) {
?>

<span style="float:right" onclick="xPopup('#delConfirm')">
&nbsp; <span class="oi" data-glyph="trash" title="trash" aria-hidden="true"></span> </span>

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

<span class="link" style="float:right" data-target="/?v=addImages&gallery_id=<?=$r['id']?>">
<span class="oi" data-glyph="plus" title="plus" aria-hidden="true"></span> Upload</span>

<?php
}
?>

</div>
<hr>

<?php
if (logged() && $logged['level'] < 2) {
?>

<h3>Rename Album:</h3>

<div id="notify"></div>

<form id="form">
<input type="hidden" name="id" value="<?=$r['id']?>">
<input type="text" value="<?=$r['name']?>" name="name">
<button id="btn">Set</button>
</form>

<?php
}
?>

<h3><span class="oi" data-glyph="image"></span>
<?=$r['name']?></h3>

<hr>

<div class="row">

<?php
if (!$images->num_rows) {
?>

<div class="box" align="center">
<div class="box-item">No post.</div>
</div>

<?php
} else {
	while ($img = $images->fetch_assoc()) {
?>

<div class="link images lazy" data-target="/?v=images&id=<?=$img['id']?>" data-original="/images/<?=$img['id']?>.jpg" style="background: url(/assets/lazy.png);"></div>

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
	$('#form').submit(function(x){
		x.preventDefault();
		$('#btn').html('<span class="spin"></span>');
		$.ajax ({
			url: '/ajax/ajax_editAlbum.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(data){
				$('#btn').html('Set');
				$('#notify').html(data);
			}
		});
	});
});</script>

<?php
}