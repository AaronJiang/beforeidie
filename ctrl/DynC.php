<?php

	include_once('setup.php');

	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];
	
	switch($action){

	// dyns
		
		// get view
		case 'dyns':
			$sm = new sm('dyn');
			
			// userID			
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			
			// followees num
			$followeesNum = get_followees_num($userID);
			$sm->assign('followeesNum', $followeesNum);
			
			// followees
			$followees = get_followees($userID, 16);
			foreach($followees as &$followee){
				$followee['Avatar'] = get_gravatar($followee['UserID']);
			}
			$sm->assign('followees', $followees);

			$sm->display('dyns.tp');
			break;

		// get_followee_dyns
		case 'get_followee_dyns':
		case 'get_single_dyns':
			$sm = new sm('dyn');
			
			//userID, userAvatar
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			$userAvatar = get_gravatar($userID);
			$sm->assign('userAvatar', $userAvatar);
			
			// dyns
			$dynUserID = $_REQUEST['userID'];
			if($action == 'get_followee_dyns'){
				$dynType = 'followee';
			}
			elseif($action == 'get_single_dyns'){
				$dynType = 'single';
			}
			$dyns = get_dynamics($dynType, $dynUserID, $_REQUEST['pageIndex'], $_REQUEST['numPerPage']);
			
			foreach($dyns as &$dyn){
				// poster avatar
				$dyn['PosterAvatar'] = get_gravatar($dyn['PosterID']);
				
				// isCheered
				if($dyn['Type'] == 'newGoal'){
					$dyn['isCheered'] = check_goal_is_cheered($userID, $dyn['GoalID']);
				}
				
				//comments
				if($dyn['Type'] == 'newLog' || $dyn['Type'] == 'finishGoal'){
					// comments, commentsNum
					$comments = get_log_comments_full($dyn['LogID']);
					$dyn['commentsNum'] = count($comments);
					$dyn['comments'] = $comments;
				}
			}
			$sm->assign('dyns', $dyns);

			$output = $sm->fetch('userDyns.tc');
			echo $output;
			break;

		// get about me dyns
		case 'get_about_me_dyns':
			$sm = new sm('dyn');
			
			//userID, userAvatar
			@@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			$userAvatar = get_gravatar($userID);
			$sm->assign('userAvatar', $userAvatar);
			
			// dyns
			$dyns = get_dynamics_about_me($_REQUEST['userID'], $_REQUEST['pageIndex'], $_REQUEST['numPerPage']);
			foreach($dyns as &$dyn){
				$dyn['PosterAvatar'] = get_gravatar($dyn['PosterID']);
				
				//comments
				if($dyn['Type'] == 'newCommentOnMyLog' || $dyn['Type'] == 'newCommentOnOtherLog'){
					// commentsNum
					$comments = get_log_comments_full($dyn['LogID']);
					$dyn['commentsNum'] = count($comments);
					$dyn['comments'] = $comments;
				}
			}
			$sm->assign('dyns', $dyns);
			
			$sm->display('aboutMeDyns.tc');
			break;
			
	// admin followees
		
		// get view
		case 'admin_followees':
			$sm = new sm('dyn');
			
			// userID
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			
			// followees
			@$followees = get_followees($userID);
			foreach($followees as &$fow){
				$fow['Avatar'] = get_gravatar($fow['UserID']);
				$fow['GoalsNum'] = array(
					'now' => get_goals_num($fow['UserID'], 'now', false),
					'future' => get_goals_num($fow['UserID'], 'future', false),
					'finish' => get_goals_num($fow['UserID'], 'finish', false)
				);
			}
			$sm->assign('followees', $followees);
			$sm->assign('followeesNum', count($followees));
			
			$sm->display('admin_followees.tp');
			break;
		
		// disfollow user
		case "disfollow_user":
			disfollow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump($_SERVER['HTTP_REFERER']);			
			break;
			
	
	}