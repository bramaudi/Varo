<?php

require_once '../database.php';
require_once '../function.php';
require_once '../re_check.php';

if (!logged()) {
	redir('/');
}

$id = time();
$gallery = (int)$_POST['gallery_id'];

if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "../images/".$id.".jpg";
$isImage = getimagesize($sourcePath);
$size = filesize($sourcePath);

// notification
if (!$isImage) {
	
	echo '
<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> Invalid image.</div>';
	
} elseif ($size > 10485760) {
	// 10 mb
	
	echo '
<div class="warning"><span class="oi" data-glyph="warning" title="warning" aria-hidden="true"></span> Image size too large, max 10mb.</div>';
	
} elseif(compress($sourcePath,$targetPath,20)) {

$db->query("INSERT INTO varo_images SET id = $id, gallery_id = $gallery, author = ".$logged['id']);

echo '<meta http-equiv="refresh" content="2; url=/?v=images&id='.$id.'">
<div class="success"><span class="oi" data-glyph="check" title="check" aria-hidden="true"></span> Compete, refreshing ...</div>';

}
} else {
	
	echo '
<div class="error"><span class="oi" data-glyph="x" title="x" aria-hidden="true"></span> Choose an image.</div>';
	
}
}