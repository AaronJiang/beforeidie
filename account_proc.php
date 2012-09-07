<?php
	require_once("data_funs.inc");
	
	$proc = trim($_REQUEST['proc']);
	
	switch($proc){
		case "login":
			session_start();
			$email = $_REQUEST['email'];
			$pwd = $_REQUEST['password'];
			$isExist = check_user_by_name($email, $pwd);
			if($isExist){
				$_SESSION['valid_user'] = get_username_by_email($email);
				$_SESSION['valid_user_id'] = get_userid_by_email($email);
				
				//设置cookie
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（无期限）
				setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2);	//用户授权ua（期限自定）

				page_jump('home.php');
			}
			else{
				//停留在 login 页面上，并提示用户不存在
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
			page_jump('home.php');
			break;
			
		case "change_pwd":
			$isExist = check_user_by_id($_REQUEST['userID'], $_REQUEST['originalPwd']);
			if($isExist){
				change_pwd($_REQUEST['userID'], $_REQUEST['newPwd']);
			}
			page_jump('account_page_details.php');
			break;
	}
?>