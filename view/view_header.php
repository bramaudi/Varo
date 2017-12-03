<!DOCTYPE html>
<html>
<head>
<title><?=$site['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<script src="/assets/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="/assets/normalize.css" />
<link rel="stylesheet" href="/assets/open-iconic.min.css" />
<link rel="stylesheet" href="/assets/varo.css" />
</head>
<body>
	
<nav id="menu">
<div class="link menu-list" data-target="/"><span class="oi" data-glyph="home"></span> Home</div>

<?php if (logged()) { ?>

<div class="link menu-list" data-target="/?v=inbox"><span class="oi" data-glyph="envelope-closed"></span> Messaging</div>
<div class="link menu-list" data-target="/?v=friend"><span class="oi" data-glyph="people"></span> Friend List</div>
<div class="link menu-list" data-target="/?v=setting"><span class="oi" data-glyph="cog"></span> Setting</div>
<div class="link menu-list" data-target="/?v=cookie"><span class="oi" data-glyph="account-logout"></span> Logout</div>
      
<?php } else { ?>

<div class="link menu-list" data-target="/?v=login"><span class="oi" data-glyph="account-login"></span> Login</div>
<div class="link menu-list" data-target="/?v=register"><span class="oi" data-glyph="people"></span> Registration</div>

<?php } ?>

</nav>
	
<div id="panel">
		
<nav class="nav-static">

<?php if (logged()) { ?>

<span class="nav-name link" data-target="/?v=profile&user=<?=$logged['user']?>">
<span class="lazy avatar-nav avatar-sm" data-original="/files/<?=$logged['user']?>.jpg" style="background:url(/assets/lazy.png)no-repeat center center; background-size: cover; float: left"></span>
<?=userName($logged['id'])?>
</span>

<?php } else { ?>

<span class="link nav-brand" data-target="/"><?=$global_title?></span>

<?php } ?>

<button id="nav-btn" class="nav-burger">
<span></span>
<span></span>
<span></span>
</button>

<?php if (logged()) { ?>

<span class="link nav-notify nav-item" data-target="/?v=inbox">
<span class="newMessages"></span>
<span class="oi" data-glyph="envelope-closed"></span>
</span>

<?php } ?>

</nav>

<noscript><div id="noscript"><h2>I need JavaScript !!!</h2>
<br>
<img src="/assets/bot.png" alt="bot" title="Bot"/>
<br><br>
Your browser not support <strong>JavaScript</strong>, or maybe it was <u>disabled</u> by the setting.
<br><br>
Please update your browser or try to check your setting.</div>
</noscript>

<div id="preload">
<img src="/assets/loader.gif" alt="loading" title="Loading ..."/>
</div>

<div id="loaded" class="container">