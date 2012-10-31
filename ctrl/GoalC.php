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

			// userID
			@session_start();
			$sm->assign('userID', $_SESSION['valid_user_id']);

			$sm->display('new.tp');
			break;

		// create a new goal
		case "new_goal":
			$goalID = new_goal($_REQUEST['userID'], $_REQUEST['title'], $_REQUEST['why'], $_REQUEST['goalType'], $_REQUEST['startTime'], $_REQUEST['isPublic']);
			redirect('Home', 'home', array('goalType' => $_REQUEST['goalType']));
			break;
		
	// edit goal
	
		// get view
		case 'edit':
			$sm = new sm('goal');
			
			// goal
			$goalID = $_REQUEST['goalID'];
		 	$goal = get_goal_by_ID($goalID);
			$sm->assign('goal', $goal);
			
			$sm->display('edit.tp');
			break;
			
		case "update_goal":
			update_goal($_REQUEST['goalID'], $_REQUEST['title'], $_REQUEST['why'], $_REQUEST['goalType'], $_REQUEST['startTime'], $_REQUEST['isPublic']);
			redirect('Home', 'home', array('goalType' => $_REQUEST['goalType']));
			break;
	
	// goal details
		
		// get views
		case 'details':
			$sm = new sm('goal');
			
			// userID
			@session_start();
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
			
			$sm->display('details.tp');
			break;
			
		// finish goal
		case "finish_goal":
			$goalID = $_REQUEST['goalID'];
			new_log($_REQUEST['logTitle'], $_REQUEST['logContent'], 0, $goalID);
			finish_goal($goalID);
			page_jump_back();
			break;
		
		// update goal reason
		case "update_goal_reason":
			update_goal_reason($_REQUEST['goalID'], $_REQUEST['goalReason']);
			page_jump_back();
			break;
		
		// update goal title
		case "update_goal_title":
			update_goal_title($_REQUEST['goalID'], $_REQUEST['goalTitle']);
			page_jump_back();
			break;

		// cheer goal
		case "cheer_goal":
			cheer($_REQUEST['userID'], $_REQUEST['goalID']);
			page_jump_back();
			break;
			
		// get steps
		case "get_steps":
			$steps = get_steps($_REQUEST['goalID']);
			echo urldecode(json_encode(urlencodeAry($steps)));
			break;
		
		// update step
		case "update_step":
			echo update_step($_REQUEST['stepID'], $_REQUEST['stepContent'], $_REQUEST['stepIndex']);
			break;
		
		// new step
		case "new_step":
			echo new_step($_REQUEST['goalID'], $_REQUEST['stepContent'], $_REQUEST['stepIndex']);
			break;
		
		// delete step
		case "delete_step":
			echo delete_step($_REQUEST['stepID']);
			break;
			
		// get logs
		case "get_logs":
			$sm = new sm('goal');
			
			// userID, userAvatar
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			$sm->assign('userAvatar', get_gravatar($userID));

			// isCreator
			$sm->assign('isCreator', $_REQUEST['isCreator']);
			
			// logs
			$logs = get_logs($_REQUEST['goalID'], $_REQUEST['pageNum'], $_REQUEST['numPerPage']);
			foreach($logs as &$log){
				// comments, commentsNum
				$comments = get_log_comments_full($log['LogID']);
				$log['commentsNum'] = count($comments);
				$log['comments'] = $comments;
			}
			$sm->assign('logsNum', count($logs));
			$sm->assign('logs', $logs);
			
			$output = $sm->fetch('logs.tc');
			echo $output;
			break;
		
		// delete log
		case "delete_log":
			delete_log($_REQUEST['logID']);
			page_jump_back();
			break;
		
		// new log
		case "new_log":
			$logTitle = isset($_REQUEST['logTitle'])? $_REQUEST['logTitle']: '';
			new_log($logTitle, $_REQUEST['logContent'], $_REQUEST['typeID'], $_REQUEST['goalID']);
			update_goal_updatetime($_REQUEST['goalID'], now_time());
			page_jump_back();
			break;
			
		// update log
		case "update_log":
			update_log($_REQUEST['logID'], $_REQUEST['logTitle'], $_REQUEST['logContent']);
			page_jump_back();
			break;
		
		// new comment
		case "newComment":
			new_comment($_REQUEST['comment'], $_REQUEST['posterID'], $_REQUEST['logID'], $_REQUEST['parentCommentID'], $_REQUEST['isRoot']);
			page_jump_back();		
			break;
			
	// goal cheerers
		
		// get view
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
			
			$sm->display('cheerers.tp');
			break;
	}
?>