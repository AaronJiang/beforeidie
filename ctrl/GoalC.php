<?php

	include_once('setup.php');
	
	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];
	
	switch($action){
			

	// new goal
	
		// get view
		case 'new':
			$sm = new sm('goal');

			@session_start();
			$sm->assign('userID', $_SESSION['valid_user_id']);

			$sm->display('new.tp');
			break;

		// create a new goal
		case "new_goal":
			new_goal($_REQUEST['userID'], $_REQUEST['title'], $_REQUEST['content'], 1);
			break;
	
	// page goal details
		
		// view
		case 'details':
			$sm = new sm('goal');
			
			// userID
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			
			// goal
			$goalID = $_REQUEST['goalID'];	
			$sm->assign('goal', get_goal_by_ID($goalID));
			
			// isCreator
			$isCreator = check_goal_ownership($goalID, $_SESSION['valid_user_id']);
			$sm->assign('isCreator', $isCreator? 1: 0);
			
			// creator info
			$creator = get_goal_owner($goalID);
			$sm->assign('creator', $creator);
			$sm->assign('creatorAvatar', get_gravatar($creator['UserID']));


			// comments
			/*
			$comments = get_log_comments_full($log['LogID']);
			$sm->assign('comments', $comments);
			*/

			$sm->display('details.tp');
			break;

		case "update_goal_title":
			update_goal_title($_REQUEST['goalID'], $_REQUEST['goalTitle']);
			break;
			
		case "update_goal_content":
			update_goal_content($_REQUEST['goalID'], $_REQUEST['content']);
			page_jump_back();
			break;
	}
?>