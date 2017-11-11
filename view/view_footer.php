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

</div><!-- .wrapper -->
</body>
</html>