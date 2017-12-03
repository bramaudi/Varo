$(document).ready(function(){
	$('#preload').hide();
});

var slideout = new Slideout({
		'panel': document.getElementById('panel'),
		'menu': document.getElementById('menu'),
		'padding': 256,
		'tolerance': 100,
		'side': 'right'
});

$('#nav-btn').click(function(){
	slideout.toggle();
});

$('.link').click(function(){
	var url = $(this).attr('data-target');
	window.location = url;
});