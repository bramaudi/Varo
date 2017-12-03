<div class="row">
<span class="oi" data-glyph="person" title="person" aria-hidden="true"></span> Profile &nbsp;
<span class="link" data-target="/?v=picture"><span class="oi" data-glyph="aperture" title="aperture" aria-hidden="true"></span> Picture &nbsp;</span>
<span class="link" data-target="/?v=password"><span class="oi" data-glyph="lock-locked" title="lock-locked" aria-hidden="true"></span> Password </span>
</div>

<div id="notify"></div>
<form id="form">
<label>First Name:</label>
<input type="text" name="first" value="<?=$set['first']?>">
<label>Last Name:</label>
<input type="text" name="last" value="<?=$set['last']?>">
<label>About:</label>
<textarea rows="10" name="about"><?=$set['about']?></textarea>
<label>Email:</label>
<input type="email" name="mail" value="<?=$set['email']?>">
<button id="btn" class="full">Save</button>
</form>

<script>
$(document).ready(function(){

$('#form').submit(function(x){
x.preventDefault();
$('#btn').html('<span class="spin"></span>');
	$.ajax ({
		'url': '/ajax/ajax_setting.php',
		'type': 'POST',
		'data': $(this).serialize(),
		'success': function (html){
			$('#btn').html('Save');
			$('html, body').animate({
				scrollTop: 0
			}, 300);
			$('#notify').html(html);
		}
	});
});

});
	</script>