<?php

	include_once('setup.php');
	include_once('../html_helper.php');

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
			
			// userID
			$userID = $_REQUEST['userID'];
			$sm->assign('userID', $userID);
			
			// username
			$sm->assign('username', get_username_by_id($userID));
			
			// isMe
			session_start();
			$sm->assign('isMe', $userID == $_SESSION['valid_user_id']? 1: 0);
			
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
		
		// dyn proc
		case 'getFolloweeDyns':
		case 'getSingleDyns':
			$sm = new sm('dyn');
			
			//userID, userAvatar
			session_start();
			$userID = $_SESSION['valid_user_id'];
			$sm->assign('userID', $userID);
			$userAvatar = get_gravatar($userID);
			$sm->assign('userAvatar', $userAvatar);
			
			// dyns
			$dynUserID = $_REQUEST['userID'];
			if($action == 'getFolloweeDyns'){
				$dynType = 'followee';
			}
			elseif($action == 'getSingleDyns'){
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
					// commentsNum
					$comments = get_log_comments($dyn['LogID']);
					$dyn['commentsNum'] = count($comments);
						
					// comments
					foreach($comments as &$comm){
						// comment poster
						$comm['Poster'] = get_username_by_id($comm['PosterID']);
						
						// comment poster avatar
						$comm['Avatar'] = get_gravatar($comm['PosterID']);
						
						// comment receiver, receiverID
						if(!$comm['IsRoot']){
							$comm['ReceiverID'] = get_posterid_by_commentid($comm['ParentCommentID']);
							$comm['Receiver'] = get_username_by_id($comm['ReceiverID']);
						}						
					}
					$dyn['comments'] = $comments;
				}
			}
			$sm->assign('dyns', $dyns);
			
			// output
			$output = $sm->fetch('userDyns.tc');
			echo $output;
			break;

		case 'getAboutMeDyns':
			$sm = new sm('dyn');
			
			//userID, userAvatar
			session_start();
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
					$comments = get_log_comments($dyn['LogID']);
					$dyn['commentsNum'] = count($comments);
						
					// comments
					foreach($comments as &$comm){
						// comment poster
						$comm['Poster'] = get_username_by_id($comm['PosterID']);
						
						// comment poster avatar
						$comm['Avatar'] = get_gravatar($comm['PosterID']);
						
						// comment receiver, receiverID
						if(!$comm['IsRoot']){
							$comm['ReceiverID'] = get_posterid_by_commentid($comm['ParentCommentID']);
							$comm['Receiver'] = get_username_by_id($comm['ReceiverID']);
						}						
					}
					$dyn['comments'] = $comments;
				}
			}
			$sm->assign('dyns', $dyns);
			
			$sm->display('aboutMeDyns.tc');
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