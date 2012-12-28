<?php

	include_once('setup.php');

	browser_check();

	$action = $_REQUEST['act'];

	switch($action){

	// page new goal

		// view
		case 'new':
			auth_check();
			$sm = new sm('goal');

			// userID
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);

			// goalNum
			$sm->assign('isFull', (get_goals_num($userID, true) == 16));

			$sm->display('new.tp');
			break;

		case "new_goal":
			auth_check();
			new_goal($_REQUEST['userID'], $_REQUEST['title'], $_REQUEST['content'], $_REQUEST['isPublic']);
			break;

	// page goal details

		// view
		case 'details':
			$sm = new sm('goal');
			$goalID = $_REQUEST['goalID'];

			// userID
			@session_start();
			if(isset($_SESSION['valid_user_id'])){
				$userID = $_SESSION['valid_user_id'];
				$sm->assign('userID', $userID);

				// isCreator
				$isCreator = check_goal_ownership($goalID, $userID);

				// isLike
				if(!$isCreator){
					$sm->assign('isLike', check_goal_like($goalID, $userID));
				}
			}
			else{
				$isCreator = FALSE;
			}

			$sm->assign('isCreator', $isCreator);

			// goal
			$sm->assign('goal', get_goal_by_ID($goalID));

			// creator info
			$sm->assign('creator', get_goal_owner($goalID));

			$sm->display('details.tp');
			break;

		case "update_goal":
			auth_check();
			echo update_goal($_REQUEST['goalID'], $_REQUEST['goalTitle'], $_REQUEST['goalContent'])? 1: 0;
			break;

		case "change_goal_state":
			auth_check();
			echo change_goal_state($_REQUEST['goalID'], $_REQUEST['isPublic'])? 1: 0;
			break;

		case "change_goal_like":
			auth_check();
			echo change_goal_like($_REQUEST['goalID'], $_REQUEST['userID'], $_REQUEST['isLike'])? 1: 0;
			break;
	}
?>