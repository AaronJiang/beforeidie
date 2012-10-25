<?php

	include_once('setup.php');
	
	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];
	
	switch($action){
	
		// send feedback
		case 'send_feedback':
		
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
	}
	
?>