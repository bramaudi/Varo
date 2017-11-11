<?php

if (!logged()){
	redir('/');
}

$site = array(
'title' => 'Inbox'
);

require_once './view/view_header.php';

require_once './view/view_inbox.php';

require_once './view/view_footer.php';