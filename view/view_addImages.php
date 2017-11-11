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
	<a href="/" class="static"><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span></a>
	<a href="/?v=friend" class="static"><span class="oi" data-glyph="people" title="people" aria-hidden="true"></span></a>
	<a href="/?v=inbox" class="static"><span class="oi" data-glyph="envelope-closed" title="envelope-closed" aria-hidden="true"></span></a>
	<a class="active"><span class="oi" data-glyph="cog" title="cog" aria-hidden="true"></span></a>
	<a class="static" style="float:right" href="/?v=cookie"><span class="oi" data-glyph="account-logout" title="account-logout" aria-hidden="true"></span></a>
</div>

<hr>

<div class="box item">
<strong>Upload to:</strong> <?=$gallery['name']?>
</div>

<div id="picNot"></div>
<div style="display:none" id="uploadProgress" class="success"><span class="oi" data-glyph="loop-circular" title="loop-circular" aria-hidden="true"></span> Uploading, please wait ...</div>
<hr class="progress" id="bar" width="0%"/>
<form id="uploadForm">
<div class="list">
<input name="userImage" type="file" id="inputFile" required>
</div>
<input type="hidden" name="gallery_id" value="<?=$gallery_id?>">
<button class="full">Upload</button>
</form>

<script>
$('#picNot').hide();
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$('#uploadProgress').show();
				$('#bar').show().animate({
					width: '50%'
				}, 1000);
		$.ajax({
      url: "/ajax/ajax_addImages.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	cache: false,
			processData: false,
			success: function(data)
		    {
		   $('#uploadProgress').hide();
		   $('#bar').animate({
					width: '100%',
				}, 1000).hide(500);
			 $("#picNot").show().html(data);
		    },
		  	error: function() 
	    	{
	    	},
	    	resetForm: true
	   });
	}));
});
</script>