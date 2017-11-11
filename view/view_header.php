<!DOCTYPE html>
<html>
<head>
	<title><?=$site['title']?></title>
	<script src="/assets/jquery-3.2.1.min.js"></script>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="/assets/open-iconic.min.css"/>
	<link rel="stylesheet" href="https://necolas.github.io/normalize.css/7.0.0/normalize.css"/>
	<style type="text/css">
	@font-face {
		font-family: Quicksand;
		font-style: normal;
		font-weight: 400;
		src: url(/assets/quicksand.woff2) format('woff2');
		
	}
	* {
		box-sizing: border-box;
	}
	a {
		color: #fff;
		text-decoration: none;
	}
	body {
		color: #fff;
		background: #<?=$color?>;
		margin: auto;
		padding: 0 10px;
		line-height: 32px;
		font-family: 'Quicksand', sans-serif;
		font-size: small;
	}
	img {
		max-width: 100%;
		height: auto
	}
	hr {
		border: none;
		border-bottom: 1px solid rgba(150,150,150,0.3);
	}
	#wrapper {
		padding: 0;
		margin: 5% auto;
		color: #eee;
	}
	.progress {
		display: none;
		border: 2px solid #999;
		border-radius: 5px
	}
	.popup {
		right: 10px;
		left: 10px;
		position: absolute;
		z-index: 1;
		margin-top: 50px;
		background: #aaa;
		border-radius: 5px;
		box-shadow: 0 0 10px rgba(0,0,0,0.5);
	}
	.popup button {
		margin: 15px 0;
		background: #555;
	}
	.popup-content {
		background: rgba(75,75,75,1);
		padding: 10px;
		margin: 20px;
		border-radius: 5px;
		line-height: 1.5em;
	}
	.quote {
		padding: 5px;
		background: rgba(155,155,155,0.5);
		margin: 0 5px 5px 0;
	}
	.row::after {
		clear: both;
		content:' ';
		display: block;
	}
	.col-2 {
		display: block;
		margin: 0;
		padding: 5px;
		width: 100%;
	}
	
	.text {
		line-height:1.5em;
		padding: 10px
	}
	.post a {
		border-bottom: 1px dotted #fff;
		font-weight: bold 
	}
	.error, .warning, .success {
		margin: 5px 0;
		padding: 10px 15px;
		text-align: center;
	}
	.error {
		background: rgba(150,0,0,0.2);
	}
	.warning {
		background: rgba(150,150,0,0.2);
	}
	.success {
		background: rgba(0,150,0,0.2);
	}
	
	.list {
		margin-bottom: 10px;
		padding: 15px 10px 0 15px;
	}
	.item {
		line-height: 1.5em;
		margin: 0;
		padding: 10px;
		border-bottom: 1px solid rgba(150,150,150,0.2);
	}
	form,.box {
		background: rgba(75,75,75,0.2);
	}
	input,textarea,select {
		font-family: 'Quicksand', sans-serif;
		color: #eee;
		width: 100%;
		max-width: 100%;
		padding: 10px 10px 10px 0;
		background: none;
		border: none;
		border-bottom: 1px solid rgba(255,255,255,0.3);
		margin: 0;
		line-height: 1.5em;
	}
	input[type=checkbox] {
		width: auto;
	}
	button {
		line-height: 1.5em;
		margin-top: 10px;
		border: none;
		padding: 7px;
		background: rgba(175,175,175,0.3);
		color: #eee;
		font-weight: 300;
		border-radius: 5px;
		font-family: 'Quicksand', sans-serif;
	}
	.full {
		text-transform: uppercase;
		border-radius: 0;
		padding: 15px;
		width: 100%;
	}
	
	.title {
		background: rgba(100,100,100,0.2);
		margin: 0;
		padding: 0;
	}
	.title .active, .title .static {
		float: left;
		padding: 5px 15px;
		margin: 0;
		display: inline-block;
	}
	.title .active {
		background: rgba(155,155,155,0.3);
	}
	
	.profile_img {
		width: 100px;
		height: 100px;
		border-radius: 100%;
		border: 1px solid #fff;
		margin: 10px auto;
	}
	.profile_thumb {
		display: inline-block;
		width: 35px;
		height: 35px;
		border-radius: 100%;
		border: 1px solid #fff;
		margin: 0;
	}
	
	.messages {
		background: rgba(249, 68, 73, 0.3);
		max-width: 80%;
		padding: 7px;
		margin: 12px 0 0 0;
		line-height:1.5em;
		font-family: 'Quicksand', sans-serif;
		border-radius: 5px;
	}
	.from_me {
		background: rgba(133, 195, 192, 0.3);
	}
	.messages.info {
		background: rgba(242, 231, 210, 0.3);
	}
	.messages-info {
		float: right;
		font-size: x-small;
		color: #aaa;
	}
	.msgInp {
		padding: 0;
		float: left;
		width: 80%;
	}
	.msgInp textarea, .msgInp input {
		background: rgba(255,255,255,0.2);
		border: none;
		margin: 0;
		padding: 10px;
	}
	.msgBtn {
		padding: 0;
		float: left;
		width: 20%;
	}
	.msgBtn button {
		width: 100%;
		padding: 10px;
		margin: 0;
		border-radius: 0px
	}
	#messageForm {
		background: none
	}
	.seen {
		color:#fff;
		text-shadow: 2px 0 0 #fff;
	}
	.i-sm {
		width: 10px;
		height: 10px;
	}
	
	
	.theme-change {
		text-align: center;
		padding: 0;
		margin-top: 20px;
	}
	.theme-color {
		width: 25px;
		height: 25px;
		padding: 10px;
		border: 1px solid #fff;
		border-radius: 100%;
		display: inline-block;
		margin: 0 5px 0 0;
	}
	.theme-default {
		background: #B62525;
		background: linear-gradient(to right, #B62525, #B4275D)
	}
	.theme-blue {
		background: #066D97
	}
	.theme-orange {
		background: #974413
	}
	.theme-green {
		background: #2D5C1D
	}
	.theme-chocolate {
		background: #68401B
	}
	.theme-purple {
		background: #6D2281
	}
	.theme-pink {
		background: #CA206C
	}
	.theme-gray {
		background: #222
	}
	.theme-black {
		background: #000
	}
	.theme-dark-blue {
		background: #020D45
	}
	
	.images {
		background-repeat: no-repeat !impotent;
		background-position: center center !important;
		background-size: cover !important;
		border: 1px solid #aaa;
		width: 33.33%;
		height: 100px;
		float: left;
	}

@media (min-width: 400px) {
	
	/* Larger than mobile */
	
	.images {
		height: 160px;
	}
	
}
	
@media (min-width: 750px) {
		
	body {
		padding: 20px;
		max-width: 600px;
		margin: 10% auto;
		border: 1px solid rgba(50,50,50,0.2);
		box-shadow: 1px 1px 8px rgba(50,50,50,0.2);
		font-size: medium;
	}
	.col-2 {
		float: left;
		width: 50%;
	}
	button {
		font-size: medium;
	}
		
	}
	</style>
	</head>
<body>
	<div id="wrapper">