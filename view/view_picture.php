<div class="row">
<span class="link" data-target="/?v=setting"><span class="oi" data-glyph="person" title="person" aria-hidden="true"></span> Profile &nbsp;</span>
<span class="oi" data-glyph="aperture" title="aperture" aria-hidden="true"></span> Picture &nbsp;
<span class="link" data-target="/?v=password"><span class="oi" data-glyph="lock-locked" title="lock-locked" aria-hidden="true"></span> Password</span>
</div>

<div id="picNot"></div>
<div style="display:none" id="uploadProgress" class="success"><span class="spin"></span> Uploading, please wait ...</div>
<hr style="display: none" class="progress" id="bar" width="0%"/>
<form id="uploadForm">
<br>
<div id="oldLayer" class="avatar-xl" style="background:url(/files/<?=$set['user']?>.jpg)no-repeat center center; background-size: cover; margin: auto; margin-bottom: 30px;"></div>
<div class="list">
<div id="uploadFormLayer">
<input name="userImage" type="file" id="inputFile" required>
</div>
</div>
<button id="btn" class="full">Change</button>
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
      url: "/ajax/ajax_picture.php",
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