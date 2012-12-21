<?php

	include_once('setup.php');
	
	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];
	
	switch($action){
	
	// page person
		
		// view
		case 'person':

			$sm = new sm('person');
			
			// userinfo
			$userID = isset($_REQUEST['userID'])? $_REQUEST['userID']: $_SESSION['valid_user_id'];
			$sm->assign('user', get_user_by_id($userID));

			// likesNum
			$sm->assign('likesNum', get_likes_num($userID));

			// currUserID
			@session_start();
			$currUserID = $_SESSION['valid_user_id'];
			$sm->assign('currUserID', $currUserID);
			
			// isCreator
			$isCreator = ($userID == $currUserID)? 1: 0;
			$sm->assign('isCreator', $isCreator);

			// isFollowed
			$isFollowed = check_is_followed($currUserID, $userID);
			$sm->assign('isFollowed', $isFollowed);
										
			// goals
			$goals = get_goals($userID, $isCreator);
			$sm->assign('goals', $goals);
			
			// followersNum
			$sm->assign('followersNum', get_followers_num($userID));
			
			// followeesNum
			$sm->assign('followeesNum', get_followees_num($userID));
			
			$sm->display('person.tp');
			break;

		case "change_goal_state":
			$isSucc = change_goal_state($_REQUEST['goalID'], $_REQUEST['isPublic']);
			echo $isSucc? 1: 0;
			break;

		case "update_signature":
			echo update_signature($_REQUEST['userID'], $_REQUEST['signature'])? 1: 0;
			break;

		case "follow_user":
			follow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump_back();
			break;

		case "disfollow_user":
			disfollow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump_back();			
			break;
			
		case "drop_goal":
			echo drop_goal($_REQUEST['goalID'])? 1: 0;
			break;

	// likes
		case 'likes':
			$sm = new sm('person');
			
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