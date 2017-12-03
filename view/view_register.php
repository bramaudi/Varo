<div class="fit">
<h1 class="title"><?=$site['title']?></h1>

<div id="notify"></div>

<form id="form">
<label>First Name:</label>
<input type="text" name="first" value="">
<label>Last Name:</label>
<input type="text" name="last" value="">
<label>Email:</label>
<input type="email" name="mail" value="">
<label>Password:</label>
<input type="password" name="pass" value="">
<label>Verify Password:</label>
<input type="password" name="repass" value="">
<button id="btn" type="submit" class="btn-full">Register</button>
</form>

</div>

<script>
$(document).ready(function(){
	$('#form').submit(function(x){
x.preventDefault();
$('#btn').html('<span class="spin"></span>');
	$.ajax ({
		url: '/ajax/ajax_register.php',
		type: 'POST',
		data: $(this).serialize(),
		success: function (data){
			$('#btn').html('Register');
			$('html, body').animate({
				scrollTop: 0
			}, 300);
			$('#notify').html(data);
		}
	});
});
});
</script>