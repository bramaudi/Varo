<div class="title row">
<a href="/" class="static"><span class="oi" data-glyph="home" title="home" aria-hidden="true"></span> Home</a>
	<a class="active"><span class="oi" data-glyph="account-login" title="account-login" aria-hidden="true"></span> Login</a>
	<a href="/?v=register" class="static"><span class="oi" data-glyph="people" title="people" aria-hidden="true"></span> Register</a>
</div>
<div id="loginNot"></div>
<form method="post" id="loginForm">
	<div class="list">Email:<br/>
	<input type="email" name="mail" value="" required></div>
	<div class="list">Password:<br/>
	<input type="password" name="pass" value="" required></div>
	<button id="btn" type="submit" class="full">Log In</button>
</form>

<script>
$(document).ready(function(){
$('#loginForm').submit(function(x){		x.preventDefault();
$('#btn').html('...');
$.ajax ({
	'url': '/ajax/ajax_login.php',
	'type': 'POST',
	'data': $(this).serialize(),
	'success': function(html){
		$('#btn').html('Log In');
		$('html, body').animate({
				scrollTop: 0
			}, 300);
		$('#loginNot').html(html);
	}
});
});

});
</script>