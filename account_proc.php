<?php
	require_once("data_funs.inc");

			
	$proc = trim($_REQUEST['proc']);
	
	switch($proc){
		case "login":
			$email = $_REQUEST['email'];
			$pwd = $_REQUEST['password'];
			
			if(check_user_by_email($email, $pwd)){
				session_start();
				$_SESSION['valid_user'] = get_username_by_email($email);
				$_SESSION['valid_user_id'] = get_userid_by_email($email);
				
				//cookies
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（一个月）
				setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2);	//用户授权ua（2天）

				page_jump('home.php');
			}
			elseif(check_unactive_user_by_email($email, $pwd)){
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）
				page_jump('account_page_active.php?from=unactive&email='. $email);
			}
			else{
				page_jump_back();
			}
			break;
			
		case "logout":
			session_start();
			session_destroy();

			//删除cookie
			setcookie("ua", base64_encode("You are authed!"), time()-3600);
			
			page_jump('account_page_login.php');
			break;
		
		case "register":
			$email = $_REQUEST['email'];
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
		
			new_user($username, $password, $email);
			send_active_email($email);
			setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）

			page_jump('account_page_active.php?from=register&email='. $_REQUEST['email']);
			break;
			
		case "change_pwd":
			$isExist = check_user_by_id($_REQUEST['userID'], $_REQUEST['originalPwd']);
			
			if($isExist){
				change_pwd($_REQUEST['userID'], $_REQUEST['newPwd']);
			}
			page_jump('account_page_details.php');
			break;
			
		case "send_active_email":
			send_active_email($email);
			page_jump('account_page_active.php?from=sended&email='. $email);
			break;
			
		case "active":
			$activeCode = $_REQUEST['activeCode'];
			$email = $_REQUEST['email'];
			
			if($activeCode == gene_active_code($email)){
				active_account($email);
				page_jump('account_page_active.php?from=activeSucc&email='. $email);
			}
			else{
				page_jump('account_page_active.php?from=activeError&email='. $email);
			}

			break;
	}
?>

