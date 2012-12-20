<?php

	include_once('setup.php');

	browser_check();
	auth_check();

	$action = $_REQUEST['act'];

	switch($action){
		case "like":
			$sm = new sm('like');

			@session_start();
			$goals = get_likes($_SESSION['valid_user_id']);
			foreach ($goals as &$goal) {
				// 截取定长的中文字符
				if(mb_strlen($goal['Content'], 'utf8') > 25){
					$goal['Content'] = mb_substr(strip_tags($goal['Content']), 0, 25, 'utf8'). '...';
				}
			}
			$sm->assign('goals', $goals);

			$sm->display('like.tp');
			break;

		case "":
			break;
	}

?>