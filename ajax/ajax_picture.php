<?php

require_once '../database.php';
require_once '../re_check.php';
require_once '../function.php';

if (!logged()) {
	redir('/');
}

$set = $db->query("SELECT * FROM varo_users WHERE `key` = '".$_COOKIE['logged']."'")->fetch_assoc();

if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "../files/".$set['user'].".jpg";
$isImage = getimagesize($sourcePath);
$size = filesize($sourcePath);

if (!$isImage) {
	
	echo '
<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> Invalid image.</div>';
	
} elseif ($size > 10485760) {
	// 10 mb
	
	echo '
<div class="warning"><span class="oi" data-glyph="warning" title="warning" aria-hidden="true"></span> Image size too large, max 10mb.</div>';
	
} elseif(compress($sourcePath,$targetPath,20)) {

echo '<meta http-equiv="refresh" content="2; url=/?v=picture">
<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> Compete, refreshing ...</div>';

}
} else {
	
	echo '
<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> Choose an image.</div>';
	
}
}