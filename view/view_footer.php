<?php
if (logged()) {
?>

<script>$('.newMessages').load('/ajax/ajax_sweetCoffee.php');
setInterval(function(){
		$('.newMessages').load('/ajax/ajax_sweetCoffee.php');
	}, 1000);</script>
	
<?php
}
?>

</div><!-- .container -->

<script src="/assets/slideout.min.js"></script>
<script src="/assets/varo.js"></script>
<script src="/assets/jquery.lazyload.min.js"></script>
<script>$('.lazy').lazyload({effect: "fadeIn"});</script>

</body>
</html>