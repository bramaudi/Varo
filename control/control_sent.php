<?php

if (!logged()){
	redir('/');
}

$site = array(
'title' => 'Sent messages'
);

require_once './view/view_header.php';

require_once './view/view_sent.php';

require_once './view/view_footer.php';