<?php

	include_once('setup.php');

	browser_check();

	$action = $_REQUEST['act'];

	switch($action){

	// page person

		// view
		case 'person':

			$sm = new sm('person');
			@session_start();

			// 既未登陆也未设置userID号
			if( ! isset($_SESSION['valid_user_id']) AND ! isset($_REQUEST['userID'])){
				redirect('Discover', 'discover');
			}

			// userinfo
			$userID = isset($_REQUEST['userID'])? $_REQUEST['userID']: $_SESSION['valid_user_id'];
			$sm->assign('user', get_user_by_id($userID));

			if(isset($_SESSION['valid_user_id'])){
				// currUserID
				@session_start();
				$currUserID = $_SESSION['valid_user_id'];
				$sm->assign('currUserID', $currUserID);

				// isCreator
				$isCreator = ($userID == $currUserID);

				// hasGravatar
				$sm->assign('hasGravatar', validate_gravatar($currUserID));
			}
			else{
				$isCreator = false;
			}

			$sm->assign('isCreator', $isCreator);

			// goals
			$goals = get_goals($userID, $isCreator);
			$sm->assign('goals', $goals);
			
			$sm->display('person.tp');
			break;

		case "change_goal_state":
			auth_check();
			echo change_goal_state($_REQUEST['goalID'], $_REQUEST['isPublic'])? 1: 0;
			break;
			
		case "drop_goal":
			auth_check();
			echo drop_goal($_REQUEST['goalID'])? 1: 0;
			break;
	}
	
?>