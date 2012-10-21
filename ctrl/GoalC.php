<?php

	include_once('setup.php');

	$action = $_REQUEST['act'];
	
	switch($action){
		// page new goal
		case 'new':
			$sm = new sm('goal');
			
			// userID
			session_start();
			$sm->assign('userID', $_SESSION['valid_user_id']);
			
			$sm->display('new.tpl');
			break;
		
		// page	edit goal	
		case 'edit':
			$sm = new sm('goal');
			
			// goal
			$goalID = $_REQUEST['goalID'];
		 	$goal = get_goal_by_ID($goalID);
			$sm->assign('goal', $goal);
			
			$sm->display('edit.tpl');
			break;
		
		//page goal details		
		case 'details':
			$sm = new sm('goal');
			
			// userID
			session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			
			// goal
			$goalID = $_REQUEST['goalID'];	
			$sm->assign('goal', get_goal_by_ID($goalID));
			
			// isFinished			
			$sm->assign('isFinished', check_goal_is_finished($goalID));
			
			// isCreator
			$isCreator = check_goal_ownership($goalID, $_SESSION['valid_user_id']);
			$sm->assign('isCreator', $isCreator? 1: 0);
			
			// isCheered
			if(!$isCreator){
				$sm->assign('isCheered', check_goal_is_cheered($userID, $GOAL_ID));
			}
			
			// steps
			$steps = get_steps($goalID);
			$sm->assign('stepsNum', count($steps));
			$sm->assign('steps', $steps);
			
			// logs pager
			$logsNum = get_goal_logs_num($goalID);
			$pagesNum = ($logsNum == 0)? 1: floor(($logsNum + 19) / 20);
			$sm->assign('pagesNum', $pagesNum);
			
			// creator info
			$creator = get_goal_owner($goalID);
			$sm->assign('creator', $creator);
			$sm->assign('creatorAvatar', get_gravatar($creator['UserID']));
			
			// cheerer
			$cheerers = get_goal_cheerers($goalID, 16);
			$sm->assign('cheerersNum', count($cheerers));
			$sm->assign('cheerers', $cheerers);
			
			$sm->display('details.tpl');
			break;
	}
?>