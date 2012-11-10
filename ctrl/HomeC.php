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

			// hot goals			
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$hotGoals = get_hot_goals($userID);
			foreach($hotGoals as &$goal){

				// creator, creatorID
				$creator = get_goal_owner($goal['GoalID']);
				$goal['CreatorID'] = $creator['UserID'];
				$goal['Creator'] = $creator['Username'];
				
				// logsNum, cheersNum
				$goal['LogsNum'] = get_goal_logs_num($goal['GoalID']);
				$goal['CheersNum'] = get_goal_cheers_num($goal['GoalID']);
			}
			$sm->assign('hotGoals', $hotGoals);
			
			$sm->display('home.tp');
			break;

	// about
	
		// get view
		case "about":
			$sm = new sm('home');
			$sm->display('about.tp');
			break;
		
	// terms
		
		// get view
		case "terms":
			$sm = new sm('home');
			$sm->display('terms.tp');
			break;
	}

?>