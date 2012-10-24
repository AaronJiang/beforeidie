<?php

	include_once('setup.php');

	$action = $_REQUEST['act'];
	
	// page person space
	switch($action){
	
		case 'person':
			$sm = new sm('person');
			
			// userID, username, userAvatar
			$userID = $_REQUEST['userID'];
			$sm->assign('user', array('ID' => $userID,
									'Name' => get_username_by_id($userID),
									'Avatar' => get_gravatar($userID)));

			// currUserID
			session_start();
			$currUserID = $_SESSION['valid_user_id'];
			
			// isMe, isFollowed
			$isMe = ($userID == $currUserID);
			$sm->assign('isMe', $isMe);
			$isFollowed = check_is_followed($currUserID, $userID);
			$sm->assign('isFollowed', $isFollowed);
			
			// goalsNum
			$sm->assign('goalsNum', array('now' => get_goals_num($userID, 'now', false),
										'future' => get_goals_num($userID, 'future', false),
										'finish' => get_goals_num($userID, 'finish', false)));
										
			// goals
			$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';
			$goals = get_goals($userID, $goalType, false);
			foreach($goals as &$goal){
				$goal['stepsNum'] = get_goal_steps_num($goal['GoalID']);
				$goal['logsNum'] = get_goal_logs_num($goal['GoalID']);
				$goal['cheersNum'] = get_goal_cheers_num($goal['GoalID']);
			}
			$sm->assign('goals', $goals);
			
			// dyns
			$sm->assign('dyns', get_dynamics('single', $userID, 1, 3));
			
			// followers
			$sm->assign('followersNum', get_followers_num($userID));
			$followers = get_followers($userID, 16);
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
	}
	
?>