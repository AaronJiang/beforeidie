<?php

	include_once('setup.php');
	
	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];
	
	switch($action){

	// Discover
	
		// get view
		case "discover":
			$sm = new sm('discover');

			// hot goals			
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$hotGoals = get_hot_goals($userID);
			foreach($hotGoals as &$goal){

				// creator, creatorID
				$creator = get_goal_owner($goal['GoalID']);
				$goal['CreatorID'] = $creator['UserID'];
				$goal['Creator'] = $creator['Username'];
			}
			$sm->assign('hotGoals', $hotGoals);
			
			$sm->display('discover.tp');
			break;
	}
?>