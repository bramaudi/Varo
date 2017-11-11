<div class="title row">
<a href="/" class="static"><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</a>
	<a href="/?v=login" class="static"><span class="oi" data-glyph="account-login" title="account-login" aria-hidden="true"></span> Login</a>
	<a class="active"><span class="oi" data-glyph="people" title="people" aria-hidden="true"></span> Register</a>
</div>
<div id="regNot"></div>
<form id="regForm">
	<div class="list">First Name:<br/>
	<input type="text" name="first" value="" required></div>
	<div class="list">Last Name:<br/>
	<input type="text" name="last" value="" required></div>
	<div class="list">Email:<br/>
	<input type="email" name="mail" value="" required></div>
	<div class="list">Password:<br/>
	<input type="password" name="pass" value="" required></div>
	<div class="list">Verify Password:<br/>
	<input type="password" name="repass" value="" required></div>
	<button id="btn" type="submit" class="full">Register</button>
</form>

<script>
$(document).ready(function(){
	$('#regForm').submit(function(x){
x.preventDefault();
$('#btn').html('...');
	$.ajax ({
		'url': '/ajax/ajax_register.php',
		'type': 'POST',
		'data': $(this).serialize(),
		'success': function (html){
			$('#btn').html('Register');
			$('html, body').animate({
				scrollTop: 0
			}, 300);
			$('#regNot').html(html);
		}
	});
});
});
</script>