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

<div class="theme-change">
<a href="/?v=theme&color=default&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-default">&nbsp;</a><a href="/?v=theme&color=dark-blue&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-dark-blue">&nbsp;</a><a href="/?v=theme&color=blue&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-blue">&nbsp;</a><a href="/?v=theme&color=orange&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-orange">&nbsp;</a><a href="/?v=theme&color=green&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-green">&nbsp;</a><a href="/?v=theme&color=chocolate&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-chocolate">&nbsp;</a><a href="/?v=theme&color=purple&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-purple">&nbsp;</a><a href="/?v=theme&color=pink&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-pink">&nbsp;</a><a href="/?v=theme&color=gray&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-gray">&nbsp;</a><a href="/?v=theme&color=black&ref=<?=rawurlencode($_SERVER['REQUEST_URI'])?>" class="theme-color theme-black">&nbsp;</a>
</div>

<div class="title row">
<a class="active"><span class="oi" data-glyph="person" title="person" aria-hidden="true"></span> Profile</a>
<a class="static" href="/?v=picture"><span class="oi" data-glyph="aperture" title="aperture" aria-hidden="true"></span> Picture</a>
<a class="static" href="/?v=password"><span class="oi" data-glyph="lock-locked" title="lock-locked" aria-hidden="true"></span> Password</a>
</div>
<div id="setNot"></div>
<form id="setForm">
	<div class="list">
	First Name:<br/>
	<input type="text" name="first" value="<?=$set['first']?>">
	</div>
	<div class="list">
	Last Name:<br/>
	<input type="text" name="last" value="<?=$set['last']?>">
	</div>
	<div class="list">
	About:<br/>
	<textarea rows="10" name="about"><?=$set['about']?></textarea>
	</div>
	<div class="list">
	Email:<br/>
	<input type="email" name="mail" value="<?=$set['email']?>">
	</div>
	<button id="btn" class="full">Save</button>
</form>

<script>
$(document).ready(function(){

$('#setForm').submit(function(x){
x.preventDefault();
$('#btn').html('...');
	$.ajax ({
		'url': '/ajax/ajax_setting.php',
		'type': 'POST',
		'data': $(this).serialize(),
		'success': function (html){
			$('#btn').html('Save');
			$('html, body').animate({
				scrollTop: 0
			}, 300);
			$('#setNot').html(html);
		}
	});
});

});
	</script>