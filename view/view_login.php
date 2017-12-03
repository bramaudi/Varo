<div class="fit">
<h1 class="title"><?=$site['title']?></h1>

<div id="notify"></div>

<form method="post" id="form">
<label>Email:</label>
<input type="email" name="mail" value="">
<label>Password:</label>
<input type="password" name="pass" value="">
<button id="btn" type="submit" class="btn-full">Log In</button>
</form>

</div>

<script>
$(document).ready(function(){
$('#form').submit(function(x){		x.preventDefault();
$('#btn').html('<span class="spin"></span>');
$.ajax ({
	url: '/ajax/ajax_login.php',
	type: 'POST',
	data: $(this).serialize(),
	success: function(data){
		$('#btn').html('Log In');
		$('html, body').animate({
				scrollTop: 0
			}, 300);
		$('#notify').html(data);
	}
});
});

});
</script>