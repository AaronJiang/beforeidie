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
		
		// page goal details
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
			
			// cheerers
			$cheerers = get_goal_cheerers($goalID, 16);
			foreach($cheerers as &$cheerer){
				$cheerer['Avatar'] = get_gravatar($cheerer['UserID']);
			}
			$sm->assign('cheerersNum', count($cheerers));
			$sm->assign('cheerers', $cheerers);
			
			$sm->display('details.tpl');
			break;
			
		// page cheerers
		case "cheerers":
			$sm = new sm('goal');
			
			// goalID
			$goalID = $_REQUEST['goalID'];
			$sm->assign('goalID', $goalID);
			
			// goalTitle			
			$goal = get_goal_by_ID($goalID);
			$sm->assign('goalTitle', $goal['Title']);
			
			// cheerers
			@$cheerers = get_goal_cheerers($goalID);
			foreach($cheerers as &$cheerer){
				$cheerer['Avatar'] = get_gravatar($cheerer['UserID']);
			}
			$sm->assign('cheerers', $cheerers);
			
			$sm->display('cheerers.tpl');
			break;

		// goal procs
		case "getGoals":
			$goals = get_goals($_REQUEST['goalType'], $_REQUEST['userID']);
			echo urldecode(json_encode(urlencodeAry($goals)));
			break;
		
		case "deleteGoal":
			delete_goal($_REQUEST['goalID']);
			break;
			
		case "newGoal":
			$goalID = new_goal($_REQUEST['userID'], $_REQUEST['title'], $_REQUEST['why'], $_REQUEST['goalType'], $_REQUEST['startTime'], $_REQUEST['isPublic']);
			redirect('Home', 'home', array('goalType' => $_REQUEST['goalType']));
			break;
			
		case "startGoal":
			start_goal($_REQUEST['goalID']);
			redirect('Home', 'home', array('goalType' => 'now'));
			break;
			
		case "delayGoal":
			delay_goal($_REQUEST['goalID'], $_REQUEST['startTime']);
			redirect('Home', 'home');
			break;
			
		case "updateGoal":
			update_goal($_REQUEST['goalID'], $_REQUEST['title'], $_REQUEST['why'], $_REQUEST['goalType'], $_REQUEST['startTime'], $_REQUEST['isPublic']);
			redirect('Home', 'home', array('goalType' => $_REQUEST['goalType']));
			break;
		
		case "finishGoal":
			$goalID = $_REQUEST['goalID'];
			new_log($_REQUEST['logTitle'], $_REQUEST['logContent'], 0, $goalID);
			finish_goal($goalID);
			page_jump_back();
			break;
		
		case "dropGoal":
			drop_goal($_REQUEST['goalID']);
			page_jump_back();
			break;
		
		case "updateGoalReason":
			update_goal_reason($_REQUEST['goalID'], $_REQUEST['goalReason']);
			page_jump_back();
			break;
			
		case "updateGoalTitle":
			update_goal_title($_REQUEST['goalID'], $_REQUEST['goalTitle']);
			page_jump_back();
			break;
		
		// step procs 
		case "getSteps":
			$steps = get_steps($_REQUEST['goalID']);
			echo urldecode(json_encode(urlencodeAry($steps)));
			break;
			
		case "updateStep":
			echo update_step($_REQUEST['stepID'], $_REQUEST['stepContent'], $_REQUEST['stepIndex']);
			break;
			
		case "newStep":
			echo new_step($_REQUEST['goalID'], $_REQUEST['stepContent'], $_REQUEST['stepIndex']);
			break;
			
		case "deleteStep":
			echo delete_step($_REQUEST['stepID']);
			break;
			
		// log procs
		case "getLogs":
			$logs = get_logs($_REQUEST['goalID'], $_REQUEST['pageNum'], $_REQUEST['numPerPage']);
			echo urldecode(json_encode(urlencodeAry($logs)));
			break;
			
		case "deleteLog":
			delete_log($_REQUEST['logID']);
			page_jump_back();
			break;
			
		case "newLog":
			$logTitle = isset($_REQUEST['logTitle'])? $_REQUEST['logTitle']: '';
			new_log($logTitle, $_REQUEST['logContent'], $_REQUEST['typeID'], $_REQUEST['goalID']);
			update_goal_updatetime($_REQUEST['goalID'], now_time());
			page_jump_back();
			break;
			
		case "updateLog":
			update_log($_REQUEST['logID'], $_REQUEST['logTitle'], $_REQUEST['logContent']);
			page_jump_back();
			break;
		
		// comment procs
		case "newComment":
			new_comment($_REQUEST['comment'], $_REQUEST['posterID'], $_REQUEST['logID'], $_REQUEST['parentCommentID'], $_REQUEST['isRoot']);
			page_jump_back();		
			break;

		// cheerer proc
		case "cheer":
			cheer($_REQUEST['userID'], $_REQUEST['goalID']);
			page_jump_back();
			break;
	}
?>