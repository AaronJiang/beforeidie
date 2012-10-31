<?php
	include_once('setup.php');

	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];

	switch($action){

	// home
		
		// get view
		case "home":
			$sm = new sm('home');
			
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			
			// 自动启动 Goal
			autostart_goals($userID);

			// goal num
			$sm->assign('goalNum', array('now' => get_goals_num($userID, "now", true),
										'future' => get_goals_num($userID, "future", true),
										'finish' => get_goals_num($userID, "finish", true)
										));
			
			// goal type
			$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';
			$sm->assign('goalType', $goalType);
			
			// goals
			$sm->assign('goals', get_goals($userID, $goalType, true));
			
			$sm->display('home.tpl');
			break;
			
		// start goal
		case "start_goal":
			start_goal($_REQUEST['goalID']);
			redirect('Home', 'home', array('goalType' => 'now'));
			break;
			
		// drop goal
		case "drop_goal":
			drop_goal($_REQUEST['goalID']);
			page_jump_back();
			break;
		
		// delay Goal
		case "delay_goal":
			delay_goal($_REQUEST['goalID'], $_REQUEST['startTime']);
			redirect('Home', 'home');
			break;

	// about
	
		// get view
		case "about":
			$sm = new sm('home');
			$sm->display('about.tpl');
			break;
		
	// terms
		
		// get view
		case "terms":
			$sm = new sm('home');
			$sm->display('terms.tpl');
			break;
	}

?>