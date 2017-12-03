<div class="row">
<span class="link" style="float:left" data-target="/?v=forum&id=<?=$forum_id?>">
<span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Back</span>

<span class="link" style="float:right" data-target="/">
<span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</span>
</div>

<hr>

<div id="notify"></div>

<form id="form">
<label>Title:</label>
<input type="text" value="" name="title">
<label>Text:</label>
<textarea name="text" rows="10"></textarea>
<input type="hidden" name="forum_id" value="<?=$forum_id?>"/>
<button id="btn" class="btn-full">Post</button>
</form>

<script>$(document).ready(function(){
	$('#form').submit(function(x){
		x.preventDefault();
		$('#btn').html('<span class="spin"></span>');
		$.ajax ({
			url: '/ajax/ajax_addPost.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(data){
				$('#btn').html('Post');
				$('html, body').animate({
				scrollTop: 0
			}, 300);
				$('#notify').html(data);
			}
		});
	});
});</script>