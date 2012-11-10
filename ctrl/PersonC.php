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
			$userID = $_REQUEST['userID'];
			$sm->assign('user', array('ID' => $userID,
									'Name' => get_username_by_id($userID),
									'Avatar' => get_gravatar($userID)));

			// currUserID
			@session_start();
			$currUserID = $_SESSION['valid_user_id'];
			$sm->assign('currUserID', $currUserID);
			
			// isMe, isFollowed
			$isMe = ($userID == $currUserID);
			$sm->assign('isMe', $isMe);
			$isFollowed = check_is_followed($currUserID, $userID);
			$sm->assign('isFollowed', $isFollowed);
										
			// goals
			$goals = get_goals($userID, false);
			foreach($goals as &$goal){
				$goal['logsNum'] = get_goal_logs_num($goal['GoalID']);
				$goal['cheersNum'] = get_goal_cheers_num($goal['GoalID']);
			}
			$sm->assign('goals', $goals);
			
			// dyns
			$sm->assign('dyns', get_dynamics('single', $userID, 1, 3));
			
			// followers
			$sm->assign('followersNum', get_followers_num($userID));
			$followers = @get_followers($userID, 16);
			foreach($followers as &$follower){
				$follower['Avatar'] = get_gravatar($follower['UserID']);
			}
			$sm->assign('followers', $followers);
			
			// followees
			$sm->assign('followeesNum', get_followees_num($userID));
			$followees = get_followees($userID, 16);
			foreach($followees as &$followee){
				$followee['Avatar'] = get_gravatar($followee['UserID']);
			}
			$sm->assign('followees', $followees);
			
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

	// person dyns
		
		// get view
		case 'personal_dyns':
			$sm = new sm('person');
			
			// userID
			$userID = $_REQUEST['userID'];
			$sm->assign('userID', $userID);
			
			// username
			$sm->assign('username', get_username_by_id($userID));
			
			// isMe
			@session_start();
			$sm->assign('isMe', $userID == $_SESSION['valid_user_id']? 1: 0);
			
			$sm->display('personal_dyns.tp');
			break;
			
	// followers
		
		// get view
		case 'followers':
			$sm = new sm('person');
			
			// userID, username
			$userID = $_REQUEST['userID'];
			$sm->assign('userID', $userID);
			$sm->assign('username', get_username_by_id($userID));

			// followers
			@$followers = get_followers($userID);
			foreach($followers as &$follower){
				$follower['Avatar'] = get_gravatar($follower['UserID']);
			}
			$sm->assign('followers', $followers);
			
			$sm->display('followers.tp');
			break;

	// followees
	
		// get view
		case 'followees':
			$sm = new sm('person');

			// follower, followerID
			$userID = $_REQUEST['userID'];
			$sm->assign('userID', $userID);
			$sm->assign('username', get_username_by_id($userID));

			// followers
			@$followees = get_followees($userID);
			foreach($followees as &$followee){
				$followee['Avatar'] = get_gravatar($followee['UserID']);
			}
			$sm->assign('followees', $followees);
			
			$sm->display('followees.tp');
			break;
	}
	
?>