<div class="row">
<span style="float:left" class="link" data-target="/?v=post&id=<?=$r['id']?>">
<span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Back</span>

<span style="float:right" class="link" data-target="/">
<span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</span>
</div>

<hr>

<div id="notify"></div>
<form id="form">
<label>Title:</label>
<input type="text" value="<?=$r['title']?>" name="title">
<label>Text:</label>
<textarea name="text" rows="10"><?=$r['text']?></textarea>
<input type="hidden" name="id" value="<?=$r['id']?>"/>
<button class="btn-full">Save</button>
</form>

<script>$(document).ready(function(){
	$('#form').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_editPost.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(data){
				$('html, body').animate({
				scrollTop: 0
			}, 300);
				$('#notify').html(data);
			}
		});
	});
});</script>