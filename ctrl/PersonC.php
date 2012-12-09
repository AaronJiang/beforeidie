<?php

	include_once('setup.php');
	
	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];
	
	switch($action){
	
	// person
		
		// get view
		case 'person':
			$sm = new sm('person');
			
			// userID, username, userAvatar
			$userID = isset($_REQUEST['userID'])? $_REQUEST['userID']: $_SESSION['valid_user_id'];
			$sm->assign('user', array('ID' => $userID,
									'Name' => get_username_by_id($userID),
									'Avatar' => get_gravatar($userID)));

			// currUserID
			@session_start();
			$currUserID = $_SESSION['valid_user_id'];
			$sm->assign('currUserID', $currUserID);
			
			// isMe
			$isMe = ($userID == $currUserID)? 1: 0;
			$sm->assign('isMe', $isMe);

			// isFollowed
			$isFollowed = check_is_followed($currUserID, $userID);
			$sm->assign('isFollowed', $isFollowed);
										
			// goals
			$goals = get_goals($userID, false);
			$sm->assign('goals', $goals);
			
			// followersNum
			$sm->assign('followersNum', get_followers_num($userID));
			
			// followeesNum
			$sm->assign('followeesNum', get_followees_num($userID));
			
			$sm->display('person.tp');
			break;
			
		// follow users
		case "follow_user":
			follow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump($_SERVER['HTTP_REFERER']);
			break;

		// disfollow user
		case "disfollow_user":
			disfollow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump($_SERVER['HTTP_REFERER']);			
			break;

		// get dynamics
		case 'get_dyns':
			$sm = new sm('person');
			
			//userID, userAvatar
			@session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			$userAvatar = get_gravatar($userID);
			$sm->assign('userAvatar', $userAvatar);
			
			// dyns
			$dynUserID = $_REQUEST['userID'];
			$dyns = get_dynamics($dynUserID, $_REQUEST['pageIndex'], $_REQUEST['numPerPage'], $_REQUEST['isMe']);
			
			foreach($dyns as &$dyn){
				// poster avatar
				$dyn['PosterAvatar'] = get_gravatar($dyn['PosterID']);
				
				//comments
				if($dyn['Type'] == 'newLog' || $dyn['Type'] == 'finishGoal'){
					// comments, commentsNum
					$comments = get_log_comments_full($dyn['LogID']);
					$dyn['commentsNum'] = count($comments);
					$dyn['comments'] = $comments;
				}
			}
			$sm->assign('dyns', $dyns);

			$output = $sm->fetch('dyns.tc');
			echo $output;
			break;

		// get about me dynamics
		case 'get_about_me_dyns':
			$sm = new sm('person');
			
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
			
			$sm->display('about_me_dyns.tc');
			break;
			
		// drop goal
		case "drop_goal":
			drop_goal($_REQUEST['goalID']);
			page_jump_back();
			break;
			
	// followers
		
		// get view
		case 'followers':
			$sm = new sm('person');
			
			// userID
			@session_start();
			$userID = $_REQUEST['userID'];
			$sm->assign('userID', $userID);
			$sm->assign('username', get_username_by_id($userID));
			
			// followees
			$isMe = ($userID == $_SESSION['valid_user_id']);
			@$followers = get_followers($userID);
			foreach($followers as &$fow){
				$fow['Avatar'] = get_gravatar($fow['UserID']);
				$fow['GoalsNum'] = get_goals_num($fow['UserID'], $isMe);
			}
			$sm->assign('followers', $followers);
			$sm->assign('followersNum', count($followers));
			
			$sm->display('followers.tp');
			break;

	// followees
	
		// get view
		case 'followees':
			$sm = new sm('person');
			
			// userID
			@session_start();
			$userID = $_REQUEST['userID'];
			$sm->assign('userID', $userID);
			$sm->assign('username', get_username_by_id($userID));
			
			// followees
			$isMe = ($userID == $_SESSION['valid_user_id']);
			@$followees = get_followees($userID);
			foreach($followees as &$fow){
				$fow['Avatar'] = get_gravatar($fow['UserID']);
				$fow['GoalsNum'] = get_goals_num($fow['UserID'], $isMe);
			}
			$sm->assign('followees', $followees);
			$sm->assign('followeesNum', count($followees));
			
			$sm->display('followees.tp');
			break;
	}
	
?>