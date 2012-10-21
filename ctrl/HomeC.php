<?php
	include_once('setup.php');		
	
	$action = $_REQUEST['act'];

	switch($action){
		case "home":
			$sm = new sm('home');
			
			session_start();
			$userID = $_SESSION['valid_user_id'];
			
			//自动启动 Goal
			autostart_goals($userID);

			$sm->assign('goalNum', array('now' => get_goals_num($userID, "now", true),
										'future' => get_goals_num($userID, "future", true),
										'finish' => get_goals_num($userID, "finish", true)
										));
	
			$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';
			$sm->assign('goalType', $goalType);
			$sm->assign('goals', get_goals($userID, $goalType, true));
			
			$sm->display('home.tpl');
			break;

		case "about":
			$sm = new sm('home');
			$sm->display('about.tpl');
			break;

		case "terms":
			$sm = new sm('home');
			$sm->display('terms.tpl');
			break;
	}

?>