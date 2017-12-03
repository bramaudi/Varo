<div class="no-padding">

<div class="row sub-item">
<span class="sub-current"><span class="oi" data-glyph="envelope-closed"></span> Inbox</span>
<span class="link sub-active" data-target="/?v=sent"><span class="oi" data-glyph="task"></span> Sent</span>
</div>

<div id="showInbox"></div>

</div>

<script>
$('#showInbox').load('/ajax/ajax_inbox.php');
setInterval(function(){
$('#showInbox').load('/ajax/ajax_inbox.php');
}, 1000);
</script>