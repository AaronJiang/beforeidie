<?php
	include_once('setup.php');

	browser_check();
	auth_check();
	
	$action = $_REQUEST['act'];

	switch($action){
	
	// header
	
		case "logout":
			auth_check();
			@session_start();
			@session_destroy();

			//删除cookie
			setcookie("ua", base64_encode("You are authed!"), time()-3600);
			
			redirect('Discover', 'discover');
			break;
	
	// feedback panel
	
		case "send_feedback":
			$mailSubject = '[Goal意见反馈]';
	
			$mailContent = "<!DOCTYPE html><html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head><body>";

			@session_start();
			if(isset($_SESSION['valid_user_id'])){
				$mailContent .= "<h1 style='margin:0 0 10px 0;font-size:15px'><a href='http://hustlzp.com/beforeidie/PersonC.php?at=person&userID=". $_SESSION['valid_user_id']. "'>". $_SESSION['valid_user']. "</a> 说：</h1>";	
			}
			else{
				$mailContent .= "<h1 style='margin:0 0 10px 0;font-size:15px'>有人说：</h1>";
			}

			$mailContent .= "</body></html>";
	
			if(trim($_REQUEST['feedbackSubject']) != ""){
				$mailContent .= "<p style='margin:0 0 10px 0;font-size:16px;font-weight:bold;font-family:微软雅黑;'>". $_REQUEST['feedbackSubject']. "</p>";
			}

			$mailContent .= "<p style='margin:0;'>". $_REQUEST['feedbackContent']. "</p>";
	
			send_email('mail@hustlzp.com', $mailSubject, $mailContent);
			page_jump_back();
			break;
		
	// browser warning
	
		// view
		case "browser_warning":
			$sm = new sm();
			$sm->display("browser_warning.tp");
			break;
	}
	
?>