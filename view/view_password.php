<div class="row">
<span class="link" data-target="/?v=setting"><span class="oi" data-glyph="person" title="person" aria-hidden="true"></span> Profile &nbsp;</span>
<span class="link" data-target="/?v=picture"><span class="oi" data-glyph="aperture" title="aperture" aria-hidden="true"></span> Picture &nbsp;</span>
<span class="oi" data-glyph="lock-locked" title="lock-locked" aria-hidden="true"></span> Password
</div>

<div id="notify"></div>
<form id="form">
<label>Old Password:</label>
<input type="password" name="old" value="" required>
<label>New Password:</label>
<input type="password" name="new" value="" required>
<label>Verify New Password:</label>
<input type="password" name="ver" value="" required>
<button id="btn" class="full">Change</button>
</form>

<script>
$(document).ready(function(){
	$('#form').submit(function(x){
		x.preventDefault();
		$('#btn').html('...');
		$.ajax ({
			url: '/ajax/ajax_password.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function (data) {
				$('#btn').html('Change');
				$('html, body').animate({
					scrollTop: 0
				}, 300);
				$('#notify').html(data);
			}
		})
	});
});
</script>