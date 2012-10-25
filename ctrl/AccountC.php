<?php

	include_once('setup.php');

	$action = $_REQUEST['act'];
	
	switch($action){
		case 'pLogin':
			$sm = new sm('account');

			// slogan info
			$sm->assign('sInfo', array('usersNum' => get_all_users_num(),
											'goalsNum' => get_all_goals_num(),
											'logsNum' => get_all_logs_num()));
											
			// Cookie email
			$sm->assign('email', @base64_decode($_COOKIE['ue']));
			
			$sm->display('login.tp');
			
			break;

		case 'pRegister':
			$sm = new sm('account');

			// slogan info
			$sm->assign('sInfo', array('usersNum' => get_all_users_num(),
										'goalsNum' => get_all_goals_num(),
										'logsNum' => get_all_logs_num()));
										
			$sm->display('register.tp');	
			break;
			
		case 'pActive':
			$sm = new sm('account');
			
			// slogan info
			$sm->assign('sInfo', array('usersNum' => get_all_users_num(),
										'goalsNum' => get_all_goals_num(),
										'logsNum' => get_all_logs_num()));

			// from
			$sm->assign('from', $_REQUEST['from']);

			// email
			$sm->assign('email', $_REQUEST['email']);

			$sm->display('active.tp');		
			break;
			
		case 'pChangePwd':
			$sm = new sm('account');
			
			$sm->display('');		
			break;
		
		case 'pDetails':
			$sm = new sm('account');
			
			$sm->display('');		
			break;
		
		case 'pForgetPwd':
			$sm = new sm('account');
			
			$sm->display('');		
			break;
			
		case 'pResetPwd':
			$sm = new sm('account');
			
			$sm->display('');		
			break;
		
		// account proc
		case "login":
			$email = $_REQUEST['email'];
			$pwd = $_REQUEST['password'];
			
			if(check_user_by_email($email, $pwd)){
				@session_start();
				$_SESSION['valid_user'] = get_username_by_email($email);
				$_SESSION['valid_user_id'] = get_userid_by_email($email);
				
				//cookies
				setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（一个月）
				setcookie("ua", base64_encode("You are authed!"), time()+3600*24*2);	//用户授权ua（2天）

				redirect('Home', 'home');
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
			
			redirect('Account', 'pLogin');
			break;
		
		case "register":
			$email = $_REQUEST['email'];
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
		
			new_user($username, $password, $email);
			send_active_email($email);
			setcookie("ue", base64_encode($email), time()+3600*24*30);	//用户邮箱ue（1个月）

			redirect('Account', 'pActive', array('from' => 'register', 'email' => $_REQUEST['email']));
			break;

		case "sendActiveEmail":
			$email = $_REQUEST['email'];
			send_active_email($email);
			redirect('Account', 'pActive', array('from' => 'sended', 'email' => $email));
			break;
			
		case "active":
			$activeCode = $_REQUEST['activeCode'];
			$email = $_REQUEST['email'];
			
			// 激活成功
			if($activeCode == gene_active_code($email)){
				active_account($email);
				follow_user(get_userid_by_email($email), 0);
				redirect('Account', 'pActive', array('from' => 'activeSucc', 'email' => $email));
			}
			// 激活失败
			else{
				redirect('Account', 'pActive', array('from' => 'activeError', 'email' => $email));
			}
			break;
			
		case "send_reset_pwd_email":
			$email = $_REQUEST['email'];
			send_reset_pwd_email($email);
			page_jump('account_page_forgot_pwd.php?from=sended');
			break;
			
		case "verify_reset_code":
			$email = $_REQUEST['email'];
			$resetCode = $_REQUEST['resetCode'];
			
			if($resetCode == gene_active_code($email)){
				page_jump('account_page_reset_pwd.php?email='. $email);
			}
			else{
				page_jump('account_page_forgot_pwd.php?from=resetFailed&email='. $email);
			}
			break;
			
		case "changePwd":
			$isExist = check_user_by_id($_REQUEST['userID'], $_REQUEST['originalPwd']);
			
			if($isExist){
				change_pwd($_REQUEST['userID'], $_REQUEST['newPwd']);
			}
			page_jump('account_page_details.php');
			break;

		case "reset_pwd":
			$email = $_REQUEST['email'];
			$pwd = $_REQUEST['pwd'];
			
			$isReset = reset_pwd($email, $pwd);
			
			if($isReset){
				page_jump('account_page_forgot_pwd.php?from=resetSucc');
			}
			else{
				page_jump('account_page_forgot_pwd.php?from=resetFailed');			
			}
			break;
	
	}
	
?>