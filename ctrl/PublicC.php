<?php
	include_once('setup.php');

	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];

	switch($action){
	
	// header
	
		// logout
		case "logout":
			@session_start();
			@session_destroy();

			//删除cookie
			setcookie("ua", base64_encode("You are authed!"), time()-3600);
			
			redirect('Account', 'login');
			break;
	
	// comments
	
		// new comment
		case "new_comment":
			new_comment($_REQUEST['comment'], $_REQUEST['posterID'], $_REQUEST['logID'], $_REQUEST['parentCommentID'], $_REQUEST['isRoot']);
			page_jump_back();		
			break;
			
	// dyns
	
		// get dynamics
		case 'get_followee_dyns':
		case 'get_personal_dyns':
			$sm = new sm();
			
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
			elseif($act='get_personal_dyns'){
				$dynType = 'personal';
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

			$output = $sm->fetch('user_dyns.tc');
			echo $output;
			break;
	
	// feedback panel
	
		// send feedback
		case "send_feedback":
			$mailSubject = '[Goal意见反馈]';
	
			@session_start();
			$mailContent = "<h1 style='margin:0 0 10px 0;font-size:15px'>"
							. "<a href='http://hustlzp.com/goal/person.php?userID=". $_SESSION['valid_user_id']. "'>"
								. $_SESSION['valid_user']
							. "</a>"
							. " 说："
						. "</h1>";
	
			if(trim($_REQUEST['feedbackSubject']) != ""){
				$mailContent .= "<p style='margin:0 0 10px 0;font-size:16px;font-weight:bold;font-family:微软雅黑;'>". $_REQUEST['feedbackSubject']. "</p>";
			}

			$mailContent .= "<p style='margin:0;'>". $_REQUEST['feedbackContent']. "</p>";
	
			send_email('mail@hustlzp.com', $mailSubject, $mailContent);
			page_jump_back();
			break;
		
	// browser warning
	
		// get view
		case "browser_warning":
			$sm = new sm();
			$sm->display("browser_warning.tp");
			break;
	}
	
?>