<?php

	include_once('setup.php');

	browser_check();
	auth_check();

	$action = $_REQUEST['act'];

	switch($action){

	// page new goal

		// view
		case 'new':
			$sm = new sm('goal');

			@session_start();
			$sm->assign('userID', $_SESSION['valid_user_id']);

			$sm->display('new.tp');
			break;

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

			$sm->display('details.tp');
			break;

		case "update_goal":
			ECHO update_goal($_REQUEST['goalID'], $_REQUEST['goalTitle'], $_REQUEST['goalContent'])? 1: 0;
			break;

		case "change_goal_state":
			$isSucc = change_goal_state($_REQUEST['goalID'], $_REQUEST['isPublic']);
			echo $isSucc? 1: 0;
			break;
	}
?>