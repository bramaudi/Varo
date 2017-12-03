<?php

// global variable
$global_title = '&radic;aro';

// default site variable
$site = array(
'title' => $global_title
);

// show
$v = isset($_GET['v']) ? trim($_GET['v']):'';

require_once 'database.php';
require_once 'function.php';
require_once 're_check.php';

switch ($v) {
	
	// index
	default:
	require_once './control/control_home.php';
	break;
	
	// not found
	case '404':
	require_once './control/control_404.php';
	break;
	
	// cookie management
	case 'cookie':
	require_once './control/control_cookie.php';
	break;
	
	// login
	case 'login':
	require_once './control/control_login.php';
	break;
	
	// registration
	case 'register':
	require_once './control/control_register.php';
	break;
	
	// show profile
	case 'profile':
	require_once './control/control_profile.php';
	break;
	
	// edit profile
	case 'setting':
	require_once './control/control_setting.php';
	break;
	
	// change password
	case 'password':
	require_once './control/control_password.php';
	break;
	
	// edit profile picture
	case 'picture':
	require_once './control/control_picture.php';
	break;
	
	// inbox
	case 'inbox':
	require_once './control/control_inbox.php';
	break;
	
	// sent
	case 'sent':
	require_once './control/control_sent.php';
	break;
	
	// chat
	case 'messages':
	require_once './control/control_messages.php';
	break;
	
	// friend list
	case 'friend':
	require_once './control/control_friend.php';
	break;
	
	// view forum
	case 'forum':
	require_once './control/control_forum.php';
	break;
	
	// delete forum
	case 'deleteForum':
	require_once './control/control_deleteForum.php';
	break;
	
	// add post
	case 'addPost':
	require_once './control/control_addPost.php';
	break;
	
	// edit post
	case 'editPost':
	require_once './control/control_editPost.php';
	break;
	
	// read post
	case 'post':
	require_once './control/control_post.php';
	break;
	
	// edit comment
	case 'editComment':
	require_once './control/control_editComment.php';
	break;
	
	// delete comment
	case 'deleteComment':
	require_once './control/control_deleteComment.php';
	break;
	
	// banned
	case 'ban':
	require_once './control/control_banned.php';
	break;
	
	// gallery
	case 'gallery':
	require_once './control/control_gallery.php';
	break;
	
	// album
	case 'album':
	require_once './control/control_album.php';
	break;
	
	// delete album
	case 'deleteAlbum':
	require_once './control/control_deleteAlbum.php';
	break;
	
	// add images
	case 'addImages':
	require_once './control/control_addImages.php';
	break;
	
	// delete images
	case 'deleteImages':
	require_once './control/control_deleteImages.php';
	break;
	
	// view images
	case 'images':
	require_once './control/control_images.php';
	break;
	
}