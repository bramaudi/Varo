<div class="no-padding">

<div class="row sub-item">
<span class="link sub-active" data-target="/?v=inbox"><span class="oi" data-glyph="envelope-closed"></span> Inbox</span>
<span class="sub-current"><span class="oi" data-glyph="task"></span> Sent</span>
</div>

<div id="showSent"></div>

</div>

<script>
$('#showSent').load('/ajax/ajax_sent.php');
$(document).ready(function(){
setInterval(function(){
$('#showSent').load('/ajax/ajax_sent.php');
}, 1000);
});
</script>