<?php
	require_once("data_funs.inc");
	
	$proc = trim($_REQUEST['proc']);
	
	switch($proc){
		case "login":
			session_start();
			$isExist = login($_REQUEST['username'], $_REQUEST['password']);
			if($isExist){
				$_SESSION['valid_user'] = $_REQUEST['username'];
				page_jump('home.php');
			}
			else{
				//停留在 login 页面上，并提示用户不存在
			}
			break;
			
		case "logout":
			session_start();
			session_destroy();
			page_jump('home.php');
			break;
		
		case "register":
			new_user($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['email']);
			session_start();
			$_SESSION['valid_user'] = $_REQUEST['username'];
			page_jump('home.php');
			break;
	}

?>