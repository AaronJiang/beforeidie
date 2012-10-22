<?php

	include_once('setup.php');

	$action = $_REQUEST['act'];
	
	switch($action){
		// page followee dyns
		case 'followeeDyns':
			$sm = new sm('dyn');
			
			// userID			
			session_start();
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

			$sm->display('followeeDyns.tpl');
			break;
		
		// page single dyns
		case 'singleDyns':
			$sm = new sm('dyn');
			$sm->display('singleDyns.tpl');
			break;
			
		// page followers
		case 'followers':
			$sm = new sm('dyn');
			break;

		// page followees
		case 'followees':
			$sm = new sm('dyn');
			break;
			
		// page admin followees
		case 'adminFollowees':
			$sm = new sm('dyn');
			
			// userID
			session_start();
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
			
			$sm->display('adminFollowees.tpl');
			break;
		
		// follow proc
		case "follow":
			follow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump($_SERVER['HTTP_REFERER']);
			break;
			
		case "disfollow":
			disfollow_user($_REQUEST['followerID'], $_REQUEST['followeeID']);
			page_jump($_SERVER['HTTP_REFERER']);			
			break;
	}