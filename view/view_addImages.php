<div class="box box-item">
<strong>Upload to:</strong> <?=$gallery['name']?>
</div>

<div id="picNot"></div>
<div style="display:none" id="uploadProgress" class="success"><span class="oi" data-glyph="loop-circular" title="loop-circular" aria-hidden="true"></span> Uploading, please wait ...</div>
<hr style="display: none" class="progress" id="bar" width="0%"/>
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
		$('#bar').show();
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