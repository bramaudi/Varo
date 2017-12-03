<div class="row">

<span style="float:left" class="link" data-target="/">
<span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Back</span>

</div>

<hr>

<?php
if (logged() && $logged['level'] < 2) {
?>

<h3>Add Gallery:</h3>

<div id="notify"></div>

<form id="form">
<input placeholder="Gallery Name" type="text" value="" name="name">
<button id="btn">Add</button>
</form>

<?php
}
?>

<div class="box">
<div class="box-title">Album</div>

<?php
if (!$sql->num_rows) {
?>

<div class="box-item" align="center">No Album</div>

<?php
} else {
	while ($r = $sql->fetch_assoc()) {
		$contain = $db->query("SELECT id FROM varo_images WHERE gallery_id = ".$r['id'])->num_rows;
?>

<div class="box-item">
<span class="link" data-target="/?v=album&id=<?=$r['id']?>">
<span class="oi" data-glyph="image"></span>
<?=$r['name']?> (<?=$contain?>)
</span>
</div>

<?php
	}
?>

</div> <!-- .box -->

<br>

<h3>New Uploads</h3>
<hr>

<?php
if (!$img->num_rows) {
?>

<div class="box" align="center">
<div class="box-item">No image uploaded.</div>
</div>

<?php
} else {
?>

<div class="row">

<?php
while ($images = $img->fetch_assoc()) {
?>

<div class="link images lazy" data-target="/?v=images&id=<?=$images['id']?>" data-original="/images/<?=$images['id']?>.jpg" style="background: url(/assets/lazy.png);"></div>

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
	$('#form').submit(function(x){
		x.preventDefault();
		$('#btn').html('<span class="spin"></span>');
		$.ajax ({
			url: '/ajax/ajax_addGallery.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(data){
				$('#btn').html('Add');
				$('#notify').html(data);
			}
		});
	});
});</script>

<?php
}
?>