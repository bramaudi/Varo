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

<div class="row">
<a style="float:left" href="/?v=post&id=<?=$r['id']?>">
<button><span class="oi" data-glyph="chevron-left" title="chevron-left" aria-hidden="true"></span> Back</button></a>

<a style="float:right" href="/">
<button><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</button></a>
</div>
<hr>

<div class="title row">
<a class="static">Edit Post</a>
</div>
<div id="editCommentNot"></div>
<form id="editComment">
<div class="list">
<textarea name="text" rows="10"><?=$r['text']?></textarea>
</div>
<input type="hidden" name="id" value="<?=$r['id']?>"/>
<input type="hidden" name="ref" value="<?=@$_GET['ref']?>"/>
<button class="full">Save</button>
</form>

<script>$(document).ready(function(){
	$('#editComment').submit(function(x){
		x.preventDefault();
		$.ajax ({
			url: '/ajax/ajax_editComment.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(data){
				$('html, body').animate({
				scrollTop: 0
			}, 300);
				$('#editCommentNot').html(data);
			}
		});
	});
});</script>