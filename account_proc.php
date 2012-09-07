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
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（无期限）
				setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2);	//用户授权ua（期限自定）

				page_jump('home.php');
			}
			elseif(check_unactive_user_by_email($email, $pwd)){
				page_jump('account_page_active.php?from=login&email='. $email);
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
			new_user($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['email']);
			
			session_start();
			$_SESSION['valid_user'] = $_REQUEST['username'];
			$_SESSION['valid_user_id'] = get_userID($_REQUEST['username']);
			
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
			//发送激活邮件
			break;
			
		case "active":
			//激活账户
			//设置Session
			page_jump('home.php');
			break;
	}
?>

